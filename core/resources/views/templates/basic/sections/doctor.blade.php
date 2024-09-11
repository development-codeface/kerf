@php
    $doctorContent = getContent('doctor.content', true);
    

        $doctors2    = \App\Models\Doctor::active()
        ->leftJoin('departments', 'doctors.department_id', '=', 'departments.id')
        ->leftJoin('locations', 'doctors.location_id', '=', 'locations.id')
        ->select(
            'doctors.id', 'doctors.name',
            'doctors.qualification', 'doctors.mobile','doctors.featured', 
            'doctors.image','departments.id as department_id', 
            'departments.name as department_name',
            'locations.name as location_name', 
            'locations.id as location_id')
            ->orderBy('doctors.id', 'DESC')
            ->get();
@endphp
<!-- our doctor section start -->
<!-- <section class="booking-section ptb-80"> -->
    <!-- <div class="container-fluid"> -->
        <!-- <div class="row ml-b-20"> -->
           <!-- <div class="booking-right-area"> -->
                <!-- <div class="col-lg-12">
                    <div class="section-header">
                        <h2 class="section-title">{{ __($doctorContent->data_values->heading) }}</h2>
                        <p class="m-0">{{ __($doctorContent->data_values->subheading) }}</p>
                    </div>
                </div> -->

                <!-- @foreach ($doctors2 as $doctor1) -->
                <!-- {{$doctor1}} fdfdsfs {{$doctor1->department_name}} -->
                <!-- @endforeach -->
                <!-- <div class="col-lg-12"> -->
                    <!-- <div class="booking-slider"> -->
                        <!-- <div class="swiper-wrapper"> -->
                            <!-- @foreach ($doctors2 as $doctor1) -->
                                <!-- <div class="swiper-slide"> -->
                                    <!-- <div class="booking-item"> -->
                                        <!-- <div class="booking-thumb"> -->
                                            <!-- <img src="{{ getImage(getFilePath('doctorProfile') . '/' . @$doctor1->image, getFileSize('doctorProfile')) }}"
                                                alt="@lang('doctor')"> -->
                                                <!-- {{$doctor1}} -->
                                            <!-- <div class="doc-deg">{{ __($doctor1->department_name) }} </div> -->
                                            <!-- @if ($doctor1->featured) -->
                                                <!-- <span class="fav-btn"><i class="las la-medal"></i></span> -->
                                            <!-- @endif -->
                                        <!-- </div> -->
                                        <!-- <div class="booking-content"> -->
                                            <!-- <span class="sub-title"><a
                                                    href="{{ route('doctors.departments', $doctor1->department_id) }}">{{ __($doctor1->department_name) }}</a></span>
                                            <h5 class="title">{{ __($doctor1->name) }} <i
                                                    class="fas fa-check-circle"></i></h5> -->
                                            <!-- <p>{{ strLimit(__($doctor1->qualification), 50) }}</p> -->
                                            <!-- <ul class="booking-list">
                                                <li><i class="las la-street-view"></i><a
                                                        href="{{ route('doctors.locations', $doctor1->location_id) }}">{{ __($doctor1->location_name) }}</a>
                                                </li>
                                                <li><i class="la la-phone"></i> {{ __($doctor1->mobile) }}</li> -->
                                            <!-- </ul> -->
                                            <!-- <div class="booking-btn"> -->
                                                <!-- <a href="{{ route('doctors.booking',$doctor1->id) }}" class="cmn-btn w-100 text-center">@lang('Book Now')</a> -->
                                            <!-- </div> -->
                                        <!-- </div> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                            <!-- @endforeach -->
                        <!-- </div> -->
                        <!-- <div class="ruddra-next">
                            <i class="las la-angle-right"></i>
                        </div> -->
                        <!-- <div class="ruddra-prev"> -->
                            <!-- <i class="las la-angle-left"></i> -->
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
<!-- </section> -->
<!-- booking-section end -->