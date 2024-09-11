@extends('assistant.layouts.app')
@section('panel')
    <div class="row">
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
                                    <th>@lang('Serial / Slot Info')</th>
                                    <th>@lang('Department')</th>
                                    <th>@lang('Location')</th>
                                    <th>@lang('Appointment')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($assistantDoctors as $item)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ __($item->doctor->name) }}
                                            
                                            @if ($item->doctor->appointments_count)
                                                <br>
                                                <span class="badge badge--primary"> {{$item->doctor->appointments_count}} @lang('new')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->doctor->slot_type == 1)
                                                @lang('Serial')
                                            @else
                                                @lang('Time Slot')
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->doctor->slot_type == 1)
                                            @lang('Max:')  {{ $item->doctor->max_serial }}
                                            @else
                                                {{ $item->doctor->start_time }} - {{ $item->doctor->end_time }}
                                            @endif
                                        </td>
                                        <td>{{ __($item->doctor->department->name) }}</td>
                                        <td>{{ __($item->doctor->location->name) }}</td>
                                        <td>
                                            <div class="button--group">
                                                <a href="{{ route('assistant.doctor.appointment.new', $item->doctor->id) }}"
                                                    class="btn btn-sm btn-outline--warning"> <i class="las la-handshake"></i>
                                                    @lang('New List')
                                                </a>
                                                <a href="{{ route('assistant.doctor.appointment.completed', $item->doctor->id) }}"
                                                    class="btn btn-sm btn-outline--primary"> <i class="las la-check-circle"></i>
                                                    @lang('Done List')
                                                </a>
                                                <a href="{{ route('assistant.doctor.appointment.trash', $item->doctor->id) }}"
                                                    class="btn btn-sm btn-outline--danger"> <i class="las la-trash"></i>
                                                    @lang('Trash List')
                                                </a>
                                            </div>
                                        </td>
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

            </div><!-- card end -->
        </div>
    </div>
@endsection
