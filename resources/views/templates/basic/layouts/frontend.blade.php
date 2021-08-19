<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $general->sitename(__($pageTitle)) }}</title>
    @laravelPWA
    @include('partials.seo')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'frontend/css/custom.css') }}">
    <link rel="shortcut icon" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" type="@lang('image/x-icon')">
    <link href="{{ asset($activeTemplateTrue . 'frontend/css/color.php') }}?color={{$general->base_color}}" rel="stylesheet"/>
    @stack('style-lib')
    @stack('style')
    <style>
        .rotate-x{
                background-color: green !important;
            }
        </style>
</head>

<body>
    @stack('fbComment')
    <div class="overlay"></div>
    <div id="modal-placeholder"></div>
    <a href="#0" class="scrollToTop"><i class="las la-angle-up"></i></a>
    <div class="preloader">
        <div class="loader"></div>
    </div>
    @include($activeTemplate . 'partials.header')
    @yield('content')
    @include($activeTemplate . 'partials.footer')
    {{-- @php
        $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
    @endphp --}}




    {{-- <div class="cookie__wrapper @if(session('cookie_accepted')) d-none @endif">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-between">
            <p class="txt my-2">
              @php echo @$cookie->data_values->description @endphp<br>
              <a href="{{ @$cookie->data_values->link }}" target="_blank">@lang('Read Policy')</a>
            </p>
              <button class="cmn--btn my-2 policy">@lang('Accept')</button>
          </div>
        </div>
    </div> --}}
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script  defer src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=AIzaSyA5l7mjh_T5UCviwCoPTeRaUT-5tF_C7sU"  type="text/javascript"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/autoMatrix.js')}}"></script> 
    <script src="{{asset($activeTemplateTrue.'frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/jquery3.1.1.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/jquery.validate.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/rafcounter.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/lightbox.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/wow.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/owl.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/viewport.jquery.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/select2.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/main.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/common_scripts.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/functions.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/survey_func.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/bootstrap4.0.0.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/interswitch.js')}}"></script>
    <script type="text/javascript" src="https://qa.interswitchng.com/collections/public/javascripts/inline-checkout.js"></script>
  
    @stack('script-lib')
    @stack('script')
    @include('partials.plugins')
    @include('partials.notify')
    <script>
       $('document').ready(function() {
            "use strict";
            $(".langChanage").on("change", function() {
                window.location.href = "{{route('home')}}/change/"+$(this).val() ;
            });
            @if(@$cookie->data_values->status && !session('cookie_accepted'))
                $('#cookieModal').modal('show');
            @endif

            $('.policy').on('click',function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{{ route('cookie.accept') }}', function(response){
                $('.cookie__wrapper').addClass('d-none');
            });
        });
        });

    </script>
    <script asp-append-version="true">
        $(document).ready(function () {
            var placeholderElement = $('#modal-placeholder');

            $(document).on('click', '.modal-validate', function (event) {
                // on();
                var url = $(this).data('url');
                $.get(url).done(function (data) {
                    // off();
                    placeholderElement.html(data);
                    placeholderElement.find('.modal').modal('show');
                });

                $.validator.setDefaults({
                    submitHandler: function (form) {
                        var urlTarget = $(form).data('targeturl');

                        var targetDiv = $(form).data('targetdiv');
                        //alert(targetDiv);
                        var actionUrl = $(form).attr('action');
                        var dataToSend = new FormData($(form)[0]); // $(form).serialize();// new FormData($(form)[0]);
                        $.ajax({
                            type: "POST",
                            url: actionUrl,
                            data: dataToSend,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                off();
                                if (data.status) {
                                    placeholderElement.find('.modal').modal('hide');
                                    toastr.success(data.msg);
                                    if (urlTarget != null && targetDiv == "innerTab") {
                                        LoadInnerTab(urlTarget);
                                    }
                                    if (urlTarget != null && targetDiv != "innerTab") {
                                        Load(urlTarget);
                                    }
                                }
                                else {
                                    placeholderElement.find('#msg').addClass('alert alert-danger').text(data.msg).show();
                                    toastr.error(data.msg);
                                    off();

                                }
                            }
                        });
                        off();
                        return false;
                    }
                });
                // custom validation for blob (images and select)

                $.validator.addMethod("mprequired", function (value, element) {
                    if ((value > 0 && value !== null) || value.length > 0) {
                        return value;
                    }
                }, $.validator.messages.required)
            });

        });

    </script>
    
        
    
        @php
        $globalInclude = false;
        echo $globalInclude;
        @endphp
    <script type="text/javascript">
            //Use the id of the form instead of #change
        $('#change').click(function(){
        //this is just getting the value that is selected
        var title = "Weight Calculator";
        $('.modal-title').html(title);
        $('.modal').modal('show');
        $(".btnClose").click(function(){
                $(".modal").modal('hide');
            });
        });

 
        $(function(){
            $('#value1, #value2, #value3').keyup(function(){
            var value1 = parseFloat($('#value1').val()) || 0;
            var value2 = parseFloat($('#value2').val()) || 0;
            var value3 = parseFloat($('#value3').val()) || 0;
            $('#sum').val(value1 * value2 * value3);
            });
         });
  </script>   

</body>

</html>



