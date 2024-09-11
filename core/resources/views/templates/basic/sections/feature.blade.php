@php
    $featureContent = getContent('feature.content', true);
    $doctors        = \App\Models\Doctor::active()->where('featured', Status::YES)
        ->with(['department:id,name', 'location:id,name', 'socialIcons'])
        ->orderBy('id', 'DESC')
        ->take(6)->get(['id', 'name', 'about', 'qualification', 'department_id', 'location_id', 'image', 'mobile']);
@endphp

<section class="team-section ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header">
                    <h2 class="section-title">{{ __($featureContent->data_values->heading) }}</h2>
                    <p class="m-0">{{ __($featureContent->data_values->subheading) }} </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center ml-b-30">
            @foreach($doctors as $doctor)
            <div class="col-xl-6 col-lg-4 col-md-6 mrb-30">
                <div class="team-item d-flex flex-wrap align-items-center justify-content-between">
                    <div class="team-thumb">
                        <img src="{{ getImage(getFilePath('doctorProfile').'/'. @$doctor->image, getFileSize('doctorProfile'))}} " alt="@lang('doctor-image')">
                        <div class="team-thumb-overlay">
                            <ul class="social-icon">
                                    @foreach ($doctor->socialIcons as $social)
                                    <li><a href="{{ $social->url }}" target="_blank">@php echo $social->icon @endphp</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="team-content">
                            <h5 class="title">{{ __($doctor->name) }}</h5>
                            <p>{{ StrLimit(__($doctor->about),70) }}</p>
                            <h6 class="title">@lang('Qualification')</h6>
                            <p>{{ StrLimit(__($doctor->qualification),30)}}</p>

                            <div class="booking-btn">

                                <a href="{{ route('doctors.booking',$doctor->id) }}" class="cmn-btn">@lang('Book Now')</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center mrt-60">
            <div class="col-lg-12 text-center">
                <div class="team-btn">
                    <a href="{{ route('doctors.featured') }}" class="cmn-btn-active">@lang('View More')</a>
                </div>
            </div>
        </div>
    </div>
</section>
