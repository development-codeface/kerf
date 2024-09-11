@php
    $partnerElement = getContent('partner.element',false);
@endphp
<!-- brand-section start -->
<div class="brand-section pd-t-80">
    <div class="container">
        <div class="row ml-b-20">
            <div class="col-lg-12">
                <div class="brand-wrapper">
                    <div class="swiper-wrapper">
                        @foreach($partnerElement as $partner)
                            <div class="swiper-slide">
                                <div class="BrandSlider">
                                    <div class="brand-item">
                                        <a href="{{$partner->data_values->url}}" target="_blank"><img src="{{ getImage('assets/images/frontend/partner/'. @$partner->data_values->image, '120x48') }}" alt="@lang('partner')"></a>
                                    </div>
                                </div>
                            </div>
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- brand-section end -->
