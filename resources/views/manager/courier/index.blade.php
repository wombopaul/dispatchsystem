@extends('manager.layouts.app')
@section('panel')
<div class="row">
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
                                   {{showDateTime($courierInfo->created_at, 'd M Y')}}<br>
                                    {{diffForHumans($courierInfo->created_at) }}
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
                                   <a href="{{route('manager.courier.invoice', encrypt($courierInfo->id))}}" title="" class="icon-btn btn--info">@lang('Invoice')</a>
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
            <div class="card-footer py-4">
                {{ paginateLinks($courierInfos) }}
            </div>
        </div>
    </div>
</div>
@endsection



@push('breadcrumb-plugins')
    <form action="{{route('manager.courier.search')}}" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
        <div class="input-group has_append  ">
            <input type="text" name="search" class="form-control" placeholder="@lang('Order Number')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <form action="{{route('manager.courier.search.date',$scope ?? str_replace('manager.courier.', '', request()->route()->getName()))}}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append ">
            <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here form-control" data-position='bottom right' placeholder="@lang('Min date - Max date')" autocomplete="off" value="{{ @$dateSearch }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

@endpush


@push('script-lib')
  <script src="{{ asset('assets/manager/js/vendor/datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/manager/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('script')
  <script>
    (function($){
        "use strict";
        if(!$('.datepicker-here').val()){
            $('.datepicker-here').datepicker();
        }
    })(jQuery)
  </script>
@endpush
