<?php

namespace App\Http\Controllers;
use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\CourierInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function index(){
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','home')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }

        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }
        
        $pageTitle = 'Home';
        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','home')->first();
        return view($this->activeTemplate . 'home', compact('pageTitle','sections'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname',$this->activeTemplate)->where('slug',$slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle','sections'));
    }

    public function newDispatchOrder(){
        dd("here");
        return view("dispatch.patials.new_dispatch_order");
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        $contact = Frontend::where('data_keys','contact_us.content')->firstOrFail();
        return view($this->activeTemplate . 'contact',compact('pageTitle', 'contact'));
    }

    public function footerMenu($slug, $id)
    {
        $data = Frontend::where('id', $id)->where('data_keys', 'footer.element')->firstOrFail();
        $pageTitle =  $data->data_values->menu;
        return view($this->activeTemplate . 'menu', compact('data', 'pageTitle'));
    }


    public function contactSubmit(Request $request)
    {

        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);


        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();
        
        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }


    public function blog(){
        $pageTitle = "Blog";
        $blogs = Frontend::where('data_keys','blog.element')->paginate(9);
        return view($this->activeTemplate.'blog',compact('blogs','pageTitle'));
    }

    public function blogDetails($id,$slug){
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $recentBlogs = Frontend::where('data_keys','blog.element')->orderby('id', 'DESC')->limit(7)->get();
        $pageTitle = "Blog Details";
        return view($this->activeTemplate.'blog_details',compact('blog','pageTitle', 'recentBlogs'));
    }


    public function orderTracking(Request $request)
    {
        $pageTitle = "Order Tracking";
        $orderNumber = null;
        if($request->order_number){
            $request->validate([
                'order_number' => 'required|exists:courier_infos,code',
            ]);
            $orderNumber = CourierInfo::where('code', $request->order_number)->first();
            if(!$orderNumber){
                $notify[] = ['success', 'Order Number Invalid'];
                return back()->withNotify($notify);
            }
        }
        return view($this->activeTemplate . 'order_tracking', compact('pageTitle', 'orderNumber'));
    }

    public function dispatchOrders(Request $request)
    {
        $pageTitle = "Dispatch Order";
       
        return view($this->activeTemplate . 'dispatch_order', compact('pageTitle', 'pageTitle'));
    }

    public function cookieAccept(){
        session()->put('cookie_accepted',true);
        $notify[] = ['success','Cookie accepted successfully'];
        return back()->withNotify($notify);
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
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
}
