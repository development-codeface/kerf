@php
    $departmentContent = getContent('department.content',true);
    $departmentData    = \App\Models\Department::orderBy('id', 'DESC')->get();

    if($departmentData->count() >= 4){
        $length = round($departmentData->count() / 4);
    }else{
        $length = $departmentData->count();
    }
    $item = [];
    $skip = 0;
    for($i = 0; $i<$length; $i++) {
        $item[$i] = $departmentData->skip($skip)->take(4);
        $skip += 4;
    }
@endphp

<!-- choose-section start -->
<section class="choose-section ptb-80">
    <div class="container">
        <div class="row justify-content-center align-items-center ml-b-30">
            <div class="col-lg-4 mrb-30">
                <div class="choose-left-content">
                    <h2 class="title">{{ __($departmentContent->data_values->heading) }}</h2>
                    <p>{{ __($departmentContent->data_values->subheading) }}</p>
                    <div class="choose-btn">
                        <a href="{{ route('doctors.all') }}" class="cmn-btn">@lang('Book Now')</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mrb-30">
                <div class="choose-slider">
                    <div class="swiper-wrapper">
                        @for($d = 0; $d < count($item); $d++)
                        <div class="swiper-slide">
                            <div class="choose-right-content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="right-column-one">
                                            @foreach($item[$d]->take(2) as $department)
                                            <div class="choose-item">
                                                <div class="choose-thumb">
                                                    <a href="{{ route('doctors.departments', $department->id) }}">
                                                    <img src="{{ getImage(getFilePath('department').'/'. @$department->image, getFileSize('department'))}}" alt="@lang('department')">
                                                    </a>
                                                </div>
                                                <div class="choose-content">
                                                <h6 class="title"><a href="{{ route('doctors.departments', $department->id) }}">{{ __($department->name) }}</a></h6>
                                                    <p>{{ __($department->details) }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="right-column-two">
                                            @foreach($item[$d]->skip(2)->take(2) as $department)
                                            <div class="choose-item">
                                                <div class="choose-thumb">
                                                    <a href="{{ route('doctors.departments', $department->id) }}">
                                                    <img src="{{ getImage(getFilePath('department').'/'. $department->image, getFileSize('department'))}}" alt="@lang('department')">
                                                    </a>
                                                </div>
                                                <div class="choose-content">
                                                    <h6 class="title"><a href="{{ route('doctors.departments', $department->id) }}">{{ __($department->name) }}</a></h6>
                                                    <p>{{ __($department->details) }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- choose-section end -->
