@extends('doctor.layouts.app')

@section('panel')
<div class="row mb-none-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('doctor.info.about.update')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <label>@lang('About')</label>
                            <textarea name="about" rows="5" required>{{ $doctor->about }}</textarea>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
