<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\Type;
use App\Models\Branch;
use App\Models\Frontend;
use App\Models\Language;
use DNS1D;
use App\Models\CourierInfo;
use Illuminate\Http\Request;
use App\Models\CourierPayment;
use App\Models\CourierProduct;
use App\Models\AdminNotification;

class DispatchController extends Controller
{

    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }
    public function newDispatchOrder(){
        $pageTitle = "Create Dispatch Order";
        $branchs = Branch::where('status', 1)->latest()->get();
        $types = Type::where('status', 1)->with('unit')->latest()->get();
        //return view('staff.courier', compact('pageTitle', 'branchs', 'types'));
        return view("dispatch.new_dispatch_order", compact('pageTitle', 'branchs', 'types'));
    }


    public function store(Request $request)
    {
      
        $request->validate([
            'branch' => 'required|exists:branches,id',
            'sender_name' => 'required|max:40',
            'sender_email' => 'required|email|max:40',
            'sender_phone' => 'required|string|max:40',
            'sender_address' => 'required|max:255', 
            'receiver_name' => 'required|max:40',
            'receiver_email' => 'required|email|max:40',
            'receiver_phone' => 'required|string|max:40',
            'receiver_address' => 'required|max:255',
            'courierName.*' => 'required_with:quantity|exists:types,id',
            'quantity.*' => 'required_with:courierName|integer|gt:0',
            'amount' => 'required|array',
            'amount.*' => 'numeric|gt:0',
        ]);
      
        //$sender = Auth::user();
        $courier = new CourierInfo();
        $courier->invoice_id = getTrx();
        $courier->code = getTrx();
        $courier->sender_branch_id = 1;
        $courier->sender_staff_id = 4;
        $courier->sender_name = $request->sender_name;
        $courier->sender_email = $request->sender_email;
        $courier->sender_phone = $request->sender_phone;
        $courier->sender_address = $request->sender_address;
        $courier->receiver_name = $request->receiver_name;
        $courier->receiver_email = $request->receiver_email;
        $courier->receiver_phone = $request->receiver_phone;
        $courier->receiver_address = $request->receiver_address;
        $courier->receiver_branch_id = $request->branch;
        $courier->status = 0;
        $courier->is_online = 1;
        $courier->save();

        $totalAmount = 0;
        for ($i=0; $i <count($request->courierName); $i++) { 
            $courierType = Type::where('id',$request->courierName[$i])->where('status', 1)->firstOrFail();
            $totalAmount += $request->quantity[$i] * $courierType->price;
            $courierProduct = new CourierProduct();
            $courierProduct->courier_info_id = $courier->id;
            $courierProduct->courier_type_id = $courierType->id;
            $courierProduct->qty = $request->quantity[$i];
            $courierProduct->fee = $request->quantity[$i] * $courierType->price;
            $courierProduct->save();
        }
        $courierPayment = new CourierPayment();
        $courierPayment->courier_info_id = $courier->id;
        $courierPayment->amount = $totalAmount;
        $courierPayment->status = 0;
        $courierPayment->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = 4;
        $adminNotification->title = 'Dispatch Courier John';
        $adminNotification->click_url = urlPath('admin.courier.info.details',$courier->id);
        $adminNotification->save();

        $notify[]=['success','Courier created successfully'];
        return redirect()->route('dispatch.invoice', encrypt($courier->id))->withNotify($notify);
    }

    public function invoice($id)
    {
        $pageTitle = "Invoice";
        $courierInfo = CourierInfo::where('id', decrypt($id))->first();
        $courierProductInfos = CourierProduct::where('courier_info_id', $courierInfo->id)->with('type')->get();
        $courierPayment = CourierPayment::where('courier_info_id', $courierInfo->id)->first();
        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($courierInfo->code, 'C128') . '" alt="barcode"   />' . "<br>" . $courierInfo->code;
        return view('dispatch.invoice', compact('pageTitle', 'courierInfo', 'courierProductInfos', 'courierPayment', 'code'));
    }
  

    public function searchPhoneNumber($mobile){
    
        $pageTitle = "Create Dispatch Order";
        $user = user::where('mobile',$mobile)->first();
        return view("dispatch.patials.new_dispatch_order", compact('pageTitle'))->with('user',$user);

    }

    public function storeOnline(Request $request)
    {
      
        $request->validate([
            //'branch' => 'required|exists:branches,id',
            'sender_name' => 'required|max:40',
            'sender_email' => 'required|email|max:40',
            'sender_phone' => 'required|string|max:40',
            'sender_address' => 'required|max:255', 
            'receiver_name' => 'required|max:40',
            'receiver_email' => 'required|email|max:40',
            'receiver_phone' => 'required|string|max:40',
            'receiver_address' => 'required|max:255',
        ]);
      
        //$sender = Auth::user();
        $courier = new CourierInfo();
        $courier->invoice_id = getTrx();
        $courier->code = getTrx();
        $courier->sender_branch_id = $request->sender_branch_id;
        $courier->percel_note = $request->percel_note;
        $courier->sender_name = $request->sender_name;
        $courier->sender_email = $request->sender_email;
        $courier->sender_phone = $request->sender_phone;
        $courier->sender_address = $request->sender_address;
        $courier->receiver_name = $request->receiver_name;
        $courier->receiver_email = $request->receiver_email;
        $courier->receiver_phone = $request->receiver_phone;
        $courier->receiver_address = $request->receiver_address;
        $courier->receiver_branch_id = $request->branch;
        $courier->status = 0;
        $courier->is_online = 1;
        $courier->save();

        $totalAmount = 0;
        //for ($i=0; $i <count($request->courierName); $i++) { 
            $courierType = Type::where('id',$request->courierName[$i])->where('status', 1)->firstOrFail();
            $totalAmount += $request->quantity[$i] * $courierType->price;
            $courierProduct = new CourierProduct();
            $courierProduct->courier_info_id = $courier->id;
            $courierProduct->courier_type_id = $courierType->id;
            $courierProduct->qty = $request->weight;
            $courierProduct->fee = $request->amount;
            $courierProduct->save();
       // }
       $p_status = 0;
        if($request->payment_method == "Online Payment"){
            $p_status = 1;
        }

        $courierPayment = new CourierPayment();
        $courierPayment->courier_info_id = $courier->id;
        $courierPayment->amount = $request->amount;
        $courierPayment->payment_method = $request->payment_method;
        $courierPayment->status = $p_status;
        $courierPayment->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = 4;
        $adminNotification->title = 'Dispatch Courier John';
        $adminNotification->click_url = urlPath('admin.courier.info.details',$courier->id);
        $adminNotification->save();

        $notify[]=['success','Courier created successfully'];
        return redirect()->route('dispatch.invoice', encrypt($courier->id))->withNotify($notify);
    }

    public function loadpartial(){
        return view('templates.basic._order-address');
    }
}