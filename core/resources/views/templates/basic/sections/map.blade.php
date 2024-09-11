@php
    $contactUsContent = getContent('contact_us.content',true);
@endphp
<!-- map-section start -->
<section class="map-section pd-t-80">
    <div class="container-fluid p-0">
        <div class="row justify-content-center m-0">
            <div class="col-lg-12 p-0">
                <div class="row justify-content-center ml-b-30">
                    <div class="col-lg-12 mrb-30">
                        <div class="maps"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- map-section end -->

@push('script')
    <!-- main -->
    <script src="https://maps.google.com/maps/api/js?key={{$contactUsContent->data_values->google_map_key}}"></script>
    <script src="{{asset($activeTemplateTrue.'js/map.js')}}"></script>
    <script>
        (function ($) {
            "use strict";

            var mapOptions = {
                center: new google.maps.LatLng({{$contactUsContent->data_values->latitude}}, {{$contactUsContent->data_values->longitude}}),
                zoom: 12,
                scrollwheel: true,
                backgroundColor: 'transparent',
                mapTypeControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementsByClassName("maps")[0],
                mapOptions);
            var myLatlng = new google.maps.LatLng({{$contactUsContent->data_values->latitude}}, {{$contactUsContent->data_values->longitude}});
            var focusplace = {lat: {{$contactUsContent->data_values->latitude}} , lng: {{$contactUsContent->data_values->longitude}} };
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
            })
        })(jQuery);
    </script>
@endpush
