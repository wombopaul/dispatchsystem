<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Type;
use DNS1D;
use Carbon\Carbon;
use App\Models\CourierInfo;
use App\Models\Branch;
use App\Models\CourierProduct;
use Illuminate\Support\Facades\DB;
use App\Models\CourierPayment;

class CourierSettingController extends Controller
{
    
    public function unitIndex()
    {
        $pageTitle = "Manage Unit";
        $emptyMessage = "No data found";
        $units = Unit::latest()->paginate(getPaginate());
        return view('admin.unit.index', compact('pageTitle', 'emptyMessage', 'units'));
    }

    public function unitStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40|unique:units',
        ]);
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->status = $request->status ? 1: 0;
        $unit->save();
        $notify[] = ['success', 'Unit has been created'];
        return back()->withNotify($notify);
    }

    public function unitUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40|unique:units,name,'.$request->id,
        ]);
        $unit = Unit::findOrFail($request->id);
        $unit->name = $request->name;
        $unit->status = $request->status ? 1: 0;
        $unit->save();
        $notify[] = ['success', 'Unit has been updated'];
        return back()->withNotify($notify);
    }


    public function typeIndex()
    {
        $pageTitle = "Manage Courier Type";
        $emptyMessage = "No data found";
        $units = Unit::where('status', 1)->latest()->get();
        $types = Type::latest()->with('unit')->paginate(getPaginate());
        return view('admin.unit.type', compact('pageTitle', 'emptyMessage', 'types', 'units'));
    }

    public function typeStore(Request $request)
    {
        $request->validate([
            'unit' => 'required|exists:units,id',
            'name' => 'required|max:40|unique:types',
            'price' => 'required|gt:0|numeric',
        ]);
        $unit = new Type();
        $unit->name = $request->name;
        $unit->unit_id = $request->unit;
        $unit->price = $request->price;
        $unit->status = $request->status ? 1: 0;
        $unit->save();
        $notify[] = ['success', 'Courier type has been created'];
        return back()->withNotify($notify);
    }

    public function typeUpdate(Request $request)
    {
        $request->validate([
            'unit' => 'required|exists:units,id',
            'name' => 'required|max:40|unique:types,name,'.$request->id,
            'price' => 'required|gt:0|numeric',
        ]);
        $unit = Type::findOrFail($request->id);
        $unit->name = $request->name;
        $unit->unit_id = $request->unit;
        $unit->price = $request->price;
        $unit->status = $request->status ? 1: 0;
        $unit->save();
        $notify[] = ['success', 'Courier type has been updated'];
        return back()->withNotify($notify);
    }


    public function courierInfo()
    {
        $pageTitle = "Courier Information";
        $emptyMessage = "No data found";
        $courierInfos = CourierInfo::orderBy('id', 'DESC')->with('senderBranch', 'receiverBranch', 'senderStaff', 'receiverStaff', 'paymentInfo')->paginate(getPaginate());
        return view('admin.courier.index', compact('pageTitle', 'emptyMessage', 'courierInfos'));
    }


    public function courierDetail($id)
    {
        $pageTitle = "Courier Details";
        $courierInfo = CourierInfo::findOrFail($id);
        return view('admin.courier.details', compact('pageTitle', 'courierInfo'));
    }


    public function invoice($id)
    {
        $pageTitle = "Invoice";
        $courierInfo = CourierInfo::where('id', $id)->first();
        $courierProductInfos = CourierProduct::where('courier_info_id', $courierInfo->id)->get();
        $courierPayment = CourierPayment::where('courier_info_id', $courierInfo->id)->first();
        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($courierInfo->code, 'C128') . '" alt="barcode"   />' . "<br>" . $courierInfo->code;
        return view('admin.courier.invoice', compact('pageTitle', 'courierInfo', 'courierProductInfos', 'courierPayment', 'code'));
    }

    public function courierDateSearch(Request $request)
    {
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
        $courierInfos = $courierInfos->with('senderBranch', 'receiverBranch', 'senderStaff', 'receiverStaff', 'paymentInfo')->paginate(getPaginate());
        return view('admin.courier.index', compact('pageTitle', 'emptyMessage', 'courierInfos', 'dateSearch'));
    }


    public function branchIncome()
    {
        $pageTitle = "Branch Income History";
        $emptyMessage = "No data found";
        $branchs = Branch::where('status', 1)->latest()->get();
        $branchIncomes = CourierPayment::whereNotNull('branch_id')->where('status', 1)->select(DB::raw("*,SUM(amount) as totalAmount"))
                ->groupBy('branch_id')->with('brach')->paginate(getPaginate());
        return view('admin.courier.income', compact('pageTitle', 'emptyMessage', 'branchIncomes', 'branchs'));
    }


    public function branchIncomeDateSearch(Request $request)
    {
        $request->validate(['branch_id' => 'required|exists:branches,id']);
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
            return redirect()->route('admin.branch.income')->withNotify($notify);
        }
        if ($end && !preg_match($pattern,$end)) {
            $notify[] = ['error','Invalid date format'];
            return redirect()->route('admin.branch.income')->withNotify($notify);
        }
        $branchs = Branch::where('status', 1)->latest()->get();
        $branch = Branch::find($request->branch_id);
        $pageTitle = $branch->name." Income Search";
        $dateSearch = $search;
        $emptyMessage = "No data found";
        if ($start) {
            $branchIncomes = CourierPayment::whereDate('created_at',Carbon::parse($start));
        }
        if($end){
            $branchIncomes = CourierPayment::whereDate('created_at','>=',Carbon::parse($start))->whereDate('created_at','<=',Carbon::parse($end));
        }
        $branchIncomes = $branchIncomes->where('status', 1)->where('branch_id', $request->branch_id)->select(DB::raw("*,SUM(amount) as totalAmount"))->with('brach')->paginate(getPaginate());;
        return view('admin.courier.income', compact('pageTitle', 'emptyMessage', 'branchIncomes', 'dateSearch', 'branchs'));
    }
}
