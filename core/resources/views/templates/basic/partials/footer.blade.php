@php
$footerContent = getContent('footer.content', true);
$contactElement = getContent('contact_us.element', false);
$subscribeContent = getContent('subscribe.content', true);
$socialIcons = getContent('social_icon.element', false, null, true);

$departments = \App\Models\Department::orderBy('id', 'DESC')->take(6)->get();
$locations = \App\Models\Location::orderBy('id', 'DESC')->take(6)->get();
@endphp

<!-- call-to-action section start -->
<section class="call-to-action-section">
    <div class="container">
        <div class="row justify-content-center align-self-center">
            <div class="col-lg-8 text-center">
                <div class="call-to-action-area">
                    <div class="call-info">
                        <div class="call-info-thumb">
                            <img src="{{ getImage('assets/images/frontend/footer/' . @$footerContent->data_values->emergency_contact_image) }}"
                                alt="@lang('Emergency Contact')">
                        </div>
                        <div class="call-info-content">
                            <h4 class="title">
                                <span>@lang('Emergency Call')</span>
                                <a hre="tel:{{ @$footerContent->data_values->emergency_contact }}">
                                    {{ __($footerContent->data_values->emergency_contact) }}</a>
                            </h4>
                        </div>
                    </div>
                    <div class="mail-info">
                        <div class="mail-info-thumb">
                            <img src="{{ getImage('assets/images/frontend/footer/' . @$footerContent->data_values->emergency_email_image) }}"
                                alt="@lang('Emergency E-mail')">
                        </div>
                        <div class="mail-info-content">
                            <h4 class="title">
                                <span>@lang('24/7 Email Support')</span>
                                <a
                                    href="mailto:{{ @$footerContent->data_values->emergency_email }}">{{ __($footerContent->data_values->emergency_email) }}</a>
                            </h4>
                        </div>
                    </div>
                    <span class="dc-or-text">- @lang('OR') -</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- call-to-action section end -->

<!-- footer-section start -->
<!-- <footer class="footer-section ptb-80">
    <div class="custom-container">
        <div class="footer-area">
            <div class="row ml-b-30">
                <div class="col-lg-4 col-sm-6 mrb-30">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}" class="site-logo">
                                <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="logo"></a>
                        </div>
                        <p>{{ __($footerContent->data_values->footer_details) }}</p>
                        <ul class="footer-contact">
                            @foreach ($contactElement as $contact)
                                <li>@php echo $contact->data_values->contact_icon @endphp {{ __($contact->data_values->content) }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 mrb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title">@lang('Department Based')</h3>
                        <ul class="footer-menus">
                            @foreach ($departments as $department)
                                <li><a href="{{ route('doctors.departments',$department->id) }}"><i class="fas fa-long-arrow-alt-right"></i>{{ __($department->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 mrb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title">@lang('Area Based')</h3>
                        <ul class="footer-menus">
                            @foreach ($locations as $location)
                                <li><a href="{{ route('doctors.locations',$location->id) }}"><i class="fas fa-long-arrow-alt-right"></i>{{ __($location->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mrb-30">
                    <div class="footer-widget">
                        <h3 class="widget-title">{{ __($subscribeContent->data_values->heading) }}</h3>
                        <p>{{ __($subscribeContent->data_values->subheading) }}</p>
                        <form class="footer-form">
                            <input type="email" name="email" id="subscriber" placeholder="@lang('Enter Your Email')"
                                autocomplete="off">
                            <button type="submit" class="submit-btn"><i class="lab la-telegram-plane"></i></button>
                        </form>
                        <div class="social-area">
                            <ul class="footer-social">
                                @foreach ($socialIcons as $social)
                                    <li><a href="{{ $social->data_values->url }}" target="_blank">
                                        @php echo $social->data_values->social_icon @endphp</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> -->

<!-- <div class="privacy-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="copyright-area d-flex flex-wrap align-items-center justify-content-center">
                    <div class="copyright">
                        <p>@lang('Copyright') &copy; {{ \Carbon\Carbon::now()->format('Y') }} | @lang('All Rights Reserved')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div style="background-color: #2eb7b7;">

    <div class="j8n-footer-container container">
        <p class="k3m-copyright">
            Ⓒ 2024 KERF Hospital. All rights reserved | Designed by
            <a href="https://codefacetech.com/" target="_blank" class="l2p-designer-link">Codeface Technologies</a>
        </p>
    </div>
</div>

@push('script')
<script>
    'use strict';

    $(function() {

        $('.footer-form').on('submit', function(event) {
            event.preventDefault();
            let url = `{{ route('subscribe') }}`;

            let data = {
                email: $(this).find('input[name=email]').val()
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.post(url, data, function(response) {
                if (response.errors) {
                    for (var i = 0; i < response.errors.length; i++) {
                        iziToast.error({
                            message: response.errors[i],
                            position: "topRight"
                        });
                    }
                } else {
                    $('.footer-form').trigger("reset");
                    iziToast.success({
                        message: response.success,
                        position: "topRight"
                    });
                }
            });
            this.reset();
        })
    })
</script>
@endpush