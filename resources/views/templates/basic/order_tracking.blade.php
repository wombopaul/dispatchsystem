@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
@php 
    $orderTracking = getContent('order_tracking.content', true);
@endphp
     <section class="track-section pt-120 pb-120">
        <div class="container">
            <div class="section__header section__header__center">
                <span class="section__cate">
                    {{__(@$orderTracking->data_values->title)}}
                </span>
                <h3 class="section__title"> {{__(@$orderTracking->data_values->heading)}}</h3>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-xl-6">
                    <form action="{{route('order.tracking')}}" method="GET" class="order-track-form mb-4 mb-md-5">
                        @csrf
                        @method("GET")
                        <div class="order-track-form-group">
                            <input type="text" name="order_number" placeholder="@lang('Enter Your Order Id')" value="{{@$orderNumber->code}}">
                            <button type="submit">@lang('Track Now')</button>
                        </div>
                    </form>
                </div>
            </div>

            @if($orderNumber)
                <div class="track--wrapper">
                    <div class="track__item @if($orderNumber->status == 1 || $orderNumber->status == 0) done @endif">
                        <div class="track__thumb">
                            <i class="las la-briefcase"></i>
                        </div>
                        <div class="track__content">
                            <h5 class="track__title">@lang('Picked')</h5>
                        </div>
                    </div>
                    <div class="track__item @if($orderNumber->status == 1 || $orderNumber->status == 0) done @endif">
                        <div class="track__thumb">
                            <i class="las la-truck-pickup"></i>
                        </div>
                        <div class="track__content">
                            <h5 class="track__title">@lang('Assort')</h5>
                        </div>
                    </div>
                    <div class="track__item @if($orderNumber->status == 1) done @endif">
                        <div class="track__thumb">
                            <i class="lar la-building"></i>
                        </div>
                        <div class="track__content">
                            <h5 class="track__title">@lang('Delivered')</h5>
                        </div>
                    </div>

                    <div class="track__item @if($orderNumber->status == 1 || $orderNumber->paymentInfo->status == 1) done @endif">
                        <div class="track__thumb">
                            <i class="las la-check-circle"></i>
                        </div>
                        <div class="track__content">
                            <h5 class="track__title">@lang('Completed')</h5>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

