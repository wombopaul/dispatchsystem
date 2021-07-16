@php
   $service = getContent('service.content', true);
   $serviceElements = getContent('service.element');
@endphp
<section class="service-section pt-120 pb-120 bg--title-overlay bg_fixed bg_img" data-background="{{getImage('assets/images/frontend/service/'. @$service->data_values->background_image, '1920x1080')}}">
    <div class="container position-relative">
        <div class="section__header section__header__center text--white">
            <span class="section__cate">
                {{__(@$service->data_values->title)}}
            </span>
            <h3 class="section__title">{{__(@$service->data_values->heading)}}</h3>
            <p>
               {{__(@$service->data_values->sub_heading)}}
            </p>
        </div>
        <div class="row justify-content-center g-4">
           @foreach($serviceElements as $serviceElement)
               <div class="col-md-6 col-sm-10 col-lg-4">
                   <div class="service__item">
                       <div class="service__item-thumb">
                           <img src="{{getImage('assets/images/frontend/service/'. $serviceElement->data_values->image, '128x128')}}" alt="@lang('service image')">
                       </div>
                       <div class="service__item-content">
                           <h5 class="service__item-content-title">{{__($serviceElement->data_values->title)}}</h5>
                           <p>{{__($serviceElement->data_values->description)}}</p>
                       </div>
                   </div>
               </div>
           @endforeach
        </div>
    </div>
</section>

