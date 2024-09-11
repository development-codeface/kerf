@php
 $testimonialContent = getContent('testimonial.content',true);
 $testimonialElement = getContent('testimonial.element', null, false, true);
@endphp

<div class="client-section ptb-80">
    <div class="client-element-one">
        <img src="{{ getImage('assets/images/shape.png') }}" alt="@lang('shape')">
    </div>
    <div class="client-element-two">
        <img src="{{ getImage('assets/images/shape.png') }}" alt="@lang('shape')">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header d-flex flex-wrap align-items-center justify-content-between">
                    <div class="section-header-left">
                        <h2 class="section-title">{{ __($testimonialContent->data_values->heading) }}</h2>
                        <p class="m-0">{{ __($testimonialContent->data_values->subheading) }} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ml-b-20">
            <div class="col-lg-12 text-center">
                <div class="client-slider">
                    <div class="swiper-wrapper">
                        @foreach($testimonialElement as $testimonial)
                            <div class="swiper-slide">
                                <div class="client-item">
                                    <div class="client-content">
                                        <p>{{ __($testimonial->data_values->quote) }}</p>
                                        <div class="client-icon">
                                            <i class="las la-quote-left"></i>
                                        </div>
                                    </div>
                                    <div class="client-thumb">
                                        <img src="{{ getImage('assets/images/frontend/testimonial/'. @$testimonial->data_values->image, '80x80') }}" alt="@lang('client')">
                                    </div>
                                    <div class="client-footer">
                                        <h4 class="title">{{ __($testimonial->data_values->name) }}</h4>
                                        <span class="sub-title">{{ __($testimonial->data_values->designation) }}</span>
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
