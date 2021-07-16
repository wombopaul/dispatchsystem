
@extends('manager.layouts.master')
@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/manager/images/1.jpg')}}">
            <div class="form-wrapper">
                <h4 class="logo-text mb-15">@lang('Welcome to') <strong>{{__($general->sitename)}}</strong></h4>
                <p>{{__($pageTitle)}} @lang('to')  {{__($general->sitename)}} @lang('dashboard')</p>
                <form action="{{ route('manager.password.email') }}"  method="POST" class="cmn-form mt-30">
                    @csrf
                    <div class="form-group">
                        <label for="email">@lang('Select One')</label>
                        <select class="form-control" name="type">
                            <option value="email">@lang('E-Mail Address')</option>
                            <option value="username">@lang('Username')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="my_value"></label>
                        <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autofocus="off">

                        @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Send Password Code') <i class="las la-sign-in-alt"></i></button>
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
        
        myVal();
        $('select[name=type]').on('change',function(){
            myVal();
        });
        function myVal(){
            $('.my_value').text($('select[name=type] :selected').text());
        }
    })(jQuery)
</script>
@endpush