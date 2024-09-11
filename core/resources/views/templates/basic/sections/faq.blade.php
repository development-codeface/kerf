@php
    $faqContent = getContent('faq.content',true);
    $faqElement = getContent('faq.element',null, false, true);
@endphp
<section class="faq-section pd-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header">
                    <h2 class="section-title">{{ __($faqContent->data_values->heading) }}</h2>
                    <p class="m-0">{{ __($faqContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ml-b-30">
            <div class="col-lg-6 mrb-30">
                <div class="faq-wrapper">
                    @foreach($faqElement as $faq)
                        @if($loop->odd)
                            <div class="faq-item">
                                <h3 class="faq-title"><span class="title">{{ __($faq->data_values->question) }} </span><span class="right-icon"></span></h3>
                                <div class="faq-content">
                                    <p>{{ __($faq->data_values->answer) }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 mrb-30">
                <div class="faq-wrapper">
                    @foreach($faqElement as $faq)
                        @if($loop->even)
                            <div class="faq-item">
                                <h3 class="faq-title"><span class="title">{{ __($faq->data_values->question) }} </span><span class="right-icon"></span></h3>
                                <div class="faq-content">
                                    <p>{{ __($faq->data_values->answer) }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
