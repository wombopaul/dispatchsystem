@extends('manager.layouts.master')
@section('content')
    <div class="page-wrapper default-version">
        @include('manager.partials.sidenav')
        @include('manager.partials.topnav')
        <div class="body-wrapper">
            <div class="bodywrapper__inner">
                @include('manager.partials.breadcrumb')
                @yield('panel')
            </div>
        </div>
    </div>
@endsection
