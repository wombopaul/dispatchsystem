@php
   $faq = getContent('faq.content', true);
   $faqs = getContent('faq.element', false);
@endphp
<section class="faqs-section pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-between gy-5 align-items-end">
            <div class="col-lg-6">
                <div class="section__header">
                    <span class="section__cate">{{__(@$faq->data_values->title)}}</span>
                    <h3 class="section__title">{{__(@$faq->data_values->heading)}}</h3>
                    <p>
                        {{__(@$faq->data_values->sub_heading)}}
                    </p>
                </div>
                <div class="faq__wrapper">
                    @foreach($faqs as $value)
                       <div class="faq__item">
                           <div class="faq__title">
                               <h5 class="title">{{__($value->data_values->question)}}</h5>
                               <span class="right-icon"></span>
                           </div>
                           <div class="faq__content">
                               <p>
                                   {{__($value->data_values->answer)}}
                               </p>
                           </div>
                       </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="faqs-thumb">
                    <img src="{{getImage('assets/images/frontend/faq/'. @$faq->data_values->faq_image, '651x464')}}" alt="@lang('faqs')">
                </div>
            </div>
        </div>
    </div>
</section>
