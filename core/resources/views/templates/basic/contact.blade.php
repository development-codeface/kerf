@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $contactUsContent = getContent('contact_us.content', true);
        $contactUsElement = getContent('contact_us.element', null, false, true);
    @endphp

    <section class="contact-item-section pd-t-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="contact-form-area">
                        <div class="row ml-b-30">
                            @foreach ($contactUsElement as $contact)
                                <div class="col-lg-4 col-md-6 col-sm-8 mrb-30">
                                    <div class="contact-item d-flex flex-wrap align-items-center">
                                        <div class="contact-item-icon">
                                            @php echo @$contact->data_values->contact_icon @endphp
                                        </div>
                                        <div class="contact-item-details">
                                            <h5 class="title">{{ __(@$contact->data_values->title) }}</h5>
                                            <ul class="contact-contact-list">
                                                <li>{{ __($contact->data_values->content) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-item-section end -->

    <!-- contact-section start -->
    <section class="contact-section ptb-80">
        <div class="container">
            <div class="row justify-content-center mrb-40">
                <div class="col-lg-12">
                    <div class="contact-form-area">
                        <div class="section-header">
                            <h2 class="section-title">{{ __($contactUsContent->data_values->heading) }}</h2>
                            <p class="m-0">{{ __($contactUsContent->data_values->subheading) }}</p>
                        </div>
                        <form class="contact-form verify-gcaptcha" action=" {{ route('contact')}}" method="POST">
                            @csrf
                            <div class="row justify-content-center ml-b-20">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="@lang('Your Name')"
                                            value="{{ old('name') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="@lang('Your Email')"
                                            value="{{ old('email') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="subject" placeholder="@lang('Subject')"
                                            value="{{ old('subject') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <textarea placeholder="@lang('Your Message')" name="message">{{ old('message') }}</textarea>
                                    </div>

                                    <x-captcha />

                                </div>
                                <button type="submit" class="submit-btn">@lang('Send Message')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->

    <!-- map-section start -->
    <section class="map-section mrb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="map-area">
                        <div class="row justify-content-center ml-b-30">
                            <div class="col-lg-12 mrb-30">
                                <div class="maps"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- map-section end -->
@endsection

@push('script-lib')
    <script src="https://maps.google.com/maps/api/js?key={{ $contactUsContent->data_values->google_map_key }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/map.js') }}"></script>
@endpush

@push('script')
    <!-- main -->
    <script>
        (function($) {
            'use strict';
            var mapOptions = {
                center: new google.maps.LatLng({{ @$contactUsContent->data_values->latitude }},
                    {{ @$contactUsContent->data_values->longitude }}),
                zoom: 12,
                scrollwheel: true,
                backgroundColor: 'transparent',
                mapTypeControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementsByClassName("maps")[0],
                mapOptions);
            var myLatlng = new google.maps.LatLng({{ @$contactUsContent->data_values->latitude }},
                {{ @$contactUsContent->data_values->longitude }});
            var focusplace = {
                lat: {{ @$contactUsContent->data_values->latitude }},
                lng: {{ @$contactUsContent->data_values->longitude }}
            };
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
            })
        })(jQuery);
    </script>
@endpush
