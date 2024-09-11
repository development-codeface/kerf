<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo e(route('doctor.schedule.update')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Slot Type'); ?></label>
                                    <select name="slot_type" id="slot-type" class="form-control" required>
                                        <option value="" selected disabled><?php echo app('translator')->get('Select One'); ?></option>
                                        <option value="1" <?php if($doctor->slot_type == 1): echo 'selected'; endif; ?>><?php echo app('translator')->get('Serial'); ?></option>
                                        <option value="2" <?php if($doctor->slot_type == 2): echo 'selected'; endif; ?>><?php echo app('translator')->get('Time'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('For How Many Days'); ?>
                                        <i class="fa fa-info-circle text--primary" title="<?php echo app('translator')->get('This will define that your appointment booking will be taken for the next how many days including today. That means with everyday it will add your given value.'); ?>">
                                    </i>
                                </label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="serial_day"
                                            value="<?php echo e($doctor->serial_day); ?>" required>
                                        <span class="input-group-text"><?php echo app('translator')->get('Days'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-6 start d-none">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Morning Start Time'); ?></label>
                                    <div class="input-group">
                                        <input type="text" name="start_time"
                                            value="<?php echo e(old('start_time', $doctor->start_time)); ?>"
                                            class="form-control time-picker" autocomplete="off">
                                        <span class="input-group-text"><i class="las la-clock"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-6 end d-none">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Morning end Time'); ?></label>
                                    <div class="input-group">
                                        <input type="text" name="end_time"
                                            value="<?php echo e(old('end_time', $doctor->end_time)); ?>"
                                            class="form-control time-picker" autocomplete="off">
                                        <span class="input-group-text"><i class="las la-clock"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- new code Added Shamim -->
                            <div class="col-md-3 col-lg-6 start d-none">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Evening Start Time'); ?></label>
                                    <div class="input-group">
                                        <input type="text" name="start_time_evening"
                                            value="<?php echo e(old('start_time', $doctor->start_time_evening)); ?>"
                                            class="form-control time-picker" autocomplete="off">
                                        <span class="input-group-text"><i class="las la-clock"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-6 end d-none">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('End Time'); ?></label>
                                    <div class="input-group">
                                        <input type="text" name="end_time_evening"
                                            value="<?php echo e(old('end_time_evening', $doctor->end_time_evening)); ?>"
                                            class="form-control time-picker" autocomplete="off">
                                        <span class="input-group-text"><i class="las la-clock"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 duration d-none">
                                <div class="form-group">
                                    <label> <?php echo app('translator')->get('Time Duration'); ?></label>
                                    <div class="input-group">
                                        <input type="text" name="duration" class="form-control"
                                            value="<?php echo e(old('duration', $doctor->duration)); ?>">
                                            <span class="input-group-text"><?php echo app('translator')->get('Minutes'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-12 serial d-none">
                                <div class="form-group">
                                    <label> <?php echo app('translator')->get('Maximum Serial'); ?></label>
                                    <input type="text" class="form-control" name="max_serial"
                                        value="<?php echo e(old('max_serial', $doctor->max_serial)); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?>
                                </button>
                            </div>
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
                    <?php if($doctor->slot_type && $doctor->serial_or_slot): ?>
                        <h4><?php echo app('translator')->get('System of Current Schedule'); ?></h4>
                        <hr>
                        <div class="mt-4">
                          
                            <?php $__currentLoopData = $doctor->serial_or_slot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" class="btn btn--primary mr-2 mb-2"><?php echo e($item); ?></button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                        </div>
                       <?php echo e($doctor->eve_slots); ?>

                    <?php else: ?>
                        <h5 class="text-center"><?php echo app('translator')->get('You have no schedule'); ?>!</h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/vendor/datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/vendor/datepicker.en.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            'use strict';

            $('select[name=slot_type]').on('change', function() {
                var type = $(this).val();
                schedule(type);
            })

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/doctor/schedule/index.blade.php ENDPATH**/ ?>