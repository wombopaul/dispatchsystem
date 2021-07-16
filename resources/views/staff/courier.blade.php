@extends('staff.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('staff.courier.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card border--primary mt-3">
                                    <h5 class="card-header bg--primary  text-white">@lang('Sender Information')</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="sender_name" class="form-control-label font-weight-bold">@lang('Name')</label>
                                                <input type="text" class="form-control form-control-lg" id="sender_name" name="sender_name" value="{{old('sender_name')}}" placeholder="@lang("Enter Sender Name")"  maxlength="40" required="">
                                            </div>

                                             <div class="form-group col-lg-6">
                                                <label for="sender_phone" class="form-control-label font-weight-bold">@lang('Phone')</label>
                                                <input type="text" class="form-control form-control-lg" id="phone" value="{{old('sender_phone')}}" name="sender_phone" placeholder="@lang("Enter Sender Phone")"  maxlength="40" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label for="sender_email" class="form-control-label font-weight-bold">@lang('Email')</label>
                                                <input type="email" class="form-control form-control-lg" id="sender_email" name="sender_email" value="{{old('sender_email')}}" placeholder="@lang("Enter Sender Email")"  maxlength="40" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label for="sender_address" class="form-control-label font-weight-bold">@lang('Address')</label>
                                                <input type="text" class="form-control form-control-lg" id="sender_address" name="sender_address" value="{{old('sender_address')}}" placeholder="@lang("Enter Sender Address")"  maxlength="255" required="">
                                            </div>
                                        </div>  
                                    </div> 
                                </div>
                            </div>


                             <div class="col-lg-6">
                                <div class="card border--primary mt-3">
                                    <h5 class="card-header bg--primary  text-white">@lang('Receiver Information')</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="=branch" class="form-control-label font-weight-bold">@lang('Select Branch')</label>
                                                <select class="form-control form-control-lg" name="branch" id="branch" required="">
                                                    <option value="">@lang('Select One')</option>
                                                    @foreach($branchs as $branch)
                                                        <option value="{{$branch->id}}">{{__($branch->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="receiver_name" class="form-control-label font-weight-bold">@lang('Name')</label>
                                                <input type="text" class="form-control form-control-lg" id="receiver_name" name="receiver_name" value="{{old('receiver_name')}}" placeholder="@lang("Enter Receiver Name")"  maxlength="40" required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="receiver_phone" class="form-control-label font-weight-bold">@lang('Phone')</label>
                                                <input type="text" class="form-control form-control-lg" id="receiver_phone" name="receiver_phone" placeholder="@lang("Enter Receiver Phone")" value="{{old('receiver_phone')}}" required="">
                                            </div>


                                            <div class="form-group col-lg-6">
                                                <label for="receiver_email" class="form-control-label font-weight-bold">@lang('Email')</label>
                                                <input type="email" class="form-control form-control-lg" id="receiver_email" name="receiver_email" value="{{old('receiver_email')}}" placeholder="@lang("Enter Receiver Email")"  required="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label for="receiver_address" class="form-control-label font-weight-bold">@lang('Address')</label>
                                                <input type="text" class="form-control form-control-lg" id="receiver_address" name="receiver_address" placeholder="@lang("Enter Receiver Address")" value="{{old('receiver_address')}}"  required="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mb-30">
                            <div class="col-lg-12">
                                <div class="card border--primary mt-3">
                                    <h5 class="card-header bg--primary  text-white">@lang('Courier Information')
                                        <button type="button" class="btn btn-sm btn-outline-light float-right addUserData"><i class="la la-fw la-plus"></i>@lang('Add New One')
                                        </button>
                                    </h5>

                                    <div class="card-body">
                                        <div class="row addedField">
                                            <div class="col-md-12 user-data">
                                                <div class="form-group">
                                                    <div class="input-group mb-md-0 mb-4">
                                                        <div class="col-md-4">
                                                            <select class="form-control form-control-lg" id="courier_type_0" onchange="currierType(0)" name="courierName[]">
                                                                <option>@lang('Select One')</option>
                                                                @foreach($types as $type)
                                                                    <option value="{{$type->id}}" data-unit="{{$type->unit->name}}" data-price={{ getAmount($type->price)}}>{{__($type->name)}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control form-control-lg currier_quantity_0" placeholder="@lang('Quantity')" disabled="" name="quantity[]" onkeyup="courierQuantity(0)" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="unit_0"><i class="las la-balance-scale"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                           <div class="input-group mb-3">
                                                                <input type="text" id="amount" class="form-control form-control-lg currier_fee_0" placeholder="@lang('Enter Price')" name="amount[]" aria-label="Recipient's username" aria-describedby="basic-addon2" required="" readonly="">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block"><i class="fa fa-fw fa-paper-plane"></i> @lang('Send Courier')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{route('staff.dashboard')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="las la-angle-double-left"></i> @lang('Go Back')</a>
@endpush

@push('script')
<script>
    "use strict";
    function currierType(id) {
        let unit = $("#courier_type_" + id).find(':selected').data('unit');
        let price = $("#courier_type_" + id).find(':selected').data('price');
        $("#unit_" + id).html(unit);

        if ($('#courier_type_' + id).val()) {
            $(".currier_quantity_" + id).removeAttr("disabled");
        }
    }

    function courierQuantity(id)
    {
        let quantity = $(".currier_quantity_" + id).val();
        let price = $("#courier_type_" + id).find(':selected').data('price');
        $(".currier_fee_" + id).val(quantity * price);
    }

    $(document).ready(function () {
        let id = 0;
        $('.addUserData').on('click', function () {
            id++;
            let html = `<div class="col-md-12 user-data">
                            <div class="form-group">
                                <div class="input-group mb-md-0 mb-4">
                                    <div class="col-md-4">
                                        <select class="form-control form-control-lg" id="courier_type_${id}" onchange="currierType(${id})" name="courierName[]" required="">
                                            <option>@lang('Select One')</option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}" data-unit="{{$type->unit->name}}" data-price={{ getAmount($type->price)}}>{{__($type->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-md-0 mt-2">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control form-control-lg currier_quantity_${id}" placeholder="@lang('Quantity')" disabled="" onkeyup="courierQuantity(${id})" name="quantity[]" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="unit_${id}"><i class="las la-balance-scale"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mt-md-0 mt-2">
                                       <div class="input-group mb-3">
                                            <input type="text" id="amount" class="form-control form-control-lg currier_fee_${id}" placeholder="@lang('Enter Price')" name="amount[]" aria-label="Recipient's username" aria-describedby="basic-addon2" required="" readonly="">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">{{$general->cur_text}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mt-md-0 mt-2 text-right">
                                        <span class="input-group-btn">
                                            <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>`;
            $('.addedField').append(html)
        });

        $(document).on('click', '.removeBtn', function () {
            $(this).closest('.user-data').remove();
        });
    });
</script>
@endpush
