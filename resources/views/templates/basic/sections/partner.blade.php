@php
   $partners = getContent('partner.element', false);
@endphp
<div class="partner-section pt-80 pb-80">
    <div class="container">
        <div class="partner-slider owl-theme owl-carousel">
            @foreach($partners as $partner)
                <a class="partner-thumb" href="javascript:void(0)">
                    <img src="{{getImage('assets/images/frontend/partner/'. $partner->data_values->partner_image, '133x44')}}" alt="@lang('partner')">
                    <img src="{{getImage('assets/images/frontend/partner/'. $partner->data_values->partner_image, '133x44')}}" alt="@lang('partner')">
                </a>
            @endforeach
        </div>
    </div>
</div>
