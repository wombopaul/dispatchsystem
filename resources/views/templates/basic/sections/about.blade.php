@php
   $about = getContent('about.content', true);
   $aboutElements = getContent('about.element');
@endphp
    <section class="about-section pt-60 overflow-hidden">
        <div class="container">
            <div class="row gy-5 justify-content-between">
                <div class="col-xl-6 align-self-center">
                    <div class="about__content pb-120">
                        <div class="section__header">
                            <span class="section__cate">{{__(@$about->data_values->title)}}</span>
                            <h3 class="section__title">{{__(@$about->data_values->heading)}}</h3>
                            <p>
                                {{__(@$about->data_values->sub_heading)}}
                            </p>
                        </div>
                        <div class="">
                           @foreach($aboutElements as $aboutElement)
                              <div class="about__item">
                                   <div class="about__item-icon">
                                      @php echo $aboutElement->data_values->about_icon @endphp
                                   </div>
                                   <div class="about__item-content">
                                       <h6 class="about__item-content-title">{{__($aboutElement->data_values->title)}}</h6>
                                       <p>
                                          {{__($aboutElement->data_values->sub_title)}}
                                       </p>
                                   </div>
                              </div>
                           @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-5 align-self-end">
                    <div class="about__thumb">
                        <img src="{{getImage('assets/images/frontend/about/'. @$about->data_values->background_image, '750x732')}}" alt="@lang('about image')" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>

