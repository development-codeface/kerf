@extends('doctor.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('doctor.leave.store') }}">
            @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- {{$leaves}} -->
                            <!-- <div class="col-md-3 col-lg-6">
                                <div class="form-group">
                                        <label >Employee ID:</label>
                                        <div class="input-group">
                                        
                                        </div>
                                    </div>
                            </div> -->

                            <div class="col-md-3 col-lg-6">
                                <div class="form-group">
                                    <label >Start Date:</label>
                                    <input type="hidden" id="employee_id" value="{{ $doctor->id}}" name="employee_id" class="form-control" required>     
                                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-6">
                                <div class="form-group">
                                    <label >End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-6">
                                <div class="form-group">
                                    <label >Leave Type:</label>
                                    <div class="form-group">
                                    <select id="leave_type" name="leave_type" required>
                                        <option value="annual">Annual Leave</option>
                                        <option value="sick">Sick Leave</option>
                                        <option value="maternity">Maternity Leave</option>
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-6">
                                <div class="form-group">
                                     <label >Reason:</label>
                                    <textarea id="reason" name="reason" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')
                                </button>
                            </div>
                        </div>
                    </div>
            </form>

           
        </div>
    </div>

    <div class="row mb-none-30 mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>@lang('Current Leaves')</h4>
                    <hr>
                    <label><p>Number of leaves: {{ count($leaves) }}</p></label>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                        @if (count($leaves) > 0 )
                        @foreach($leaves as $leave)
                            <tr>
                                <td>{{ $leave->id }}</td>
                                <td>{{ $leave->start_date->formatLocalized('%d %B %Y') }}</td>
                                <td>{{ $leave->end_date->formatLocalized('%d %B %Y') }} - {{ $leave->leave_days }} days ({{ $leave->leave_type }})</td>
                                <td>
                                    <form action="{{ route('doctor.leave.destroy', $leave->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <!-- <button type="button" class="btn btn--primary ">Edit</button> -->
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="4">@lang('No leaves found.')</td>
                            </tr>
                        @endif
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/datepicker.min.css')}}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/jquery.multiselect.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            'use strict';
       
            $('select[name=slot_type]').on('change', function() {
                var type = $(this).val();
                schedule(type);
            })
            

            $('#serial_day').on('blur', function() { 
                window.location = window.location.href;
            });

            window.onbeforeunload = function() {
                localStorage.setItem("serial_day", $('#serial_day').val());
            }

            window.onload = function() {

                var name = localStorage.getItem("serial_day");
                if (name !== null) $('#serial_day').val(name);
                let days = $("#serial_day").val();
                
                var daysArr = [];
                var currentDate = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                for (var i = 0; i < days; i++) {
                    var nextDay = new Date(currentDate.getTime() + i * 24 * 60 * 60 * 1000);
                    daysArr.push(nextDay.toLocaleDateString('en-US', options));
                }
                var selectElement = $("#WorkingDays");
               
                // $("#ms-list-1").remove();
                $.each(daysArr, function(index, value) {
                    selectElement.append($("<option></option>").attr("value", value).text(value));
                    
                });
                $('#WorkingDays').multiselect({ texts: { placeholder: 'Select options' } ,selectAll: true});
            }


            var type = $('select[name=slot_type]').val();
            if (type) {
                schedule(type);
            }

            function schedule(type) {
                if (type == 1) {
                    $('.duration').addClass('d-none');
                    $('.serial').removeClass('d-none');
                    $('.start').addClass('d-none');
                    $('.end').addClass('d-none');
                } else {
                    $('.start').removeClass('d-none');
                    $('.end').removeClass('d-none');
                    $('.serial').addClass('d-none');
                    $('.duration').removeClass('d-none')
                }
            }

            initTimePicker();

            function initTimePicker() {
                var start = new Date();
                start.setHours(9);
                start.setMinutes(0);

                $('.time-picker').datepicker({
                    onlyTimepicker: true,
                    timepicker: true,
                    startDate: start,
                    language: 'en',
                    minHours: 0,
                    maxHours: 23,
                });
            }
        })(jQuery);
    </script>
@endpush
