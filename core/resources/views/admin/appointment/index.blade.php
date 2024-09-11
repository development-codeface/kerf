@extends('admin.layouts.app')
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
                                    <th>@lang('Doctor')</th>
                                    <th>@lang('Added By')</th>
                                    @if (request()->routeIs('admin.appointment.trashed'))
                                        <th>@lang('Trashed By')</th>
                                    @endif
                                    <th>@lang('Booking Date')</th>
                                    <th>@lang('Time / Serial No')</th>
                                    <th>@lang('Payment Status')</th>
                                    @if (!request()->routeIs('admin.appointment.trashed'))
                                        <th>@lang('Service')</th>
                                    @endif
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointments->firstItem() + $loop->index }}</td>
                                        <td> <span class="fw-bold d-block"> {{ __($appointment->name) }}</span>
                                            {{ $appointment->mobile }} </td>
                                        <td>
                                            <a href="{{ route('admin.doctor.detail', $appointment->doctor_id) }}">
                                                {{ __($appointment->doctor->name) }}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($appointment->added_staff_id)
                                                <a href="{{route('admin.staff.detail', $appointment->staff->id)}}">{{ __(@$appointment->staff->name) }}</a>
                                                 <br> <span
                                                    class="text--small badge badge--primary">@lang('Staff')</span>
                                            @elseif($appointment->added_assistant_id)
                                                <a href="{{route('admin.assistant.detail', $appointment->assistant->id)}}"> {{ __(@$appointment->assistant->name) }}</a>
                                                <br> <span
                                                    class="text--small badge badge--dark">@lang('Assistant')</span>
                                            @elseif($appointment->added_doctor_id)
                                               <a href="{{route('admin.doctor.detail', $appointment->doctor->id)}}"> {{ __(@$appointment->doctor->name) }}</a> <br> <span
                                                    class="text--small badge badge--success">@lang('Doctor')</span>
                                            @elseif($appointment->added_admin_id)
                                                {{ __(@$appointment->admin->name) }} <br> <span
                                                    class="text--small badge badge--primary">@lang('Admin')</span>
                                            @elseif($appointment->site)
                                                <span class="text--small badge badge--info">@lang('Site')</span>
                                            @endif
                                        </td>
                                        @if (request()->routeIs('admin.appointment.trashed'))
                                            <td>
                                                @if ($appointment->delete_by_admin)
                                                    <span class="text--small badge badge--primary">@lang('Admin')</span>
                                                @elseif ($appointment->delete_by_staff)
                                                    <a href="{{route('admin.staff.detail', $appointment->deletedByStaff->id)}}"> {{ __($appointment->deletedByStaff->name) }}</a>
                                                    <br>
                                                    <span class="text--small badge badge--dark">@lang('Staff')</span>
                                                @elseif ($appointment->delete_by_assistant)
                                                    <a href="{{route('admin.assistant.detail', $appointment->deletedByAssistant->id)}}"> {{ __($appointment->deletedByAssistant->name) }}</a>
                                                    <br>
                                                    <span class="text--small badge badge--success">@lang('Assistant')</span>
                                                @elseif ($appointment->delete_by_doctor)
                                                    <a href="{{route('admin.doctor.detail', $appointment->deletedByDoctor->id)}}"> {{ __($appointment->deletedByDoctor->name) }}</a>
                                                    <br>
                                                    <span class="text--small badge badge--info">@lang('Doctor')</span>
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            <span class="fw-bold">{{ showDateTime($appointment->booking_date, 'y-m-d') }}</span>
                                        </td>
                                        <td>{{ $appointment->time_serial }}</td>
                                        <td> @php  echo $appointment->paymentBadge;  @endphp </td>
                                        @if (!request()->routeIs('admin.appointment.trashed'))
                                            <td> @php  echo $appointment->serviceBadge;  @endphp </td>
                                        @endif

                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary detailBtn"
                                                    data-route="{{ route('admin.appointment.dealing', $appointment->id) }}"
                                                    data-resourse="{{ $appointment }}">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </button>

                                                @if (request()->routeIs('admin.appointment.new'))
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--danger confirmationBtn"
                                                        @if (!$appointment->is_delete && !$appointment->payment_status) ''  @else disabled @endif
                                                        data-action="{{ route('admin.appointment.remove', $appointment->id) }}"
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

    <a href="{{ route('admin.appointment.form') }}" type="button" class="btn btn-sm btn-outline--primary h-45">
        <i class="las la-plus"></i>@lang('Make New')
    </a>
@endpush
