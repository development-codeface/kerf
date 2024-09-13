<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Appointment Details')</h5>
                <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <ul class="list-group-flush list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('Patient Name') :
                        <span class="name"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('Booking Date') :
                        <span class="bookingDate"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('Time or Serial no') :
                        <span class="timeSerial"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('Contact No') :
                        <span class="mobile"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('E-mail') :
                        <span class="email"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('Age') :
                        <span class="age"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('Fees') :
                        <span class="appointment_fees"></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        @lang('OP Number') :
                        <span class="op_number"></span>
                    </li>
                    
                    <li class="list-group-item align-items-center fw-bold">
                        @lang('Disease') :
                        <p class="disease text-end"></p>
                    </li>
                </ul>
                <hr>
                <div>
                    <p class="text--warning text-center"><i class="las la-exclamation-triangle"></i> @lang('Are you sure that the patient has paid')?
                    </p>
                    <p class="text-center text--success"><i class="las la-exclamation-triangle"></i> @lang('If yes, then you can mark this as service done').
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <form action="" class="dealing-route" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline--success btn-sm serviceDoneBtn"><i
                            class="las la-check"></i> @lang('Done')</button>
                    <button type="button" class="btn btn--dark btn-sm"
                        data-bs-dismiss="modal">@lang('Close')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var resourse = $(this).data('resourse');

conso.log(resourse);
                $('.name').text(resourse.name);
                $('.email').text(resourse.email);
                $('.mobile').text(resourse.mobile);
                $('.bookingDate').text(resourse.booking_date);
                $('.timeSerial').text(resourse.time_serial);
                $('.age').text(resourse.age);
                $('.op_number').text(resourse.op_number);
                $('.appointment_fees').text(resourse.doctor.fees + ' ' + `{{ $general->cur_text }}`);
                $('.disease').text(resourse.disease);

                var route = $(this).data('route');
                $('.dealing-route').attr('action', route);

                if (resourse.is_delete == 1 || resourse.is_complete == 1) {
                    modal.find('.serviceDoneBtn').hide();
                } else if (!resourse.is_complete && resourse.payment_status != 2) {
                    modal.find('.serviceDoneBtn').show();
                } else {
                    modal.find('.serviceDoneBtn').show();
                }

                modal.modal('show');
            });

            $('.removeBtn').on('click', function() {
                var modal = $('#removeModal');
                var route = $(this).data('route');
                $('.remove-route').attr('action', route);
            });

        })(jQuery);
    </script>
@endpush
