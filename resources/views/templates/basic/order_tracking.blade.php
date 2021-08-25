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
                            <h5 class="track__title">@lang('On Transit')</h5>
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
                <div class="row mt-4">
                       
                        <div class="container mt-3" style="text-align:center">
                                <h4>You can View Drivers Location below:</h4>
                            <a href="#" data-lat="-15,25" data-toggle="modal" data-target="#myMapModal" class="btn btn-primary">Drivers Map</a>
                        </div>


                        <div class="modal fade x " id="myMapModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title w-120">GNEXT Drivers Map<span id="lat" class="float-right"></span></h4>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div id="map-canvas" class=""></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
            @endif
        </div>
    </section>
@endsection

