@extends('staff.layouts.app')
@section('panel')
    <div class="row mt-50 mb-none-30">
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--19 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$sendCourierCount}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Dispatch Courier')</span>
                    </div>
                    <a href="{{route('staff.send.courier.list')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$receivedCourierCount}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Received Courier')</span>
                    </div>
                    <a href="{{route('staff.received.courier.list')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-money-bill-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$branchCount}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Brach')</span>
                    </div>

                    <a href="{{route('staff.branch.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--6 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-hand-holding-usd"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$general->cur_sym}}{{getAmount($cashCollection)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Cash Collection')</span>
                    </div>

                    <a href="{{route('staff.cash.income')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-30">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Sender Branch - Staff')</th>
                                    <th>@lang('Receiver Branch - Staff')</th>
                                    <th>@lang('Amount - Order Number')</th>
                                    <th>@lang('Creations Date')</th>
                                    <th>@lang('Payment Status')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($courierDeliveys as $courierInfo)
                                <tr>
                                    <td data-label="@lang('Sender Branch')">
                                    <span>{{__($courierInfo->senderBranch->name)}}</span><br>
                                    {{__($courierInfo->senderStaff->fullname)}}
                                </td>

                                <td data-label="@lang('Receiver Branch - Staff')">
                                    <span>
                                        @if($courierInfo->receiver_branch_id)
                                            {{__($courierInfo->receiverBranch->name)}}
                                        @else
                                            @lang('N/A')
                                        @endif
                                    </span>
                                    <br>
                                    @if($courierInfo->receiver_staff_id)
                                        {{__($courierInfo->receiverStaff->fullname)}}
                                    @else
                                        <span>@lang('N/A')</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Amount Order Number')">
                                    <span class="font-weight-bold">{{getAmount($courierInfo->paymentInfo->amount)}} {{ $general->cur_text }}</span><br>
                                    <span>{{__($courierInfo->code) }}</span>
                                </td>

                                 <td data-label="@lang('Creations Date')">
                                    <span>{{showDateTime($courierInfo->created_at, 'd M Y')}}</span><br>
                                    <span>{{diffForHumans($courierInfo->created_at) }}</span>
                                </td>

                                    <td data-label="@lang('Payment Status')">
                                        @if($courierInfo->paymentInfo->status == 1)
                                            <span class="badge badge--success">@lang('Paid')</span>
                                        @elseif($courierInfo->paymentInfo->status == 0)
                                            <span class="badge badge--danger">@lang('Unpaid')</span>
                                        @endif
                                    </td>

                                    

                                    <td data-label="@lang('Status')">
                                        @if($courierInfo->status == 0)
                                            <span class="badge badge--primary">@lang('Received')</span>
                                        @elseif($courierInfo->status == 1)
                                            <span class="badge badge--success">@lang('Delivery')</span>
                                        @endif
                                    </td>
                                
                                    <td data-label="@lang('Action')">
                                        @if($courierInfo->status  == 0 && $courierInfo->paymentInfo->status == 1)
                                            <a href="javascript:void(0)" title="" class="icon-btn btn--info ml-1 delivery" data-code="{{$courierInfo->code}}">@lang('Delivery')</a>
                                        @endif
                                        @if($courierInfo->status  == 0 && $courierInfo->paymentInfo->status == 0)
                                            <a href="javascript:void(0)" title="" class="icon-btn btn--success ml-1 payment" data-code="{{$courierInfo->code}}">@lang('Payment')</a>
                                        @endif
                                       <a href="{{route('staff.courier.invoice', encrypt($courierInfo->id))}}" title="" class="icon-btn bg--10 ml-1">@lang('Invoice')</a>
                                       <a href="{{route('staff.courier.details', encrypt($courierInfo->id))}}" title="" class="icon-btn btn--priamry ml-1">@lang('Details')</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="modal fade" id="paymentBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Payment Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            
            <form action="{{route('staff.courier.payment')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="code">
                <div class="modal-body">
                    <p>@lang('Are you sure to collect this amount?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Yes')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="deliveryBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Delivery Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            
            <form action="{{route('staff.courier.delivery')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="code">
                <div class="modal-body">
                    <p>@lang('Are you sure to delivery this courier?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



@push('script')
<script>
    'use strict';
    $('.payment').on('click', function () {
        var modal = $('#paymentBy');
        modal.find('input[name=code]').val($(this).data('code'))
        modal.modal('show');
    });

    $('.delivery').on('click', function () {
        var modal = $('#deliveryBy');
        modal.find('input[name=code]').val($(this).data('code'))
        modal.modal('show');
    });
</script>
@endpush

