<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename($pageTitle ?? '') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/manager/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/bootstrap-toggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/line-awesome.min.css')}}">
    @stack('style-lib')
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/prism.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/jquery-jvectormap-2.0.5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/jquery-timepicky.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/bootstrap-clockpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/vendor/bootstrap-pincode-input.css')}}">
    <link rel="stylesheet" href="{{asset('assets/manager/css/app.css')}}">
    @stack('style')
</head>
<body>
@yield('content')

<script src="{{asset('assets/manager/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/manager/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/manager/js/vendor/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('assets/manager/js/vendor/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/manager/js/vendor/jquery.nice-select.min.js')}}"></script>
@include('partials.notify')
@stack('script-lib')
<script src="{{ asset('assets/manager/js/nicEdit.js') }}"></script>
<script src="{{asset('assets/manager/js/vendor/prism.js')}}"></script>
<script src="{{asset('assets/manager/js/vendor/select2.min.js')}}"></script>
<script src="{{asset('assets/manager/js/app.js')}}"></script>
<script>
    "use strict";
    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });
    (function($){
        $( document ).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain',function(){
            $('.nicEdit-main').focus();
        });
    })(jQuery);
</script>
@stack('script')
</body>
</html>
