@extends('manager.layouts.app')
@section('panel')
    <div class="row mt-50 mb-none-30">
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--19 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$totalStaffCount}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Staff')</span>
                    </div>
                    <a href="{{route('manager.staff.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-hand-holding-usd"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$branchListCount}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Branch')</span>
                    </div>
                    <a href="{{ route('manager.branch.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
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
                        <span class="amount">{{getAmount($branchIncome)}}</span>
                        <span class="currency-sign">{{__($general->cur_text)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Branch Income')</span>
                    </div>

                    <a href="{{route('manager.income.courier')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--6 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$courierInfoCount}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Courier')</span>
                    </div>

                    <a href="{{route('manager.courier.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-50">
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
                        @forelse($courierInfos as $courierInfo)
                            <tr>
                                <td data-label="@lang('Sender Branch')">
                                    <span>{{__($courierInfo->senderBranch->name)}}</span><br>
                                    <a href="{{route('manager.staff.edit', encrypt($courierInfo->senderStaff->id))}}"><span>@</span>{{__($courierInfo->senderStaff->username)}}</a>
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
                                        <a href="{{route('manager.staff.edit', encrypt($courierInfo->receiverStaff->id))}}"><span>@</span>{{__($courierInfo->receiverStaff->username)}}</a>
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
                                   <a href="{{route('manager.courier.invoice', $courierInfo->id)}}" title="" class="icon-btn btn--info">@lang('Invoice')</a>
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
@endsection


