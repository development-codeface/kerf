@extends('assistant.layouts.app')
@section('panel')
<div class="row gy-4">
    <div class="col-xxl-4 col-sm-6">
        <x-widget
            link="{{ route('assistant.doctors')}}"
            icon="las la-stethoscope f-size--56"
            title="Total Doctor"
            value="{{ $totalDoctor }}"
            bg="12"
        />
    </div><!-- dashboard-w1 end -->
    <div class="col-xxl-4 col-sm-6">
        <x-widget
            link=""
            icon="lar la-handshake f-size--56"
            title="Total New Appointment"
            value="{{ $newAppointment }}"
            bg="info"
        />
    </div><!-- dashboard-w1 end -->
    <div class="col-xxl-4 col-sm-6">
        <x-widget
            link=""
            icon="las la-check-circle f-size--56"
            title="Total Done Appointment"
            value="{{ $completeAppointment }}"
            bg="success"
        />
    </div><!-- dashboard-w1 end -->
</div><!-- row end-->

<div class="row">
    <h5 class="my-3">@lang('Assigned Doctor List')</h5>
    <div class="col-lg-12">
        <div class="card b-radius--10">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light">
                        <thead>
                            <tr>
                                <th>@lang('S.N.')</th>
                                <th>@lang('Doctor')</th>
                                <th>@lang('Schedule Type')</th>
                                <th>@lang('Time / Slot Info')</th>
                                <th>@lang('Department')</th>
                                <th>@lang('Location')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ __($doctor->name) }}</td>
                                    <td>
                                        @if ($doctor->slot_type == 1)
                                            @lang('Serial')
                                        @else
                                            @lang('Time Slot')
                                        @endif
                                    </td>
                                    <td>
                                        @if ($doctor->slot_type == 1)
                                            {{ $doctor->max_serial }}
                                        @else
                                            {{ $doctor->start_time }} - {{ $doctor->end_time }}
                                        @endif
                                    </td>
                                    <td>{{ __($doctor->department->name) }}</td>
                                    <td>{{ __($doctor->location->name) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">@lang('No assigned doctor for you yet.')</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                                    <td>{{ $log->assistant_ip }} </td>
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

