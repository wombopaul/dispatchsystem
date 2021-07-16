@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="row gy-5 justify-content-center">
            <div class="col-lg-8">
                <div class="post__details">
                    <div class="post__thumb">
                        <img src="{{getImage('assets/images/frontend/blog/'. $blog->data_values->blog_image, '700x425')}}" alt="@lang('blog')">
                    </div>
                    <div class="post__header">
                        @php echo $blog->data_values->description_nic @endphp
                    </div>
            
                    <div class="row gy-4 justify-content-between">
                        <div class="col-md-6">
                            <h6 class="post__share__title">@lang('Share now')</h6>
                            <ul class="post__share">
                                <li>
                                    <a href="https://www.facebook.com/sharer.php?u={{urlencode(url()->current())}}" target="__blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/share?url={{urlencode(url()->current())}}&text=Simple Share Buttons&hashtags=simplesharebuttons" target="__blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url={{urlencode(url()->current())}}" target="__blank"><i class="fab fa-linkedin-in"></i></a>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="blog-sidebar bg--section">
                    <div class="widget widget__post__area">
                        <h5 class="widget__title">@lang('Recent Post')</h5>
                        <ul>
                        	@foreach($recentBlogs as $recentBlog)
	                            <li>
	                                <a href="{{ route('blog.details',[$recentBlog->id,slug($recentBlog->data_values->title)]) }}" class="widget__post">
	                                    <div class="widget__post__thumb">
	                                        <img src="{{getImage('assets/images/frontend/blog/'. $recentBlog->data_values->blog_image, '700x425')}}" alt="@lang('blog')">
	                                    </div>
	                                    <div class="widget__post__content">
	                                        <h6 class="widget__post__title">
	                                            {{__($recentBlog->data_values->title)}}
	                                        </h6>
	                                        <span>{{ showDateTime($recentBlog->created_at, 'd M Y') }}</span>
	                                    </div>
	                                </a>
	                            </li>
	                        @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@endsection
@push('fbComment')
	@php echo loadFbComment() @endphp
@endpush