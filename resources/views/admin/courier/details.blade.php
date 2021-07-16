@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Sender Staff')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Fullname')
                            <span class="font-weight-bold">{{__($courierInfo->senderStaff->fullname)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span class="font-weight-bold">{{__($courierInfo->senderStaff->email)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Branch')
                            <span class="font-weight-bold">{{__($courierInfo->senderBranch->name)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @if($courierInfo->senderStaff->status == 1)
                                <span class="badge badge-pill bg--success">@lang('Active')</span>
                            @elseif($courierInfo->senderStaff->status == 0)
                                <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            @if($courierInfo->receiver_staff_id)
                <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                    <div class="card-body">
                        <h5 class="mb-20 text-muted">@lang('Receiver Staff')</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Fullname')
                                <span class="font-weight-bold">{{__($courierInfo->receiverStaff->fullname)}}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Email')
                                <span class="font-weight-bold">{{__($courierInfo->receiverStaff->email)}}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Branch')
                                <span class="font-weight-bold">{{__($courierInfo->receiverBranch->name)}}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Status')
                                @if($courierInfo->receiverStaff->status == 1)
                                    <span class="badge badge-pill bg--success">@lang('Active')</span>
                                @elseif($courierInfo->receiverStaff->status == 0)
                                    <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 col-sm-12 mt-10">
            <div class="row mb-30">
                <div class="col-lg-6 mt-2">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Sender Information')</h5>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Name')
                                  <span>{{__($courierInfo->sender_name)}}</span>
                                </li>
                            
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Email')
                                  <span>{{__($courierInfo->sender_email)}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Phone')
                                    <span>{{__($courierInfo->sender_phone)}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Address')
                                  <span>{{__($courierInfo->sender_address)}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Order Number')
                                  <span>{{__($courierInfo->code)}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-2">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Receiver Information')</h5>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Name')
                                  <span>{{__($courierInfo->receiver_name)}}</span>
                                </li>
                            
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Email')
                                  <span>{{__($courierInfo->receiver_email)}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Phone')
                                    <span>{{__($courierInfo->receiver_phone)}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Address')
                                  <span>{{__($courierInfo->receiver_address)}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Status')
                                    @if($courierInfo->status == 0)
                                        <span class="badge badge--primary">@lang('Received')</span>
                                    @elseif($courierInfo->status == 1)
                                        <span class="badge badge--success">@lang('Delivery')</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-30">
                <div class="col-lg-12">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Courier Details')</h5>
                        <div class="card-body">
                            <div class="table-responsive--md  table-responsive">
                                <table class="table table--light style--two">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('Courier Type')</th>
                                            <th scope="col">@lang('Quantity')</th>
                                            <th scope="col">@lang('Fee')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courierInfo->courierDetail  as $courier)
                                        <tr>
                                            <td data-label="@lang('Courier Type')">
                                                {{$courier->type->name}}
                                            </td>
                                            <td data-label="@lang('Quantity')">{{$courier->qty}}</td>
                                            <td data-label="@lang('Price')">{{getAmount($courier->fee)}} {{$general->cur_text}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-30">
                <div class="col-lg-12 mt-2">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Payment Information')</h5>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Receiver Name')
                                    @if(!empty($courierInfo->paymentInfo->receiver_id))
                                        <span>{{__($courierInfo->paymentInfo->receiver->username)}}</span>
                                    @else
                                        <span>@lang('N/A')</span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Receiver Branch')
                                    @if(!empty($courierInfo->paymentInfo->branch_id))
                                        <span>{{__($courierInfo->paymentInfo->brach->name)}}</span>
                                    @else
                                        <span>@lang('N/A')</span>
                                    @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Date')
                                    @if(!empty($courierInfo->paymentInfo->date))
                                        <span>{{showDateTime($courierInfo->date, 'd M Y')}}</span>
                                    @else
                                        <span>@lang('N/A')</span>
                                    @endif
                                </li>

                                 <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Amount')
                                  <span>{{getAmount($courierInfo->paymentInfo->amount)}} {{$general->cur_text}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Status')
                                    @if($courierInfo->paymentInfo->status == 1)
                                        <span class="badge badge--success">@lang('Paid')</span>
                                    @else
                                        <span class="badge badge--danger">@lang('Unpaid')</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.courier.info.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="la la-fw la-backward"></i>@lang('Go Back')</a>
@endpush