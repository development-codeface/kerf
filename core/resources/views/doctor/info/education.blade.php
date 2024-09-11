@extends('doctor.layouts.app')
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
                                    <th>@lang('Institution')</th>
                                    <th>@lang('Discipline')</th>
                                    <th>@lang('Period')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($educations as $education)
                                    <tr>
                                        <td>{{ $educations->firstItem() + $loop->index }}</td>
                                        <td>{{ __(strLimit($education->institution, 35)) }}</td>
                                        <td>{{ __(strLimit($education->discipline, 35)) }}</td>
                                        <td>{{ __($education->period) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline--primary editBtn cuModalBtn"
                                                data-resource="{{ $education }}" data-modal_title="@lang('Edit Education')"
                                                data-has_status="1">
                                                <i class="la la-pencil"></i>@lang('Edit')
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline--danger confirmationBtn"
                                                data-action="{{ route('doctor.info.education.delete', $education->id) }}"
                                                data-question="@lang('Are you sure to delete this education details')?">
                                                <i class="la la-trash"></i> @lang('Delete')
                                            </button>
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
                @if ($educations->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($educations) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
    <!--Cu Modal -->
    <div id="cuModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('doctor.info.education.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Institution')</label>
                            <input type="text" name="institution" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Discipline')</label>
                            <input type="text" name="discipline" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Period')</label>
                            <input type="text" name="period" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal />

@endsection

@push('breadcrumb-plugins')
<x-search-form />
<button type="button" class="btn btn-sm btn-outline--primary h-45 cuModalBtn" data-modal_title="@lang('Add Education')">
    <i class="las la-plus"></i>@lang('Add New')
</button>
@endpush

