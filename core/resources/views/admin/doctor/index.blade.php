@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Doctor')</th>
                                    <th>@lang('Mobile | Email')</th>
                                    <th>@lang('Total Earning')</th>
                                    <th>@lang('Department | Location')</th>
                                    <th>@lang('Joined At')</th>
                                    <th>@lang('Featured')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($doctors as $doctor)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $doctor->name }}</span>
                                            <br>
                                            <small>
                                                <a href="{{ route('admin.doctor.detail', $doctor->id) }}"><span>@</span>{{ $doctor->username }}</a>
                                            </small>
                                        </td>

                                        <td><span class="d-block fw-bold">{{$general->country_code . $doctor->mobile }}</span> {{ $doctor->email }}</td>

                                        <td> {{ showAmount($doctor->balance)}} {{ $general->cur_text}} </td>
                                        <td>
                                           <span class="d-block fw-bold"> {{ $doctor->department->name }}</span>
                                           {{ $doctor->location->name }}
                                        </td>
                                        <td>
                                            {{ showDateTime($doctor->created_at) }} <br>
                                            {{ diffForHumans($doctor->created_at) }}
                                        </td>
                                        <td> @php echo $doctor->featureBadge @endphp </td>
                                        <td> @php echo $doctor->statusBadge @endphp </td>
                                        <td>



                                            <div class="d-flex justify-content-end flex-wrap gap-1">

                                                <a href="{{ route('admin.doctor.detail', $doctor->id) }}"
                                                    class="btn btn-sm btn-outline--primary">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </a>

                                                <button type="button" class="btn btn-sm btn-outline--info" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="las la-ellipsis-v"></i>@lang('More')
                                                </button>

                                                <div class="dropdown-menu">
                                                    @if ($doctor->featured == Status::YES)
                                                    <button  class="dropdown-item confirmationBtn" data-action="{{ route('admin.doctor.featured', $doctor->id) }}"
                                                        data-question="@lang('Are you sure to non-feature this doctor')?">
                                                        <i class="las la-sort-alpha-up"></i> @lang('Non Feature')
                                                    </button>
                                                    @else
                                                    <button  class="dropdown-item confirmationBtn" data-action="{{ route('admin.doctor.featured', $doctor->id) }}"
                                                        data-question="@lang('Are you sure to featured this doctor')?">
                                                        <i class="las la-sort-alpha-down"></i> @lang('Featured')
                                                    </button>
                                                    @endif

                                                    @if ($doctor->status == Status::ACTIVE)
                                                    <button  class="dropdown-item confirmationBtn" data-action="{{ route('admin.doctor.status', $doctor->id) }}"
                                                        data-question="@lang('Are you sure to Inactive this doctor')?">
                                                        <i class="las la-eye-slash"></i> @lang('Inactive')
                                                    </button>
                                                    @else
                                                    <button  class="dropdown-item confirmationBtn" data-action="{{ route('admin.doctor.status', $doctor->id) }}"
                                                        data-question="@lang('Are you sure to Active this doctor')?">
                                                        <i class="las la-eye"></i> @lang('Active')
                                                    </button>
                                                    @endif
                                                </div>
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
                @if ($doctors->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($doctors) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form/>
    <a href="{{ route('admin.doctor.form')}}" type="button" class="btn btn-sm btn-outline--primary h-45">
        <i class="las la-plus"></i>@lang('Add New')
    </a>
@endpush

@push('style')
    <style>
        .dropdown-menu {
            padding: 0 0;
        }

        .dropdown-item {
            padding: 0.4rem 0.8rem;
        }
    </style>
@endpush
