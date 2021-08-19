@php
    $footer = getContent('footer.content', true);
    $footer_menu = getContent('footer.element', false);
    $socialIcons = getContent('social_icon.element');
@endphp
<footer class="footer-section bg--title-overlay bg_img bg_fixed" data-background="{{getImage('assets/images/frontend/footer/'. $footer->data_values->background_image, '1920x1080')}}" style="position:relative; background-color:#34436A">
    {{-- <div class="footer-top pt-120 pb-120 position-relative">
        <div class="container">
            <div class="row gy-5 justify-content-between">
                <div class="col-lg-3">
                    <div class="footer__widget">
                        <div class="logo">
                            <a href="{{route('home')}}">
                                <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('logo')">
                            </a>
                        </div>
                        <p>
                           {{__($footer->data_values->heading)}}
                        </p>
                        <ul class="social-icons justify-content-start">
                            @foreach($socialIcons as $socialIcon)
                                <li>
                                    <a href="{{$socialIcon->data_values->url}}" target="__blank">@php echo $socialIcon->data_values->social_icon @endphp</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="footer__widget">
                        <h5 class="title text--white">@lang('Company')</h5>
                        <ul class="useful-link">
                            <li>
                                <a href="{{route('home')}}">@lang('Home')</a>
                            </li>
                            @foreach($pages->take(3) as $k => $data)
                                <li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="footer__widget">
                        <h5 class="title text--white">@lang('Useful Link')</h5>
                        <ul class="useful-link">
                            <li>
                                <a href="{{route('order.tracking')}}">@lang('Order Tracking')</a>
                            </li>
                            @foreach($footerPages as $k => $data)
                                <li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="footer__widget">
                        <h5 class="title text--white">@lang('Useful Link')</h5>
                        <ul class="useful-link">
                            @foreach($footer_menu as $value)
                                <li>
                                    <a href="{{route('footer.menu', [slug($value->data_values->menu), $value->id])}}">{{__($value->data_values->menu)}}</a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ route('contact') }}">@lang('Support')</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer__widget">
                        <h5 class="title text--white">@lang('Get In Touch')</h5>
                        <ul class="footer__widget-contact">
                            <li>
                                <i class="las la-map-marker"></i> {{__($footer->data_values->address)}}
                            </li>
                            <li>
                                <i class="las la-mobile"></i> @lang('Mobile'):  {{__($footer->data_values->mobile)}}
                            </li>
                            <li>
                                <i class="las la-fax"></i> @lang('Fax') :  {{__($footer->data_values->fax)}}
                            </li>
                            <li>
                                <i class="las la-envelope"></i>  {{__($footer->data_values->email)}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="footer-bottom position-relative text-center">
        <div class="container">
            &copy; @lang('All Right Reserved by') <a href="{{route('home')}}">{{__($general->sitename)}}</a>
        </div>
    </div>
</footer>
