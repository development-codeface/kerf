@extends('doctor.layouts.app')
@section('panel')
    <div class="row gy-4">
        <div class="col-xxl-3 col-sm-6">
            <x-widget link="" icon="las la-wallet f-size--56" title="Total Online Earn"
                value="{{ showAmount($widget['total_online_earn']) }}" bg="primary" />
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <x-widget link="" icon="las la-hand-holding-usd f-size--56" title="Total Cash Earn"
                value="{{ showAmount($widget['total_cash_earn']) }}" bg="12" />
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <x-widget link="{{ route('doctor.appointment.new')}}" icon="lar la-handshake f-size--56" title="Total New Appointment"
                value="{{ $widget['total_new_appointment'] }}" bg="info" />
        </div><!-- dashboard-w1 end -->
        <div class="col-xxl-3 col-sm-6">
            <x-widget link="{{ route('doctor.appointment.done')}}" icon="las la-check-circle f-size--56" title="Total Done Appointment"
                value="{{ $widget['total_done_appointment'] }}" bg="success" />
        </div><!-- dashboard-w1 end -->
    </div><!-- row end-->

    <div class="row">
        <h5 class="my-3">@lang('Assistant List')</h5>
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Assistant')</th>
                                    <th>@lang('Mobile')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Joined At')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($assistantsDoctor as $item)
                                    <tr>
                                        <td>{{ $assistantsDoctor->firstItem() + $loop->index }}</td>
                                        <td>{{ __($item->assistant->name) }}</td>
                                        <td>{{ $item->assistant->mobile }}</td>
                                        <td>{{ $item->assistant->email }}</td>
                                        <td>{{ showDateTime($item->assistant->created_at) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($assistantsDoctor->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($assistantsDoctor) @endphp
                    </div>
                @endif
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
                                        <td>{{ $log->doctor_ip }} </td>
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
