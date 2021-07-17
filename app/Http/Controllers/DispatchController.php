<?php

namespace App\Http\Controllers;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use Illuminate\Http\Request;

class DispatchController extends Controller
{

    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }
    public function newDispatchOrder(){
        return view("dispatch.new_dispatch_order");
    }

    public function searchPhoneNumber($mobile){
    
        $user = user::where('mobile',$mobile)->first();
        return view("dispatch.patials.new_dispatch_order")->with('user',$user);

    }
}