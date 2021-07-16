@extends('manager.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('manager.staff.update', encrypt($staff->id))}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="fname" class="form-control-label font-weight-bold">@lang('First Name')</label>
                                <input type="text" class="form-control form-control-lg" id="fname" name="fname" value="{{__($staff->firstname)}}" placeholder="@lang("Enter First Name")"  maxlength="40" required="">
                            </div>

                             <div class="form-group col-lg-6">
                                <label for="lname" class="form-control-label font-weight-bold">@lang('Last Name')</label>
                                <input type="text" class="form-control form-control-lg" id="lname" value="{{__($staff->lastname)}}" name="lname" placeholder="@lang("Enter Last Name")"  maxlength="40" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username" class="form-control-label font-weight-bold">@lang('Username')</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" value="{{__($staff->username)}}" placeholder="@lang("Enter Username")"  maxlength="40" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="email" class="form-control-label font-weight-bold">@lang('Email Address')</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{__($staff->email)}}" placeholder="@lang("Enter Email Address")"  maxlength="40" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="phone" class="form-control-label font-weight-bold">@lang('Phone')</label>
                                <input type="text" class="form-control form-control-lg" id="phone" name="mobile" value="{{__($staff->mobile)}}" placeholder="@lang("Enter Phone")"  maxlength="40" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-control-label font-weight-bold">@lang('Status') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                    data-toggle="toggle" data-on="@lang('Active')" @if($staff->status == 1) checked="" @endif data-off="@lang('Banned')" name="status">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="password" class="form-control-label font-weight-bold">@lang('Password')</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="@lang("Enter Password")">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="confirm_password" class="form-control-label font-weight-bold">@lang('Confirm Password')</label>
                                <input type="password" class="form-control form-control-lg" id="confirm_password" name="password_confirmation" placeholder="@lang("Confirm Password")">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block"><i class="fa fa-fw fa-paper-plane"></i> @lang('Update Staff')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{route('manager.staff.index')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="las la-angle-double-left"></i> @lang('Go Back')</a>
@endpush
