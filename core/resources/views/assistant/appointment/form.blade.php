@extends('assistant.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('assistant.doctor.appointment.book.details') }}">
                        <div class="form-group">
                            <label>@lang('Select Doctor')</label>
                            <select name="doctor_id" class="select2-basic" required>
                                <option selected disabled>@lang('Select One')</option>
                                @foreach ($doctors as $item)
                                    <option data-resourse="{{ $item }}" value="{{ $item->id }}">
                                        {{ __($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="alert alert-warning d-flex align-items-center p-3" role="alert">
                            <i class="las la-exclamation-circle"></i>
                            <small>
                                @lang('This appointment service must be paid in cash.')
                            </small>
                        </div>

                        <div class="col-md-12 mt-2">
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
