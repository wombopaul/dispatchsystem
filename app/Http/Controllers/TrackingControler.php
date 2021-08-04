<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Type;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\CourierInfo;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\CourierPayment;
use App\Models\CourierProduct;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use App\Models\SupportAttachment;

class TrackingControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
  
    public function clientTracking($id){
        $pageTitle = "Courier Details";
        $courierInfo = CourierInfo::findOrFail(decrypt($id));
        return view("clientTrack", compact('pageTitle', 'courierInfo'));
    }

    
}
