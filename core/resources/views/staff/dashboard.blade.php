@extends('staff.layouts.app')
@section('panel')
    <div class="row gy-4">
        <div class="col-xxl-4 col-sm-6">
            <x-widget
                link=""
                icon="las la-clinic-medical f-size--56"
                title="Total Appointment"
                value="{{ $totalAppointments }}"
                bg="12"
            />
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-4 col-sm-6">
            <x-widget
                link="{{ route('staff.appointment.new')}}"
                icon="lar la-handshake f-size--56"
                title="Total New Appointment"
                value="{{ $newAppointments }}"
                bg="info"
            />
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-4 col-sm-6">
            <x-widget
                link="{{ route('staff.appointment.done')}}"
                icon="las la-check-circle f-size--56"
                title="Total Done Appointment"
                value="{{ $doneAppointments }}"
                bg="success"
            />
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->

    <div class="row">
        <h5 class="my-3">@lang('New Appointments')</h5>
        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Patient') | @lang('Mobile')</th>
                                    <th>@lang('Booking Date')</th>
                                    <th>@lang('Time / Serial No')</th>
                                    <th>@lang('Payment Status')</th>
                                    <th>@lang('Service')</th>
                                    <th>@lang('Doctor')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
                                    <tr>
                                        <td>{{  $loop->iteration }}</td>
                                        <td> <span class="fw-bold d-block"> {{ __($appointment->name) }}</span>
                                            {{ $appointment->mobile }}</td>

                                        <td>{{ showDateTime($appointment->booking_date) }}</td>
                                        <td>{{ $appointment->time_serial }}</td>
                                        <td> @php  echo $appointment->paymentBadge;  @endphp </td>
                                        <td> @php  echo $appointment->serviceBadge;  @endphp </td>
                                        <td>{{ __($appointment->doctor->name) }}</td>
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

            </div><!-- card end -->
        </div>
    </div>

    <div class="row">
        <h5 class="my-3">@lang('Login History')</h5>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Login at')</th>
                                    <th>@lang('IP')</th>
                                    <th>@lang('Location')</th>
                                    <th>@lang('Browser | OS')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loginLogs as $log)
                                    <tr>
                                        <td>
                                            {{ showDateTime($log->created_at) }} <br> {{ diffForHumans($log->created_at) }}
                                        </td>
                                        <td>{{ $log->staff_ip }} </td>
                                        <td>{{ __($log->city) }} <br> {{ __($log->country) }}</td>
                                        <td>
                                            {{ __($log->browser) }} <br> {{ __($log->os) }}
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
            </div><!-- card end -->
        </div>
    </div>
@endsection

