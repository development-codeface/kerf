@php
$searchContent = getContent('search.content',true);
$locations = \App\Models\Location::orderBy('id', 'DESC')->whereHas('doctors')->get(['id','name']);
$departments = \App\Models\Department::orderBy('id', 'DESC')->whereHas('doctors')->get(['id','name']);
$doctors = \App\Models\Doctor::orderBy('id', 'DESC')->get(['id','name']);
@endphp
<section style="height: calc(-90px + 100vh);
    display: flex;
    align-items: center;" class="appoint-section ptb-80 bg-overlay-white bg_img" data-background="{{ getImage('assets/images/frontend/search/'. @$searchContent->data_values->image,'1600x640') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="appoint-content">
                    <h2 class="title">{{ __($searchContent->data_values->heading) }}</h2>
                    <p>{{ __($searchContent->data_values->subheading) }}</p>
                    <form class="appoint-form" action="{{ route('doctors.search') }}" method="get">
                        @csrf
                        <div class="search-location form-group">
                            <div class="appoint-select">
                                <select class="chosen-select locations" name="location">
                                    <option value="" selected disabled>@lang('Location')</option>
                                    @foreach ($locations as $item)
                                    <option value="{{ $item->id }}">{{ __($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="search-location form-group">
                            <div class="appoint-select">
                                <select class="chosen-select locations" name="department">
                                    <option value="" selected disabled>@lang('Department')</option>
                                    @foreach ($departments as $item)
                                    <option value="{{ $item->id }}">{{ __($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="search-info form-group">
                            <div class="appoint-select">
                                <select class="chosen-select locations" name="doctor">
                                    <option value="" selected disabled>@lang('Doctor')</option>
                                    @foreach ($doctors as $item)
                                    <option value="{{ $item->id }}">{{ __($item->name) }}</option>
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
</section>