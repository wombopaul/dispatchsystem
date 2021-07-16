<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use App\Models\Branch;
use App\Models\CourierInfo;
use App\Models\GeneralSetting;
use App\Models\CourierProduct;
use App\Models\CourierPayment;
use App\Models\User;
use Carbon\Carbon;
use App\Lib\GoogleAuthenticator;
use DNS1D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    
    public function dashboard()
    {
        $manager = Auth::user();
        $pageTitle = "Manager Dashboard";
        $emptyMessage = "No data found";
        $branchListCount = Branch::where('status', 1)->count();
        $totalStaffCount = User::where('user_type', 'staff')->where('branch_id', $manager->branch_id)->count();
        $branchIncome = CourierPayment::where('branch_id', $manager->branch_id)->sum('amount');
        $courierInfoCount = CourierInfo::where('receiver_branch_id', $manager->branch_id)->orWhere('sender_branch_id', $manager->branch_id)->count();
        $courierInfos = CourierInfo::where('receiver_branch_id', $manager->branch_id)->orWhere('sender_branch_id', $manager->branch_id)->orderBy('id', 'DESC')->take(5)->with('senderBranch', 'receiverBranch', 'senderStaff', 'receiverStaff', 'paymentInfo')->get();
        return view('manager.dashboard', compact('pageTitle', 'branchListCount', 'totalStaffCount', 'branchIncome', 'courierInfoCount', 'courierInfos', 'emptyMessage'));
    }

    public function branchList()
    {
        $pageTitle = "Branch list";
        $emptyMessage = "No data found";
        $branchs = Branch::where('status', 1)->latest()->paginate(getPaginate());
        return view('manager.branch.index', compact('pageTitle', 'emptyMessage', 'branchs'));
    }

    public function branchSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $pageTitle = "Branch search list";
        $emptyMessage = "No data found";
        $branchs = Branch::where('status', 1)->where('name', 'like',"%$search%")->orWhere('email', 'like',"%$search%")->orWhere('address', 'like',"%$search%")->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('manager.branch.index', compact('pageTitle', 'emptyMessage', 'branchs', 'search'));
        
    }

    public function profile()
    {
        $pageTitle = "Manager Profile";
        $manager = Auth::user();
        return view('manager.profile', compact('pageTitle', 'manager'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'fname' => 'required|max:40',
            'lname' => 'required|max:40',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'image' => ['nullable','image',new FileTypeValidate(['jpg','jpeg','png'])]
        ]);
        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = uploadImage($request->image, imagePath()['profile']['user']['path'], imagePath()['profile']['user']['size'], $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $user->firstname = $request->fname;
        $user->lastname = $request->lname;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return redirect()->route('manager.profile')->withNotify($notify);
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $user = Auth::user();
        return view('manager.password', compact('pageTitle', 'user'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password do not match !!'];
            return back()->withNotify($notify);
        }
        $user->password = Hash::make($request->password);
        $user->show_password = encrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return redirect()->route('manager.password')->withNotify($notify);
    }


    public function courierInfo()
    {
        $user = Auth::user();
        $pageTitle = "All Courier List";
        $emptyMessage = "No data found";
        $courierInfos = CourierInfo::where('sender_branch_id', $user->branch_id)->orWhere('receiver_branch_id', $user->branch_id)->orderBy('id', 'DESC')->with('senderBranch', 'receiverBranch', 'senderStaff', 'receiverStaff', 'paymentInfo')->paginate(getPaginate());
        return view('manager.courier.index', compact('pageTitle', 'emptyMessage', 'courierInfos'));
    }

    public function sendCourier()
    {
        $user = Auth::user();
        $pageTitle = "Dispatch Courier List";
        $emptyMessage = "No data found";
        $courierInfos = CourierInfo::where('sender_branch_id', $user->branch_id)->orderBy('id', 'DESC')->with('senderBranch', 'receiverBranch', 'senderStaff', 'receiverStaff', 'paymentInfo')->paginate(getPaginate());
        return view('manager.courier.index', compact('pageTitle', 'emptyMessage', 'courierInfos'));
    }


    public function receivedCourier()
    {
        $user = Auth::user();
        $pageTitle = "Upcoming Courier List";
        $emptyMessage = "No data found";
        $courierInfos = CourierInfo::where('receiver_branch_id', $user->branch_id)->orderBy('id', 'DESC')->with('senderBranch', 'receiverBranch', 'senderStaff', 'receiverStaff', 'paymentInfo')->paginate(getPaginate());
        return view('manager.courier.index', compact('pageTitle', 'emptyMessage', 'courierInfos'));
    }


    public function courierSearchDate(Request $request, $scope)
    {
        $user = Auth::user();
        $search = $request->date;
        if (!$search) {
            return back();
        }
        $date = explode('-',$search);
        $start = @$date[0];
        $end = @$date[1];
        $pattern = "/\d{2}\/\d{2}\/\d{4}/";
        if ($start && !preg_match($pattern,$start)) {
            $notify[] = ['error','Invalid date format'];
            return redirect()->route('admin.courier.info.index')->withNotify($notify);
        }
        if ($end && !preg_match($pattern,$end)) {
            $notify[] = ['error','Invalid date format'];
            return redirect()->route('admin.courier.info.index')->withNotify($notify);
        }
        $pageTitle = "Courier Search";
        $dateSearch = $search;
        $emptyMessage = "No data found";
        if ($start) {
            $courierInfos = CourierInfo::whereDate('created_at',Carbon::parse($start));
        }
        if($end){
            $courierInfos = CourierInfo::whereDate('created_at','>=',Carbon::parse($start))->whereDate('created_at','<=',Carbon::parse($end));
        }
        if ($scope == 'dispatch') {
            $courierInfos = $courierInfos->where('sender_branch_id', $user->branch_id);
        }elseif($scope == 'upcoming'){
            $courierInfos = $courierInfos->where('receiver_branch_id', $user->branch_id);
        }else{
            $courierInfos = $courierInfos->where('sender_branch_id', $user->branch_id);
        }
        $courierInfos = $courierInfos->with('senderBranch', 'receiverBranch', 'senderStaff', 'receiverStaff', 'paymentInfo')->paginate(getPaginate());
        return view('manager.courier.index', compact('pageTitle', 'emptyMessage', 'courierInfos', 'dateSearch'));
    }


    public function courierSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $pageTitle = "Courier Search";
        $emptyMessage = "No Data Found";
        $user = Auth::user();
        $courierInfos = CourierInfo::where('sender_branch_id', $user->branch_id)->orWhere('receiver_branch_id', $user->branch_id)->where('code', $search)->with('senderBranch', 'receiverBranch', 'senderStaff', 'receiverStaff', 'paymentInfo')->paginate(getPaginate());
        return view('manager.courier.index', compact('pageTitle', 'emptyMessage', 'courierInfos', 'search'));
    }



    public function invoice($id)
    {
        $pageTitle = "Invoice";
        $courierInfo = CourierInfo::where('id', $id)->first();
        $courierProductInfos = CourierProduct::where('courier_info_id', $courierInfo->id)->get();
        $courierPayment = CourierPayment::where('courier_info_id', $courierInfo->id)->first();
        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($courierInfo->code, 'C128') . '" alt="barcode"   />' . "<br>" . $courierInfo->code;
        return view('manager.courier.invoice', compact('pageTitle', 'courierInfo', 'courierProductInfos', 'courierPayment', 'code'));
    }


    public function branchIncome()
    {
        $user = Auth::user();
        $pageTitle = "Branch Income";
        $emptyMessage = "No data found";
        $branchIncomes = CourierPayment::where('branch_id', $user->branch_id)
                    ->select(DB::raw("*,SUM(amount) as totalAmount"))
                    ->groupBy('date')->orderby('id', 'DESC')->paginate(getPaginate());
        return view('manager.courier.income', compact('pageTitle', 'emptyMessage', 'branchIncomes'));
    }

    public function show2faForm()
    {
        $general = GeneralSetting::first();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->sitename, $secret);
        $pageTitle = 'Two Factor';
        return view('manager.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user,$request->code,$request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_ENABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);
            $notify[] = ['success', 'Google authenticator enabled successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $response = verifyG2fa($user,$request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts = 0;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_DISABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);
            $notify[] = ['success', 'Two factor authenticator disable successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

}