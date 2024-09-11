@props(['btn' => 'btn--info'])

<div class="input-group w-auto flex-fill">
    <select name="status" class="form-control" required>
        <option value="0" selected>@lang('All')</option>
        <option value="{{Status::ACTIVE}}" @selected(Status::ACTIVE == request()->status)>@lang('Active')</option>
        <option value="{{Status::INACTIVE}}" @selected(Status::INACTIVE == request()->status)>@lang('Inactive')</option>
    </select>
    <button class="btn {{ $btn }}"  type="submit"><i class="la la-search"></i></button>
</div>
