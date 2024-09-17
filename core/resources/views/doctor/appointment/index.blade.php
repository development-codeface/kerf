@extends('doctor.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Patient') | @lang('Mobile')</th>
                                    <th>@lang('Added By')</th>
                                    @if (request()->routeIs('doctor.appointment.trashed'))
                                        <th>@lang('Trashed By')</th>
                                    @endif
                                    <th>@lang('Booking Date')</th>
                                    <th>@lang('Time / Serial No')</th>
                                    <th>@lang('Payment Status')</th>
                                    @if (!request()->routeIs('doctor.appointment.trashed'))
                                        <th>@lang('Service')</th>
                                    @endif
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointments->firstItem() + $loop->index }}</td>
                                        <td>
                                            <span class="fw-bold d-block"> {{ __($appointment->name) }}</span>
                                            {{ $appointment->mobile }}
                                        </td>
                                        <td> @php  echo $appointment->addedByBadge;  @endphp </td>
                                        @if (request()->routeIs('doctor.appointment.trashed'))
                                            <td> @php  echo $appointment->trashBadge;  @endphp </td>
                                        @endif
                                        <td>{{ showDateTime($appointment->booking_date) }}</td>
                                        <td>{{ $appointment->time_serial }}</td>
                                        <td> @php  echo $appointment->paymentBadge;  @endphp </td>
                                        @if (!request()->routeIs('doctor.appointment.trashed'))
                                            <td> @php  echo $appointment->serviceBadge;  @endphp </td>
                                        @endif
                                        <td>
                                        <!-- @lang('Details') -->
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary detailBtn"
                                                    data-route="{{ route('admin.appointment.dealing', $appointment->id) }}"
                                                    data-resourse="{{ $appointment }}">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </button>
                                                @if (request()->routeIs('doctor.appointment.new'))

                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--danger confirmationBtn"
                                                        @if (!$appointment->is_delete && !$appointment->payment_status) ''  @else disabled @endif
                                                        data-action="{{ route('doctor.appointment.remove', $appointment->id) }}"
                                                        data-question="@lang('Are you sure to remove this appointment')?">
                                                        <i class="la la-trash"></i> @lang('Trash')
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($appointments->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($appointments) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    {{-- DETAILS MODAL --}}
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Appointment Details')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group-flush list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            @lang('Patient Name') :
                            <span class="name"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            @lang('Booking Date') :
                            <span class="bookingDate"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            @lang('Time or Serial no') :
                            <span class="timeSerial"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            @lang('Contact No') :
                            <span class="mobile"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            @lang('E-mail') :
                            <span class="email"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            @lang('Age') :
                            <span class="age"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('OP Number') :
                            <span class="op_number"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                            @lang('Fees') :
                            <span class="appointment_fees"></span>
                        </li>
                        <li class="list-group-item align-items-center fw-bold">
                            @lang('Disease') :
                            <p class="disease text-end"></p>
                        </li>
                    </ul>
                    <hr>
                    <!-- <div>
                        <p class="text--warning text-center"><i class="las la-exclamation-triangle"></i> @lang('Are you sure that the patient has paid')?
                        </p>
                        <p class="text-center text--success"><i class="las la-exclamation-triangle"></i> @lang('If yes, then you can mark this as service done').
                        </p>
                    </div> -->
                </div>

                <div class="modal-footer">

                    <form action="" class="dealing-route" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline--success btn-sm serviceDoneBtn"><i
                                class="las la-check"></i> @lang('Done')</button>
                        <button type="button" class="btn btn--dark btn-sm"
                            data-bs-dismiss="modal">@lang('Close')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- Remove MODAL --}}
    <x-confirmation-modal />
@endsection
@push('breadcrumb-plugins')
    <x-search-form />

    <a href="{{ route('doctor.appointment.booking') }}" type="button" class="btn btn-sm btn-outline--primary h-45">
        <i class="las la-plus"></i>@lang('Make New')
    </a>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var resourse = $(this).data('resourse');
                $('.name').text(resourse.name);
                $('.email').text(resourse.email);
                $('.mobile').text(resourse.mobile);
                $('.bookingDate').text(resourse.booking_date);
                $('.timeSerial').text(resourse.time_serial);
                $('.age').text(resourse.age);
                $('.op_number').text(resourse.op_number);
                $('.appointment_fees').text(resourse.doctor.fees + ' ' + `{{ $general->cur_text }}`);
                $('.disease').text(resourse.disease);

                var route = $(this).data('route');
                $('.dealing-route').attr('action', route);

                if (resourse.is_delete == 1 || resourse.is_complete == 1) {
                    modal.find('.serviceDoneBtn').hide();
                } else if (!resourse.is_complete && resourse.payment_status != 2) {
                    modal.find('.serviceDoneBtn').show();
                } else {
                    modal.find('.serviceDoneBtn').show();
                }

                modal.modal('show');
            });

            $('.removeBtn').on('click', function() {
                var modal = $('#removeModal');
                var route = $(this).data('route');
                $('.remove-route').attr('action', route);
            });
        })(jQuery);
    </script>
@endpush
