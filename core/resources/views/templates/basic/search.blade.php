@extends($activeTemplate . 'layouts.frontend')
@section('content')
<section  class="appoint-section ptb-80">
    <div class="container">
        <div class="booking-search-area">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="appoint-content">
                        <form class="appoint-form" action="{{ route('doctors.search') }}" method="get">
                            <div class="search-location form-group">
                                <div class="appoint-select">
                                    <select class="chosen-select locations" name="location">
                                        <option value="" selected disabled>@lang('Location')</option>
                                        @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" @selected($location->id == request()->location)>
                                            {{ __($location->name) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="search-location form-group">
                                <div class="appoint-select">
                                    <select class="chosen-select locations" name="department">
                                        <option value="" selected disabled>@lang('Department')</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" @selected($department->id == request()->department)>
                                            {{ __($department->name) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="search-info form-group">
                                <div class="appoint-select">
                                    <select class="chosen-select locations" name="doctor">
                                        <option value="" selected disabled>@lang('Doctor')</option>
                                        @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" @selected($doctor->id == request()->doctor)>
                                            {{ __($doctor->name) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="search-btn cmn-btn"><i class="las la-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center ml-b-30">
            @forelse($doctors as $doctor)
            <div class="col-lg-3 col-md-6 col-sm-6 mrb-30">
                <div class="booking-item">
                    <div class="booking-thumb">
                        <img src="{{ getImage(getFilePath('doctorProfile') . '/' . @$doctor->image, getFileSize('doctorProfile')) }}"
                            alt="@lang('booking')">
                        <span class="doc-deg">
                            <a href="{{ route('doctors.departments', $doctor->department->id) }}">{{ __($doctor->department->name) }}</a>
                        </span>
                        @if ($doctor->featured)
                        <span class="fav-btn"><i class="fas fa-medal"></i></span>
                        @endif
                    </div>
                    <div class="booking-content">
                        <h5 class="title">{{ __($doctor->name) }} <i class="fas fa-check-circle text-success"></i></h5>
                        <p>{{ strLimit(__($doctor->qualification), 50) }}</p>
                        <ul class="booking-list">
                            <li>
                                <!-- <i class="fas fa-street-view"></i> -->
                                <a href="{{ route('doctors.locations', $doctor->location->id) }}">{{ __($doctor->location->name) }}</a>
                            </li>
                            <li>
                                <!-- <i class="fas fa-phone"></i>  -->
                                {{ __($doctor->mobile) }}</li>
                        </ul>
                        <div class="booking-btn">
                            <a href="{{ route('doctors.booking', $doctor->id) }}" class="cmn-btn w-100 text-center">@lang('Book Now')</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12 col-md-12 col-sm-12 mrb-30">
                <div class="booking-item text-center">
                    <h3 class="title mt-2">{{ __($emptyMessage) }}</h3>
                    <div class="booking-btn mt-4 mb-2">
                        <a href="javascript:window.history.back();" class="cmn-btn">@lang('Go Back')</a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        {{ $doctors->links() }}
    </div>
</section>
@endsection