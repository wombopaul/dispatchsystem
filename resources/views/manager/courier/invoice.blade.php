@extends('manager.layouts.app')
@section('panel')
<div class="card">
    <div class="card-body">
        <div class="content-header">
            <h3>
                @lang('Invoice #')
                <small>{{$courierInfo->invoice_id}}</small>
            </h3>
        </div>

        <div class="invoice">
            <div class="row mt-3">
                <div class="col-lg-6">
                    @php echo $code @endphp
                </div>
                <div class="col-lg-6">
                    <h5 class="float-sm-right">@lang('Date'): {{ showDateTime($courierInfo->created_at, 'd M Y') }}</h5>
                </div>
            </div>
            <hr>
            <div class="row invoice-info">
                <div class="col-md-4">
                    @lang('From')
                    <address class="font-weight-light">
                        <strong>{{__($courierInfo->sender_name)}}</strong><br>
                        {{__($courierInfo->sender_address)}}<br>
                        @lang('Phone'): {{__($courierInfo->sender_phone)}}<br>
                        @lang('Email'): {{__($courierInfo->sender_email)}}
                    </address>
                </div>
                <div class="col-md-4">
                  To
                    <address class="font-weight-light">
                        <strong>{{__($courierInfo->receiver_name)}}</strong><br>
                        {{__($courierInfo->receiver_address)}}<br>
                        @lang('Phone'): {{__($courierInfo->receiver_phone)}}<br>
                        @lang('Email'): {{__($courierInfo->receiver_email)}}
                    </address>
                </div>

                <div class="col-md-4 font-weight-light">
                    <b>@lang('Order Id') #{{__($courierInfo->code)}}</b><br>
                    <br>
                    <b>@lang('Payment Status'):</b>
                        @if($courierPayment->status == 1) 
                            <span class="badge badge--success">@lang('Paid')</span>
                        @else
                            <span class="badge badge--danger">@lang('Due')</span>
                        @endif
                       <br>
                    <b>@lang('Sender At Branch'):</b> {{__($courierInfo->senderBranch->name)}}<br>
                    <b>@lang('Received At Branch'):</b> {{__($courierInfo->receiverBranch->name)}}
                </div>
            </div>

            <div class="row">
                <div class="col-12 table-responsive--md">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('Courier Type')</th>
                                <th>@lang('Sending Date')</th>
                                <th>@lang('Qty')</th>
                                <th>@lang('Subtotal')</th>
                            </tr>
                        </thead>
                    <tbody>
                      @foreach($courierProductInfos as $courierProductInfo)
                            <tr>
                                <td data-label="#">{{$loop->iteration}}</td>
                                <td data-label="Courier Type">{{__($courierProductInfo->type->name)}}</td>
                                <td data-label="Sending Date">{{showDateTime($courierProductInfo->created_at, 'd M Y')}}</td>
                                <td data-label="Qty">{{$courierProductInfo->qty}}</td>
                                <td data-label="Subtotal">{{$general->cur_sym}}{{getAmount($courierProductInfo->fee)}}</td>
                            </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>

            <div class="row mt-30 mb-none-30">
                <div class="col-lg-12 mb-30">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">@lang('Subtotal'):</th>
                                    <td>{{$general->cur_sym}}{{getAmount($courierPayment->amount)}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Total'):</th>
                                    <td>{{$general->cur_sym}}{{getAmount($courierPayment->amount)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row no-print">
                <div class="col-sm-12">
                    <div class="float-sm-right">
                        <button class="btn btn-primary m-1 printInvoice"><i class="fa fa-download"></i>@lang('Print')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    "use strict";
    $('.printInvoice').click(function () { 
        window.print();
        return false;
    });
</script>
@endpush