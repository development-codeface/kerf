@extends('staff.layouts.app')
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
                                    @if (request()->routeIs('staff.appointment.trashed'))
                                        <th>@lang('Trashed By')</th>
                                    @endif
                                    <th>@lang('Booking Date')</th>
                                    <th>@lang('Time / Serial No')</th>
                                    <th>@lang('Payment Status')</th>
                                    @if (!request()->routeIs('staff.appointment.trashed'))
                                        <th>@lang('Service')</th>
                                    @endif
                                    <th>@lang('Doctor')</th>
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
                                        @if (request()->routeIs('staff.appointment.trashed'))
                                            <td> @php  echo $appointment->trashBadge;  @endphp </td>
                                        @endif
                                        <td>{{ showDateTime($appointment->booking_date) }}</td>
                                        <td>{{ $appointment->time_serial }}</td>
                                        <td> @php  echo $appointment->paymentBadge;  @endphp </td>
                                        @if (!request()->routeIs('staff.appointment.trashed'))
                                            <td> @php  echo $appointment->serviceBadge;  @endphp </td>
                                        @endif
                                        <td>{{ __($appointment->doctor->name) }}</td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary detailBtn"
                                                    data-route="{{ route('admin.appointment.dealing', $appointment->id) }}"
                                                    data-resourse="{{ $appointment }}">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </button>
                                                @if (request()->routeIs('staff.appointment.new') )
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--danger confirmationBtn"
                                                    @if (!$appointment->is_delete && !$appointment->payment_status) ''  @else disabled @endif
                                                    data-action="{{ route('staff.appointment.remove', $appointment->id) }}"
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

    @include('partials.appointment_done')

    {{-- Remove MODAL --}}
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
    <a href="{{ route('staff.appointment.form') }}" type="button" class="btn btn-sm btn-outline--primary h-45">
        <i class="las la-plus"></i>@lang('Make New')
    </a>
@endpush
