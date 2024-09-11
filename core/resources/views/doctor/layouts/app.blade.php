@extends('doctor.layouts.master')

@section('content')
    <div class="page-wrapper default-version">
        @include('doctor.partials.sidenav')
        @include('doctor.partials.topnav')
        <div class="body-wrapper">
            <div class="bodywrapper__inner">
                @include('doctor.partials.breadcrumb')
                @yield('panel')
            </div>
        </div>
    </div>

@endsection

