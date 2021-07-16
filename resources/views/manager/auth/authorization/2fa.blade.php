@extends('manager.layouts.master')
@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/manager/images/1.jpg')}}">
            <div class="form-wrapper">
                <h6>@lang('2FA Verification')</h6>
                <form action="{{route('user.go2fa.verify')}}"  method="POST" class="cmn-form mt-30">
                    @csrf
                    <div class="form-group">
                        <p class="text-center">@lang('Current Time'): {{\Carbon\Carbon::now()}}</p>
                    </div>
                    <div class="form-group">
                        <<label>@lang('Verification Code')</label>
                        <input type="text" name="code" class="form-control" id="code">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Login') <i class="las la-sign-in-alt"></i></button>
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