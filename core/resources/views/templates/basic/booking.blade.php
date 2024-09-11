@extends($activeTemplate . 'layouts.frontend')
@section('content')
<!-- booking-section start -->
<section class="booking-section booking-section-two pd-t-80 pd-b-40 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="booking-item d-flex flex-wrap align-items-center justify-content-between mb-5">
                    <div class="booking-left d-flex align-items-center">
                        <div class="booking-thumb">
                            <img src="{{ getImage(getFilePath('doctorProfile') . '/' . $doctor->image, getFileSize('doctorProfile')) }}"
                                alt="@lang('doctor')">
                            @if ($doctor->featured)
                            <span class="fav-btn"><i class="las la-medal"></i></span>
                            @endif
                        </div>
                        <div class="booking-content">
                            <span class="sub-title"><a href="#0">{{ __($doctor->department->name) }}</a></span>
                            <h5 class="title">{{ __($doctor->name) }} <i class="fas fa-check-circle"></i></h5>
                            <p>{{ __($doctor->qualification) }}</p>

                            <ul class="booking-list">
                                <li>
                                    <!-- <i class=" fas fa-street-view"></i> -->
                                    {{ __($doctor->location->name) }}
                                </li>
                                <li>
                                    <!-- <i class="fas fa-phone"></i> -->
                                    {{ __($doctor->mobile) }}
                                </li>
                            </ul>

                            @if ($doctor->speciality || !empty($doctor->speciality))
                            <div class="booking-btn">
                                @foreach ($doctor->speciality as $item)
                                <span class="border-btn">{{ __($item) }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="booking-right">
                            <div class="booking-content">
                                <ul class="booking-list">
                                    <li><i class="fas fa-hourglass-start"></i>@lang('Joined us') :</li>
                                    <li><i class="fas fa-stethoscope"></i>{{ diffForHumans($doctor->created_at) }}</li>
                                    <li><span><i class="las la-wallet"></i>@lang('Fees') : {{ __($doctor->fees) }}
                                            {{ __($general->cur_text) }}<span></li>
                                </ul>
                                <ul class="booking-tag">
                                    @foreach ($doctor->socialIcons as $social)
                                        <li><a href="{{ $social->url }}" target="_blank">@php echo $social->icon @endphp</a></li>
                                    @endforeach
                                </ul>
                                <div class="booking-btn">
                                    @if ($doctor->serial_day && $doctor->serial_or_slot)
                                        <span class="border-btn active"><i class="la la-check-circle"></i>
                                            @lang('Appointment Available')</span>
                                    @else
                                        <span class="border-btn active"><i class="la la-times-circle"></i>
                                            @lang('Appointment Unavailable')</span>
                                    @endif
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- booking-section end -->

<!-- overview-section start -->
<section class="overview-section pd-b-80">
    <div class="container">
        <div class="overview-area mrb-40">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-tab-wrapper">
                        <ul class="tab-menu">
                            <!-- <li>@lang('Overview')</li> -->
                            <li class="active">@lang('Booking')</li>

                            @if (loadFbComment() != null)
                            <li>@lang('Review')</li>
                            @endif
                        </ul>
                        <div class="tab-cont">
                            <div class="tab-item">
                                <div class="overview-tab-content ml-b-30">
                                    <div class="overview-content">
                                        <h5 class="title">@lang('About Me')</h5>
                                        <p>
                                            @if ($doctor->about)
                                            {{ __($doctor->about) }}
                                            @else
                                            <span>@lang('Doctor about will be appearing soon')</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="overview-content">
                                        <h5 class="title">@lang('Education')</h5>
                                        <div class="overview-box">
                                            @if (count($doctor->educationDetails))
                                            <ul class="overview-list">
                                                @foreach ($doctor->educationDetails as $education)
                                                <li>
                                                    <div class="overview-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="overview-details">
                                                        <h6 class="title">{{ __($education->institution) }}
                                                        </h6>
                                                        <div>{{ __($education->discipline) }}</div>
                                                        <span>{{ __($education->period) }}</span>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <span>@lang('Education data will be appearing soon')</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="overview-content">
                                        <h5 class="title">@lang('Work & Experience')</h5>
                                        <div class="overview-box">
                                            @if (count($doctor->experienceDetails))
                                            <ul class="overview-list">
                                                @foreach ($doctor->experienceDetails as $experience)
                                                <li>
                                                    <div class="overview-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="overview-details">
                                                        <h6 class="title">{{ __($experience->institution) }}
                                                        </h6>
                                                        <div>{{ __($experience->discipline) }}</div>
                                                        <span>{{ __($experience->period) }}</span>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <span>@lang('Experience data will be appearing soon')</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="overview-content">
                                        <h5 class="title">@lang('Specializations')</h5>
                                        <div class="overview-footer-area d-flex flex-wrap justify-content-between">
                                            @if ($doctor->speciality)
                                            <ul class="overview-footer-list">
                                                @if ($doctor->speciality || !empty($doctor->speciality))
                                                @foreach ($doctor->speciality as $item)
                                                <li><i
                                                        class="fas fa-long-arrow-alt-right"></i>{{ __($item) }}
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                            @else
                                            <span>@lang('Specializations data will be appearing soon')</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-item">
                                <div class="overview-tab-content">
                                    <div
                                        class="overview-booking-header d-flex flex-wrap justify-content-between ml-b-10">
                                        <div class="overview-booking-header-left mrb-10">
                                            @if ($doctor->serial_day && $doctor->serial_or_slot)
                                            <h4 class="title">@lang('Available Schedule')</h4>
                                            <ul class="overview-booking-list">
                                                <li class="available">@lang('Available')</li>
                                                <li class="booked">@lang('Booked')</li>
                                                <li class="selected">@lang('Selected')</li>
                                            </ul>
                                            @else
                                            <h4 class="title">@lang('No Schedule Available Yet')</h4>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if ($doctor->serial_day && $doctor->serial_or_slot)
                                    <form action="{{ route('doctors.appointment.store', $doctor->id) }}"
                                        method="post" class="appointment-from">
                                        @csrf
                                        <div class="overview-booking-area">
                                            <div class="overview-booking-header-right mrb-10">
                                                <div
                                                    class="overview-date-area d-flex flex-wrap align-items-center justify-content-start gap-8">
                                                    <div class="overview-date-header">
                                                        <h5 class="title">@lang('Choose Your Date & Time')</h5>
                                                    </div>
                                                    <div class="overview-date-select">
                                                        <select class="form-control date-select" name="booking_date" id="booking_date"
                                                            required>
                                                            <option value="" selected disabled>
                                                                @lang('Select Date')</option>
                                                            @foreach ($availableDate as $date)
                                                            <option value="{{ $date }}">
                                                                {{ __(date('d-m-Y', strtotime($date))) }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div
                                                    class="overview-date-area d-flex flex-wrap align-items-center justify-content-start gap-1">
                                                    <div class="overview-date-header">
                                                        <input type="checkbox" value="{{ $doctor->revisit_fees }}" name="re_visit" id="re_visit" />
                                                       
                                                    </div>
                                                    <div class="overview-date-select">
                                                        <h6 class="title">@lang('Re-visit')</h6>
                                                       
                                                    </div>
                                                </div>

                                            </div>
                                            <ul class="clearfix time-serial-parent">
                                                @foreach ($doctor->serial_or_slot as $item)
                                                <li>
                                                    <a href="javascript:void(0)"
                                                        class="btn btn--primary mr-2 mb-2 available-time item-{{ slug($item) }}"
                                                        data-value="{{ $item }}">{{ __($item) }}
                                                    </a>
                                                </li>
                                                @endforeach
                                                <input type="hidden" name="time_serial" class="time" required>
                                            </ul>
                                        </div>
                                        <div class="booking-appoint-area">
                                            <div class="row justify-content-center ml-b-30">
                                                <div class="col-lg-6 mrb-30">
                                                    <div class="booking-appoint-form-area">
                                                        <h4 class="title">@lang('Appointment Form')</h4>
                                                        <div class="booking-appoint-form">
                                                            <div class="row">
                                                                <div class="col-lg-6 form-group">
                                                                    <input type="text" name="name"
                                                                        class="form-control"
                                                                        placeholder="@lang('Enter Name')" required>
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    <input type="number" name="age"
                                                                        class="form-control"
                                                                        placeholder="@lang('Enter Age')" required>
                                                                </div>
                                                                <div class="col-lg-12 form-group">
                                                                    <input type="email" name="email"
                                                                        class="form-control"
                                                                        placeholder="@lang('Enter E-mail')" required>
                                                                </div>
                                                                <div class="col-lg-12 form-group">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-text">{{ $general->country_code }}</span>
                                                                        <input type="number" name="mobile"
                                                                            class="form-control"
                                                                            placeholder="@lang('Enter Mobile Number')" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 form-group">
                                                                    <textarea name="disease" placeholder="@lang('Enter Details')"></textarea>
                                                                </div>
                                                                <div
                                                                    class="col-lg-12 form-group d-flex flex-wrap justify-content-start gap-3">
                                                                    <button type="submit"
                                                                        class="cmn-btn payment-system"
                                                                        data-value="2">@lang('Pay In Cash')</button>

                                                                    @if ($general->online_payment)
                                                                    <button type="submit"
                                                                        class="cmn-btn payment-system"
                                                                        data-value="1">@lang('Pay Online')</button>
                                                                    @endif
                                                                    <input type="hidden" name="payment_system"
                                                                        class="payment" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mrb-30">
                                                    <div class="booking-confirm-area">
                                                        <h4 class="title">@lang('Confirm Your Booking')</h4>
                                                        <ul class="booking-confirm-list">
                                                            <li><span>@lang('Patient Name')</span> : <span
                                                                    class="custom-color name"></span>
                                                            </li>
                                                            <li><span>@lang('Age')</span> : <span
                                                                    class="custom-color age"> 0 </span>
                                                                @lang('Years')
                                                            </li>
                                                            <li><span>@lang('Email')</span> : <span
                                                                    class="custom-color email"></span>
                                                            </li>
                                                            <li><span>@lang('Phone Number')</span> : <span
                                                                    class="custom-color mobile"></span>
                                                            </li>
                                                            <li><span>@lang('Date')</span> : <span
                                                                    class="custom-color date"></span>
                                                            </li>
                                                            <li><span>@lang('Serial / Slot')</span> :
                                                                <span class="custom-color book-time"></span>
                                                            </li>
                                                            <li id="feeli"><span>@lang('Fees')</span> :
                                                                {{ $doctor->fees }} {{ $general->cur_text }}
                                                            </li>
                                                            <li id="re-feeli"><span>@lang('Fees')</span> :
                                                                {{ $doctor->revisit_fees }} {{ $general->cur_text }}
                                                            </li>
                                                        </ul>
                                                        <div class="booking-confirm-btn">
                                                            <button type="button"
                                                                class="cmn-btn-active reset">@lang('Reset')</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            @if (loadFbComment() != null)
                            <div class="tab-item">
                                <div class="comments-section">
                                    <div class="fb-comments" data-href="{{ url()->current() }}"
                                        data-numposts="5">
                                        @php echo loadFbComment() @endphp
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- overview-section end -->

@endsection
@push('style')
<style>
    .input-group-text {
        border-radius: 0.5rem 0 0 0.5rem !important;
    }
    #booking_date{margin-left: 70px;}
    #re_visit{vertical-align: text-top;}
</style>
@endpush

@push('script')
<script>
    (function($) {
        "use strict";

        $(".available-time").on('click', function() {
            $('.time').val($(this).data('value'));
            $('.book-time').text($(this).data('value'));
        });

        $('#re-feeli').hide();
        $('#re_visit').on('change', function() {
            if ($(this).is(':checked')) {
            $('#feeli').hide();
            $('#re-feeli').show();
            } else {
            $('#re-feeli').hide();
            $('#feeli').show();
            }
        });

        function slug(text) {
            return text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        }

        $("select[name=booking_date]").on('change', function() {
            $('.date').text(`${$(this).val()}`); // Add date to view

            $('.available-time').removeClass('btn--success disabled').addClass('active-time');

            let url = "{{ route('doctors.appointment.available.date') }}";
            let data = {
                date: $(this).val(),
                doctor_id: '{{ $doctor->id }}'
            }

            $.get(url, data, function(response) {
                if (!response.length) {
                    $('.available-time').removeClass('active-time disabled');
                } else {
                    $.each(response, function(key, value) {
                        var demo = slug(value);
                        $(`.item-${demo}`).addClass('active-time disabled');
                    });
                }
            });
        });

        $("[name=name]").on('input', function() {
            $('.name').text(`${$(this).val()}`);
        });
        $("[name=age]").on('input', function() {
            $('.age').text(`${$(this).val()}`);
        });
        $("[name=email]").on('input', function() {
            $('.email').text(`${$(this).val()}`);
        });
        $("[name=mobile]").on('input', function() {
            $('.mobile').text(`${$(this).val()}`);
        });


        $(".reset").on('click', function() {
            $('.appointment-from')[0].reset();
        });

        $('.payment-system').on('click', function() {
            $('.payment').val($(this).data('value'));
        });


    })(jQuery);
</script>
@endpush