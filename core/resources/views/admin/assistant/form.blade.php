@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.assistant.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>@lang('Image')</label>
                                        <div class="image-upload">
                                            <div class="thumb">
                                                <div class="avatar-preview">
                                                    <div class="profilePicPreview"
                                                        style="background-image: url({{ getImage(getFilePath('assistantProfile') . '/' . @$assistant->image, getFileSize('assistantProfile')) }})">
                                                        <button type="button" class="remove-image"><i
                                                                class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="avatar-edit mt-0">
                                                    <input type="file" class="profilePicUpload" name="image"
                                                        id="profilePicUpload1" accept=".png, .jpg, .jpeg" required>
                                                    <label for="profilePicUpload1"
                                                        class="btn btn--success btn-block btn-lg">@lang('Upload')</label>
                                                    <small>@lang('Support Images'):
                                                        <b>@lang('jpeg'), @lang('jpg').</b> @lang(', resized into 400x400px')
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('Name')</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control " required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('Username')</label>
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                class="form-control " required />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>@lang('E-mail')</label>
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                class="form-control " required />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Mobile')
                                                <i class="fa fa-info-circle text--primary" title="@lang('Add the country code by general setting. Otherwise, SMS won\'t send to that number.')">
                                                </i>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ $general->country_code }}</span>
                                                <input type="number" name="mobile" value="{{ old('mobile') }}"
                                                    class="form-control" autocomplete="off" required>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group" id="select2-wrapper">
                                            <label>@lang('Assign Doctors')</label>
                                            <select class="select2-multi-select form-control" name="doctor_id[]"
                                                multiple="multiple" required>
                                                <option disabled>@lang('Select One')</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}">{{ __($doctor->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="from-group">
                                            <label>@lang('Address') </label>
                                            <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.assistant.index') }}" class="btn btn-sm btn-outline--primary"><i class="la la-undo"></i>
        @lang('Back') </a>
@endpush

@push('script')
    <script>
        (function($) {
            'use strict';
            $('.select2-multi-select').select2({
                dropdownParent: $('#select2-wrapper')
            });
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        #select2-wrapper {
            position: relative;
        }
    </style>
@endpush
