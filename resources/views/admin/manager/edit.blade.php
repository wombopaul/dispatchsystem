@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.branch.manager.update', $manager->id)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="branch" class="form-control-label font-weight-bold">@lang('Select Branch')</label>
                                <select class="form-control form-control-lg" id="branch" name="branch">
                                    <option value="">@lang('Select One')</option>
                                    @foreach($branchs as $branch)
                                        @if($branch->id == $manager->branch_id)
                                            <option value="{{ $branch->id }}" selected="">{{__($branch->name)}}</option>
                                        @else
                                            <option value="{{ $branch->id }}">{{__($branch->name)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="fname" class="form-control-label font-weight-bold">@lang('First Name')</label>
                                <input type="text" class="form-control form-control-lg" id="fname" name="fname" value="{{__($manager->firstname)}}"  maxlength="40" required="">
                            </div>

                             <div class="form-group col-lg-6">
                                <label for="lname" class="form-control-label font-weight-bold">@lang('Last Name')</label>
                                <input type="text" class="form-control form-control-lg" id="lname" name="lname" value="{{__($manager->lastname)}}"  maxlength="40" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="username" class="form-control-label font-weight-bold">@lang('Username')</label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" value="{{__($manager->username)}}"  maxlength="40" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="email" class="form-control-label font-weight-bold">@lang('Email Address')</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{__($manager->email)}}" maxlength="40" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="phone" class="form-control-label font-weight-bold">@lang('Phone')</label>
                                <input type="text" class="form-control form-control-lg" id="phone" name="mobile" value="{{__($manager->mobile)}}"  maxlength="40" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-control-label font-weight-bold">@lang('Status') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                    data-toggle="toggle" data-on="@lang('Active')" @if($manager->status == 1) checked="" @endif data-off="@lang('Banned')" name="status">
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
                            <button type="submit" class="btn btn--primary btn-block"><i class="fa fa-fw fa-paper-plane"></i> @lang('Update Branch Manager')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.branch.manager.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="las la-angle-double-left"></i> @lang('Go Back')</a>
@endpush