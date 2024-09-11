@extends('doctor.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('doctor.info.speciality.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="payment-method-item">
                                    <div class="payment-method-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card border--primary mt-3">
                                                    <div class="card-header bg--primary d-flex justify-content-between">
                                                        <h5 class="text-white">@lang('Speciality')</h5>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-light float-end add-speciality-data">
                                                            <i class="la la-fw la-plus"></i>@lang('Add New')</button>
                                                    </div>
                                                </div>
                                                <div class="card-body addedField">
                                                    @if ($specialities != null || !empty($specialities))
                                                        @forelse ($specialities as $speciality)
                                                            <div class="row align-items-center speciality-data">
                                                                <div class="col-xl-11">
                                                                    <div class="form-group">
                                                                        <div class="input-group mb-md-0 mb-4">
                                                                            <div class="col-md-12 p-0">
                                                                                <label> @lang('Enter Speciality')</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="{{ $speciality }}"
                                                                                    name="speciality[]" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-1 mt-md-0 mt-2 text-right">
                                                                    <span class="input-group-btn">
                                                                        <button
                                                                            class="btn btn--danger btn-lg removeBtn removeBtn--style w-100"
                                                                            type="button">
                                                                            <i class="fa fa-times mr-0"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @empty
                                                                <span class="text-center">@lang('Data not found')</span>
                                                        @endforelse
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer  @if (!$specialities) d-none @endif">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .removeBtn--style {
            margin-top: 10px;
        }

        @media(max-width: 1199px) {
            .removeBtn--style {
                margin-bottom: 15px;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        'use strict';

        (function($) {
            $('.add-speciality-data').on('click', function() {
                var html = `<div class="row align-items-center speciality-data">
                    <div class="col-md-11 mt-4">
                        <div class="form-group">
                            <input name="speciality[]" class="form-control" type="text" placeholder="@lang('Enter your special skill')" required>
                        </div>
                    </div>
                    <div class="col-md-1 mt-md-0 text-right">
                            <button class="btn btn--danger removeBtn removeBtn--style w-100 h-45" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                    </div>
                </div>`;
                $('.addedField').append(html)
            });

            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.speciality-data').remove();
            });


            $('.add-speciality-data').on('click', function(){
                $('.card-footer').removeClass('d-none')
            })

        })(jQuery);
    </script>
@endpush
