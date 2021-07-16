<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AuthorizationController extends Controller
{
    public function __construct()
    {
        return $this->activeTemplate = activeTemplate();
    }
    public function checkValidCode($user, $code, $add_min = 10000)
    {
        if (!$code) return false;
        if (!$user->ver_code_send_at) return false;
        if ($user->ver_code_send_at->addMinutes($add_min) < Carbon::now()) return false;
        if ($user->ver_code !== $code) return false;
        return true;
    }
    

    public function authorizeForm()
    {

        if (auth()->check()) {
            $user = auth()->user();
            if (!$user->status) {
                Auth::logout();
            }
            elseif (!$user->tv) {
                $pageTitle = 'Google Authenticator';
                if($user->user_type == "staff"){
                    return view('staff.auth.authorization.2fa', compact('user', 'pageTitle'));
                }
                elseif($user->user_type == "manager"){
                    return view('manager.auth.authorization.2fa', compact('user', 'pageTitle'));
                }
            }else{
                if($user->user_type == "staff"){
                    return redirect()->route('staff.dashboard');
                }
                elseif($user->user_type == "manager"){
                    return redirect()->route('manager.dashboard');
                }
            }
        }
        return redirect()->route('home');
    }

    public function g2faVerification(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'code' => 'required',
        ]);
        $code = str_replace(' ','',$request->code);
        $response = verifyG2fa($user,$code);
        if ($response) {
            $notify[] = ['success','Verification successful'];
        }else{
            $notify[] = ['error','Wrong verification code'];
        }
        return back()->withNotify($notify);
    }
}
