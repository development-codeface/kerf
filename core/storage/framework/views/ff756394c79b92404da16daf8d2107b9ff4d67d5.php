<?php $__env->startSection('content'); ?>
<!-- booking-section start -->
<section class="booking-section booking-section-two pd-t-80 pd-b-40 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="booking-item d-flex flex-wrap align-items-center justify-content-between mb-5">
                    <div class="booking-left d-flex align-items-center">
                        <div class="booking-thumb">
                            <img src="<?php echo e(getImage(getFilePath('doctorProfile') . '/' . $doctor->image, getFileSize('doctorProfile'))); ?>"
                                alt="<?php echo app('translator')->get('doctor'); ?>">
                            <?php if($doctor->featured): ?>
                            <span class="fav-btn"><i class="las la-medal"></i></span>
                            <?php endif; ?>
                        </div>
                        <div class="booking-content">
                            <span class="sub-title"><a href="#0"><?php echo e(__($doctor->department->name)); ?></a></span>
                            <h5 class="title"><?php echo e(__($doctor->name)); ?> <i class="fas fa-check-circle"></i></h5>
                            <p><?php echo e(__($doctor->qualification)); ?></p>

                            <ul class="booking-list">
                                <li>
                                    <!-- <i class=" fas fa-street-view"></i> -->
                                    <?php echo e(__($doctor->location->name)); ?>

                                </li>
                                <li>
                                    <!-- <i class="fas fa-phone"></i> -->
                                    <?php echo e(__($doctor->mobile)); ?>

                                </li>
                            </ul>

                            <?php if($doctor->speciality || !empty($doctor->speciality)): ?>
                            <div class="booking-btn">
                                <?php $__currentLoopData = $doctor->speciality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="border-btn"><?php echo e(__($item)); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- <div class="booking-right">
                            <div class="booking-content">
                                <ul class="booking-list">
                                    <li><i class="fas fa-hourglass-start"></i><?php echo app('translator')->get('Joined us'); ?> :</li>
                                    <li><i class="fas fa-stethoscope"></i><?php echo e(diffForHumans($doctor->created_at)); ?></li>
                                    <li><span><i class="las la-wallet"></i><?php echo app('translator')->get('Fees'); ?> : <?php echo e(__($doctor->fees)); ?>

                                            <?php echo e(__($general->cur_text)); ?><span></li>
                                </ul>
                                <ul class="booking-tag">
                                    <?php $__currentLoopData = $doctor->socialIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e($social->url); ?>" target="_blank"><?php echo $social->icon ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <div class="booking-btn">
                                    <?php if($doctor->serial_day && $doctor->serial_or_slot): ?>
                                        <span class="border-btn active"><i class="la la-check-circle"></i>
                                            <?php echo app('translator')->get('Appointment Available'); ?></span>
                                    <?php else: ?>
                                        <span class="border-btn active"><i class="la la-times-circle"></i>
                                            <?php echo app('translator')->get('Appointment Unavailable'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- booking-section end -->

<!-- overview-section start -->
<section class="overview-section pd-b-80">
    <div class="container">
        <div class="overview-area mrb-40">
            <div class="row">
                <div class="col-lg-12">
                    <div class="overview-tab-wrapper">
                        <ul class="tab-menu">
                            <!-- <li><?php echo app('translator')->get('Overview'); ?></li> -->
                            <li class="active"><?php echo app('translator')->get('Booking'); ?></li>

                            <?php if(loadFbComment() != null): ?>
                            <li><?php echo app('translator')->get('Review'); ?></li>
                            <?php endif; ?>
                        </ul>
                        <div class="tab-cont">
                            <div class="tab-item">
                                <div class="overview-tab-content ml-b-30">
                                    <div class="overview-content">
                                        <h5 class="title"><?php echo app('translator')->get('About Me'); ?></h5>
                                        <p>
                                            <?php if($doctor->about): ?>
                                            <?php echo e(__($doctor->about)); ?>

                                            <?php else: ?>
                                            <span><?php echo app('translator')->get('Doctor about will be appearing soon'); ?></span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="overview-content">
                                        <h5 class="title"><?php echo app('translator')->get('Education'); ?></h5>
                                        <div class="overview-box">
                                            <?php if(count($doctor->educationDetails)): ?>
                                            <ul class="overview-list">
                                                <?php $__currentLoopData = $doctor->educationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <div class="overview-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="overview-details">
                                                        <h6 class="title"><?php echo e(__($education->institution)); ?>

                                                        </h6>
                                                        <div><?php echo e(__($education->discipline)); ?></div>
                                                        <span><?php echo e(__($education->period)); ?></span>
                                                    </div>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php else: ?>
                                            <span><?php echo app('translator')->get('Education data will be appearing soon'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="overview-content">
                                        <h5 class="title"><?php echo app('translator')->get('Work & Experience'); ?></h5>
                                        <div class="overview-box">
                                            <?php if(count($doctor->experienceDetails)): ?>
                                            <ul class="overview-list">
                                                <?php $__currentLoopData = $doctor->experienceDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <div class="overview-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="overview-details">
                                                        <h6 class="title"><?php echo e(__($experience->institution)); ?>

                                                        </h6>
                                                        <div><?php echo e(__($experience->discipline)); ?></div>
                                                        <span><?php echo e(__($experience->period)); ?></span>
                                                    </div>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                            <?php else: ?>
                                            <span><?php echo app('translator')->get('Experience data will be appearing soon'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="overview-content">
                                        <h5 class="title"><?php echo app('translator')->get('Specializations'); ?></h5>
                                        <div class="overview-footer-area d-flex flex-wrap justify-content-between">
                                            <?php if($doctor->speciality): ?>
                                            <ul class="overview-footer-list">
                                                <?php if($doctor->speciality || !empty($doctor->speciality)): ?>
                                                <?php $__currentLoopData = $doctor->speciality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><i
                                                        class="fas fa-long-arrow-alt-right"></i><?php echo e(__($item)); ?>

                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                            <?php else: ?>
                                            <span><?php echo app('translator')->get('Specializations data will be appearing soon'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-item">
                                <div class="overview-tab-content">
                                    <div
                                        class="overview-booking-header d-flex flex-wrap justify-content-between ml-b-10">
                                        <div class="overview-booking-header-left mrb-10">
                                            <?php if($doctor->serial_day && $doctor->serial_or_slot): ?>
                                            <h4 class="title"><?php echo app('translator')->get('Available Schedule'); ?></h4>
                                            <ul class="overview-booking-list">
                                                <li class="available"><?php echo app('translator')->get('Available'); ?></li>
                                                <li class="booked"><?php echo app('translator')->get('Booked'); ?></li>
                                                <li class="selected"><?php echo app('translator')->get('Selected'); ?></li>
                                            </ul>
                                            <?php else: ?>
                                            <h4 class="title"><?php echo app('translator')->get('No Schedule Available Yet'); ?></h4>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <?php if($doctor->serial_day && $doctor->serial_or_slot): ?>
                                    <form action="<?php echo e(route('doctors.appointment.store', $doctor->id)); ?>"
                                        method="post" class="appointment-from">
                                        <?php echo csrf_field(); ?>
                                        <div class="overview-booking-area">
                                            <div class="overview-booking-header-right mrb-10">
                                                <div
                                                    class="overview-date-area d-flex flex-wrap align-items-center justify-content-start gap-8">
                                                    <div class="overview-date-header">
                                                        <h5 class="title"><?php echo app('translator')->get('Choose Your Date & Time'); ?></h5>
                                                    </div>
                                                    <div class="overview-date-select">
                                                        <select class="form-control date-select" name="booking_date" id="booking_date"
                                                            required>
                                                            <option value="" selected disabled>
                                                                <?php echo app('translator')->get('Select Date'); ?></option>
                                                            <?php $__currentLoopData = $availableDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($date); ?>">
                                                                <?php echo e(__(date('d-m-Y', strtotime($date)))); ?>

                                                            </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div
                                                    class="overview-date-area d-flex flex-wrap align-items-center justify-content-start gap-1">
                                                    <div class="overview-date-header">
                                                        <input type="checkbox" value="<?php echo e($doctor->revisit_fees); ?>" name="re_visit" id="re_visit" />
                                                       
                                                    </div>
                                                    <div class="overview-date-select">
                                                        <h6 class="title"><?php echo app('translator')->get('Re-visit'); ?></h6>
                                                       
                                                    </div>
                                                </div>

                                            </div>
                                            <ul class="clearfix time-serial-parent">
                                                <?php $__currentLoopData = $doctor->serial_or_slot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="javascript:void(0)"
                                                        class="btn btn--primary mr-2 mb-2 available-time item-<?php echo e(slug($item)); ?>"
                                                        data-value="<?php echo e($item); ?>"><?php echo e(__($item)); ?>

                                                    </a>
                                                </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <input type="hidden" name="time_serial" class="time" required>
                                            </ul>
                                        </div>
                                        <div class="booking-appoint-area">
                                            <div class="row justify-content-center ml-b-30">
                                                <div class="col-lg-6 mrb-30">
                                                    <div class="booking-appoint-form-area">
                                                        <h4 class="title"><?php echo app('translator')->get('Appointment Form'); ?></h4>
                                                        <div class="booking-appoint-form">
                                                            <div class="row">
                                                                <div class="col-lg-6 form-group">
                                                                    <input type="text" name="name"
                                                                        class="form-control"
                                                                        placeholder="<?php echo app('translator')->get('Enter Name'); ?>" required>
                                                                </div>
                                                                <div class="col-lg-6 form-group">
                                                                    <input type="number" name="age"
                                                                        class="form-control"
                                                                        placeholder="<?php echo app('translator')->get('Enter Age'); ?>" required>
                                                                </div>
                                                                <div class="col-lg-12 form-group">
                                                                    <input type="email" name="email"
                                                                        class="form-control"
                                                                        placeholder="<?php echo app('translator')->get('Enter E-mail'); ?>" required>
                                                                </div>
                                                                <div class="col-lg-12 form-group">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-text"><?php echo e($general->country_code); ?></span>
                                                                        <input type="number" name="mobile"
                                                                            class="form-control"
                                                                            placeholder="<?php echo app('translator')->get('Enter Mobile Number'); ?>" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 form-group">
                                                                    <textarea name="disease" placeholder="<?php echo app('translator')->get('Enter Details'); ?>"></textarea>
                                                                </div>
                                                                <div
                                                                    class="col-lg-12 form-group d-flex flex-wrap justify-content-start gap-3">
                                                                    <button type="submit"
                                                                        class="cmn-btn payment-system"
                                                                        data-value="2"><?php echo app('translator')->get('Pay In Cash'); ?></button>

                                                                    <?php if($general->online_payment): ?>
                                                                    <button type="submit"
                                                                        class="cmn-btn payment-system"
                                                                        data-value="1"><?php echo app('translator')->get('Pay Online'); ?></button>
                                                                    <?php endif; ?>
                                                                    <input type="hidden" name="payment_system"
                                                                        class="payment" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mrb-30">
                                                    <div class="booking-confirm-area">
                                                        <h4 class="title"><?php echo app('translator')->get('Confirm Your Booking'); ?></h4>
                                                        <ul class="booking-confirm-list">
                                                            <li><span><?php echo app('translator')->get('Patient Name'); ?></span> : <span
                                                                    class="custom-color name"></span>
                                                            </li>
                                                            <li><span><?php echo app('translator')->get('Age'); ?></span> : <span
                                                                    class="custom-color age"> 0 </span>
                                                                <?php echo app('translator')->get('Years'); ?>
                                                            </li>
                                                            <li><span><?php echo app('translator')->get('Email'); ?></span> : <span
                                                                    class="custom-color email"></span>
                                                            </li>
                                                            <li><span><?php echo app('translator')->get('Phone Number'); ?></span> : <span
                                                                    class="custom-color mobile"></span>
                                                            </li>
                                                            <li><span><?php echo app('translator')->get('Date'); ?></span> : <span
                                                                    class="custom-color date"></span>
                                                            </li>
                                                            <li><span><?php echo app('translator')->get('Serial / Slot'); ?></span> :
                                                                <span class="custom-color book-time"></span>
                                                            </li>
                                                            <li id="feeli"><span><?php echo app('translator')->get('Fees'); ?></span> :
                                                                <?php echo e($doctor->fees); ?> <?php echo e($general->cur_text); ?>

                                                            </li>
                                                            <li id="re-feeli"><span><?php echo app('translator')->get('Fees'); ?></span> :
                                                                <?php echo e($doctor->revisit_fees); ?> <?php echo e($general->cur_text); ?>

                                                            </li>
                                                        </ul>
                                                        <div class="booking-confirm-btn">
                                                            <button type="button"
                                                                class="cmn-btn-active reset"><?php echo app('translator')->get('Reset'); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(loadFbComment() != null): ?>
                            <div class="tab-item">
                                <div class="comments-section">
                                    <div class="fb-comments" data-href="<?php echo e(url()->current()); ?>"
                                        data-numposts="5">
                                        <?php echo loadFbComment() ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- overview-section end -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
<style>
    .input-group-text {
        border-radius: 0.5rem 0 0 0.5rem !important;
    }
    #booking_date{margin-left: 70px;}
    #re_visit{vertical-align: text-top;margin-top: -2px;}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    (function($) {
        "use strict";

        $(".available-time").on('click', function() {
            $('.time').val($(this).data('value'));
            $('.book-time').text($(this).data('value'));
        });

        $('#re-feeli').hide();
        $('#re_visit').on('change', function() {
            if ($(this).is(':checked')) {
            $('#feeli').hide();
            $('#re-feeli').show();
            } else {
            $('#re-feeli').hide();
            $('#feeli').show();
            }
        });

        function slug(text) {
            return text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        }

        $("select[name=booking_date]").on('change', function() {
            $('.date').text(`${$(this).val()}`); // Add date to view

            $('.available-time').removeClass('btn--success disabled').addClass('active-time');

            let url = "<?php echo e(route('doctors.appointment.available.date')); ?>";
            let data = {
                date: $(this).val(),
                doctor_id: '<?php echo e($doctor->id); ?>'
            }

            $.get(url, data, function(response) {
                if (!response.length) {
                    $('.available-time').removeClass('active-time disabled');
                } else {
                    $.each(response, function(key, value) {
                        var demo = slug(value);
                        $(`.item-${demo}`).addClass('active-time disabled');
                    });
                }
            });
        });

        $("[name=name]").on('input', function() {
            $('.name').text(`${$(this).val()}`);
        });
        $("[name=age]").on('input', function() {
            $('.age').text(`${$(this).val()}`);
        });
        $("[name=email]").on('input', function() {
            $('.email').text(`${$(this).val()}`);
        });
        $("[name=mobile]").on('input', function() {
            $('.mobile').text(`${$(this).val()}`);
        });


        $(".reset").on('click', function() {
            $('.appointment-from')[0].reset();
        });

        $('.payment-system').on('click', function() {
            $('.payment').val($(this).data('value'));
        });


    })(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/templates/basic/booking.blade.php ENDPATH**/ ?>