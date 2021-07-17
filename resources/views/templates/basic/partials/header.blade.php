@php
    $footer = getContent('footer.content', true);
@endphp
<header>
    <div class="header-top d-none d-md-block">
        <div class="container">
            <div class="header-top-wrapper">
                <ul class="header-contact-info">
                    <li>
                        <a href="Mailto:{{__(@$footer->data_values->email)}}"><i class="las la-envelope"></i> {{__(@$footer->data_values->email)}}</a>
                    </li>
                    <li>
                        <a href="Tel:{{__(@$footer->data_values->mobile)}}"><i class="las la-phone"></i>{{__(@$footer->data_values->mobile)}}</a>
                    </li>
                </ul>

                <select class="lang-select ms-auto me-4 langChanage">
                    @foreach($language as $item)
                        <option value="{{$item->code}}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                    @endforeach
                </select>
                 <!------------------  Tracking Menu -------------------->
                <div class="right-area d-none d-md-block">
                    <a href="{{ route('order.new') }}" class="cmn--btn btn--sm mr-3" target="_blank" >@lang('Book a Delivery')</a>
                </div>
                <!------------------  Order Menu  -------------------->
                <div class="right-area d-none d-md-block">
                    <a href="{{route('order.tracking')}}" class="cmn--btn btn--sm mr-3">@lang('Order Tracking')</a>
                </div>

                
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header__wrapper">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')">
                    </a>
                </div>
                <div class="header-bar ms-auto d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="menu-area align-items-center ">
                    <div class="d-lg-none cross--btn">
                        <i class="las la-times"></i>
                    </div>
                    <div class="right-area d-md-none text-center mb-4">
                        <select class="lang-select ms-auto m-3 langChanage">
                            @foreach($language as $item)
                                <option value="{{$item->code}}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                            @endforeach
                        </select>

                        <a href="{{route('order.tracking')}}" class="cmn--btn btn--sm mr-3">@lang('Order Tracking')</a>
                        
                        <ul class="header-contact-info">
                            <li>
                                <a href="Mailto:{{__(@$footer->data_values->email)}}"><i class="las la-email"></i> {{__(@$footer->data_values->email)}}</a>
                            </li>
                            <li>
                                <a href="Tel:{{__(@$footer->data_values->mobile)}}"><i class="las la-phone"></i>{{__(@$footer->data_values->mobile)}}</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="menu">
                        <li><a href="{{route('home')}}">@lang('Home')</a></li>
                        @foreach($pages as $k => $data)
                            <li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
