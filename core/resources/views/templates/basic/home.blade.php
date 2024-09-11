@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $socialElement = getContent('social_icon.element', false, null, true);
        $bannerElement = getContent('banner.element', false, null, true);
    @endphp

<section class="banner">
    @if (count($socialElement) > 0)
    <div class="banner-social-area">
        <span>@lang('Follow Us')</span>
        <ul class="banner-social">
            @foreach ($socialElement as $social)
            <li><a href="{{ $social->data_values->url }}" target="_blank">@php echo $social->data_values->social_icon @endphp</a></li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="banner-slider">
        <div class="swiper-wrapper">
            @foreach ($bannerElement as $banner)
            <div class="swiper-slide">
                <div class="banner-section bg-overlay-white bg_img"
                    data-background="{{ getImage('assets/images/frontend/banner/' . @$banner->data_values->image, '1150x700') }}">
                    <div class="custom-container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-6 text-center">
                                <div class="banner-content">
                                    <h2 class="title">{{ __($banner->data_values->heading) }}</h2>
                                    <p>{{ __($banner->data_values->subheading) }}</p>
                                    <div class="banner-btn">
                                        <a href="{{ route('doctors.all') }}" class="btn cmn-btn">@lang('Make Appointment')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
@if ($sections->secs != null)
@foreach (json_decode($sections->secs) as $sec)
@include($activeTemplate . 'sections.' . $sec)
@endforeach
@endif
@endsection
