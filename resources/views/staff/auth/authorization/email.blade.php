@extends('staff.layouts.master')
@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/staff/images/1.jpg')}}">
            <div class="form-wrapper">
                <h4 class="logo-text mb-15">{{__($pageTitle)}}</h4>
                <h6>@lang('Please Verify Your Email to Get Access')</h6>
                <form action="{{route('user.verify.email')}}"  method="POST" class="cmn-form mt-30">
                    @csrf
                    <div class="form-group">
                        <p class="text-center">@lang('Your Email'):  <strong>{{auth()->user()->email}}</strong></p>
                    </div>
                    <div class="form-group">
                        <<label>@lang('Verification Code')</label>
                        <input type="text" name="email_verified_code" class="form-control" maxlength="7" id="code">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Login') <i class="las la-sign-in-alt"></i></button>
                    </div>

                    <div class="form-group">
                        <p>@lang('Please check including your Junk/Spam Folder. if not found, you can') <a href="{{route('user.send.verify.code')}}?type=email" class="forget-pass"> @lang('Resend code')</a></p>
                        @if ($errors->has('resend'))
                            <br/>
                            <small class="text-danger">{{ $errors->first('resend') }}</small>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    (function($){
        "use strict";
        $('#code').on('input change', function () {
          var xx = document.getElementById('code').value;
          
              $(this).val(function (index, value) {
                 value = value.substr(0,7);
                  return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
              });
          
      });
    })(jQuery)
</script>
@endpush




