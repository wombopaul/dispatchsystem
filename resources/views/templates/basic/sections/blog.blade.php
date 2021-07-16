@php
   $blog = getContent('blog.content', true);
   $blogPosts = getContent('blog.element', false, 3, true);
@endphp

<section class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="section__header section__header__center">
            <span class="section__cate">
                {{__(@$blog->data_values->title)}}
            </span>
            <h3 class="section__title">{{__(@$blog->data_values->heading)}}</h3>
            <p>
                {{__(@$blog->data_values->sub_heading)}}
            </p>
        </div>
        <div class="row g-4 justify-content-center">

           @foreach($blogPosts as $value)
              <div class="col-lg-4 col-md-6 col-sm-10">
                   <div class="post__item">
                       <div class="post__thumb">
                           <a href="{{ route('blog.details',[$value->id,slug($value->data_values->title)]) }}">
                               <img src="{{getImage('assets/images/frontend/blog/'. $value->data_values->blog_image, '700x425')}}" alt="blog">
                           </a>
                           <div class="post__date">
                               <h4 class="date">{{showDateTime($value->created_at, 'd')}}</h4>
                               <span>{{showDateTime($value->created_at, 'M')}}</span>
                           </div>
                       </div>
                       <div class="post__content bg--section">
                           <div class="post__meta">
                             
                                   <i class="las la-user"></i>
                                   <span>@lang('Admin')</span>
                      
                           
                                   <i class="las la-tags"></i>
                                   <span>@lang('Delivery')</span>
                             
                           </div>
                           <h5 class="post__title">
                               <a href="{{ route('blog.details',[$value->id,slug($value->data_values->title)]) }}">{{__($value->data_values->title)}}</a>
                           </h5>
                           <a href="{{ route('blog.details',[$value->id,slug($value->data_values->title)]) }}">@lang('Show More') <i class="las la-long-arrow-alt-right"></i></a>
                       </div>
                   </div>
               </div>
           @endforeach
        </div>
    </div>
</section>
