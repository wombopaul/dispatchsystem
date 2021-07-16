@extends('manager.layouts.master')
@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/manager/images/1.jpg')}}">
            <div class="form-wrapper">
                <h4 class="logo-text mb-15">@lang('Welcome to') <strong>{{__($general->sitename)}}</strong></h4>
                <p>{{__($pageTitle)}} @lang('to')  {{__($general->sitename)}} @lang('dashboard')</p>
                <form action="{{ route('manager.password.verify.code') }}"  method="POST" class="cmn-form mt-30">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="form-group">
                        <label>@lang('Verification Code')</label>
                        <input type="text" name="code" id="code" class="form-control">
                    </div>

                    <div class="form-group">
                        <p class="text-dark">@lang('Please check including your Junk/Spam Folder. if not found, you can')
                        <a href="{{ route('manager.password.request') }}">@lang('Try to send again')</a></p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Verify Code') <i class="las la-sign-in-alt"></i></button>
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