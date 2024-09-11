@extends('assistant.layouts.master')

@section('content')
    <div class="page-wrapper default-version">
        @include('assistant.partials.sidenav')
        @include('assistant.partials.topnav')
        <div class="body-wrapper">
            <div class="bodywrapper__inner">
                @include('assistant.partials.breadcrumb')
                @yield('panel')
            </div>
        </div>
    </div>

@endsection

