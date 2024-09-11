<?php $__env->startSection('content'); ?>
    <?php
        $socialElement = getContent('social_icon.element', false, null, true);
        $bannerElement = getContent('banner.element', false, null, true);
    ?>

<section class="banner">
    <?php if(count($socialElement) > 0): ?>
    <div class="banner-social-area">
        <span><?php echo app('translator')->get('Follow Us'); ?></span>
        <ul class="banner-social">
            <?php $__currentLoopData = $socialElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e($social->data_values->url); ?>" target="_blank"><?php echo $social->data_values->social_icon ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
    <div class="banner-slider">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $bannerElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <div class="banner-section bg-overlay-white bg_img"
                    data-background="<?php echo e(getImage('assets/images/frontend/banner/' . @$banner->data_values->image, '1150x700')); ?>">
                    <div class="custom-container">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-6 text-center">
                                <div class="banner-content">
                                    <h2 class="title"><?php echo e(__($banner->data_values->heading)); ?></h2>
                                    <p><?php echo e(__($banner->data_values->subheading)); ?></p>
                                    <div class="banner-btn">
                                        <a href="<?php echo e(route('doctors.all')); ?>" class="btn cmn-btn"><?php echo app('translator')->get('Make Appointment'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<?php if($sections->secs != null): ?>
<?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/templates/basic/home.blade.php ENDPATH**/ ?>