@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="blog-section pt-120 pb-120">
    <div class="container">
        <div class="row gy-5 justify-content-center">
            <div class="col-lg-12">
                <div class="post__details">
                    <div class="post__header">
                        @php echo $data->data_values->description @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
