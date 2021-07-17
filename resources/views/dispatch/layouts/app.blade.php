<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename($pageTitle ?? '') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dispatch/css/opensans-font.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/staff/css/vendor/bootstrap.min.css') }}"> -->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/dispatch/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">
	<!-- datepicker -->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/dispatch/css/jquery-ui.min.css')}}">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="{{asset('assets/dispatch/css/style.css')}}"/>
    @stack('style')
</head>
<body>

        @yield('content')
 

<script src="{{asset('assets/dispatch/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/dispatch/js/jquery.steps.js')}}"></script>
<script src="{{asset('assets/dispatch/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/dispatch/js/main.js')}}"></script>

<script src="{{ asset('/dispatch/vendors/bootrap/css/bootstrap.min.cssnicEdit.js') }}"></script>
<script src="{{ asset('/dispatch/vendors/bootrap/js/bootstrap.min.js') }}"></script>
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

<script>
//    $(function(){
//       $(".form-row").hide() // try to hide google navigation bar
//     $("").hide()
//    });
</script>

