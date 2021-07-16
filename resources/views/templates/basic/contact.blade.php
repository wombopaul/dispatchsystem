@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
    <div class="contact-section pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 d-none d-lg-block rtl pe-xxl-50">
                    <img src="{{getImage('assets/images/frontend/contact_us/'. @$contact->data_values->contact_image, '653x612')}}" alt="@lang('contact')">
                </div>
                <div class="col-lg-6">
                    <div class="section__header">
                        <span class="section__cate">{{__(@$contact->data_values->title)}}</span>
                        <h3 class="section__title">{{__(@$contact->data_values->heading)}}</h3>
                        <p>
                            {{__(@$contact->data_values->sub_heading)}}
                        </p>
                    </div>
                    <form class="contact-form" action="" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form--label">@lang('Your Name')</label>
                            <input type="text" class="form-control form--control" id="name" name="name" value="{{old('name')}}" required="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form--label">@lang('Email Address')</label>
                            <input type="text" class="form-control form--control" id="email" name="email" value="{{old('email')}}" required="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="subject" class="form--label">@lang('Subject')</label>
                            <input type="text" class="form-control form--control" id="subject" name="subject" value="{{old('subject')}}" required="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="message" class="form--label">@lang('Your Message')</label>
                            <textarea name="message" class="form-control form--control" id="message" name="message" required="">{{old('message')}}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="cmn--btn btn--lg rounded" type="submit">@lang('Send Message')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
