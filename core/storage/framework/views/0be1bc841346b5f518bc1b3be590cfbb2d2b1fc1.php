<?php $__env->startSection('content'); ?>
<section  class="appoint-section ptb-80">
    <div class="container">
        <div class="booking-search-area">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="appoint-content">
                        <form class="appoint-form" action="<?php echo e(route('doctors.search')); ?>" method="get">
                            <div class="search-location form-group">
                                <div class="appoint-select">
                                    <select class="chosen-select locations" name="location">
                                        <option value="" selected disabled><?php echo app('translator')->get('Location'); ?></option>
                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($location->id); ?>" <?php if($location->id == request()->location): echo 'selected'; endif; ?>>
                                            <?php echo e(__($location->name)); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="search-location form-group">
                                <div class="appoint-select">
                                    <select class="chosen-select locations" name="department">
                                        <option value="" selected disabled><?php echo app('translator')->get('Department'); ?></option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>" <?php if($department->id == request()->department): echo 'selected'; endif; ?>>
                                            <?php echo e(__($department->name)); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="search-info form-group">
                                <div class="appoint-select">
                                    <select class="chosen-select locations" name="doctor">
                                        <option value="" selected disabled><?php echo app('translator')->get('Doctor'); ?></option>
                                        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($doctor->id); ?>" <?php if($doctor->id == request()->doctor): echo 'selected'; endif; ?>>
                                            <?php echo e(__($doctor->name)); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="search-btn cmn-btn"><i class="las la-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center ml-b-30">
            <?php $__empty_1 = true; $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-3 col-md-6 col-sm-6 mrb-30">
                <div class="booking-item">
                    <div class="booking-thumb">
                        <img src="<?php echo e(getImage(getFilePath('doctorProfile') . '/' . @$doctor->image, getFileSize('doctorProfile'))); ?>"
                            alt="<?php echo app('translator')->get('booking'); ?>">
                        <span class="doc-deg">
                            <a href="<?php echo e(route('doctors.departments', $doctor->department->id)); ?>"><?php echo e(__($doctor->department->name)); ?></a>
                        </span>
                        <?php if($doctor->featured): ?>
                        <span class="fav-btn"><i class="fas fa-medal"></i></span>
                        <?php endif; ?>
                    </div>
                    <div class="booking-content">
                        <h5 class="title"><?php echo e(__($doctor->name)); ?> <i class="fas fa-check-circle text-success"></i></h5>
                        <p><?php echo e(strLimit(__($doctor->qualification), 50)); ?></p>
                        <ul class="booking-list">
                            <li>
                                <!-- <i class="fas fa-street-view"></i> -->
                                <a href="<?php echo e(route('doctors.locations', $doctor->location->id)); ?>"><?php echo e(__($doctor->location->name)); ?></a>
                            </li>
                            <li>
                                <!-- <i class="fas fa-phone"></i>  -->
                                <?php echo e(__($doctor->mobile)); ?></li>
                        </ul>
                        <div class="booking-btn">
                            <a href="<?php echo e(route('doctors.booking', $doctor->id)); ?>" class="cmn-btn w-100 text-center"><?php echo app('translator')->get('Book Now'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-lg-12 col-md-12 col-sm-12 mrb-30">
                <div class="booking-item text-center">
                    <h3 class="title mt-2"><?php echo e(__($emptyMessage)); ?></h3>
                    <div class="booking-btn mt-4 mb-2">
                        <a href="javascript:window.history.back();" class="cmn-btn"><?php echo app('translator')->get('Go Back'); ?></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php echo e($doctors->links()); ?>

    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/templates/basic/search.blade.php ENDPATH**/ ?>