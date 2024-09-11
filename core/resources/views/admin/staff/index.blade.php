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
                                    <th>@lang('Joined At')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($staff as $item)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                            <br>
                                            <small>
                                                <a href="{{ route('admin.staff.detail', $item->id) }}"><span>@</span>{{ $item->username }}</a>
                                            </small>
                                        </td>

                                        <td><span class="d-block fw-bold">{{$general->country_code . $item->mobile }}</span> {{ $item->email }}</td>
                                        <td>
                                            {{ showDateTime($item->created_at) }} <br>
                                            {{ diffForHumans($item->created_at) }}
                                        </td>

                                        <td> @php echo $item->statusBadge @endphp </td>
                                        <td>
                                            <div class="button--group">
                                                <a href="{{ route('admin.staff.detail', $item->id) }}"
                                                    class="btn btn-sm btn-outline--primary">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </a>

                                                @if ($item->status == Status::ACTIVE)
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--danger confirmationBtn"
                                                        data-action="{{ route('admin.staff.status', $item->id) }}"
                                                        data-question="@lang('Are you sure to Inactive this staff?')">
                                                        <i class="la la-eye-slash"></i> @lang('Inactive')
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline--success ms-1 confirmationBtn"
                                                        data-action="{{ route('admin.staff.status', $item->id) }}"
                                                        data-question="@lang('Are you sure to Active this staff?')">
                                                        <i class="la la-eye"></i> @lang('Active')
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
                @if ($staff->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($staffs) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form/>
    <a href="{{ route('admin.staff.form')}}" type="button" class="btn btn-sm btn-outline--primary h-45">
        <i class="las la-plus"></i>@lang('Add New')
    </a>
@endpush
