<header class="header-section header-section-two">

    <div class="header">
        <div class="header-bottom-area">
            <div class="container-fluid">
                <div class="header-menu-content">
                    <nav class="flex-nowrap navbar navbar-expand-lg p-0">
                        <a class="site-logo site-title" href="<?php echo e(route('home')); ?>"><img
                                src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.svg')); ?>" alt="logo"></a>
                        <?php if($general->multi_language): ?>
                        <div class=" d-none ml-auto">
                            <select class="langSel form-control">
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->code); ?>" <?php if(session('lang')==$item->code): ?> selected <?php endif; ?>>
                                    <?php echo e(__($item->name)); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <div class="m3p-container ml-auto">
                            <a rel="noindex" class="t9q-phone" href="tel:+919995135989">+91 9995 135 989</a>
                            <span class="f2r-separator"> | </span>
                            <a rel="noindex" class="h6w-appointment" href="#">Book an Appointment</a>
                        </div>
                        <button class="navbar-toggler ml-auto collapsed  d-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="las la-bars"></i>
                        </button>
                        <!-- <div class=" collapse navbar-collapse " id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu mx-auto justify-content-center">
                                <li class="<?php echo e(menuActive('home')); ?>"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                                <li class="<?php echo e(menuActive('doctors.all')); ?>"><a href="<?php echo e(route('doctors.all')); ?>"><?php echo app('translator')->get('Doctors'); ?></a></li>
                                
                                <?php
                                $pages = App\Models\Page::where('tempname', $activeTemplate)
                                ->where('is_default', 0)
                                ->get();
                                ?>
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('pages', [$data->slug])); ?>"><?php echo e(__($data->name)); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <li class="<?php echo e(menuActive('blogs')); ?>"><a
                                        href="<?php echo e(route('blogs')); ?>"><?php echo app('translator')->get('Blogs'); ?></a>
                                </li>
                                <li class="<?php echo e(menuActive('contact')); ?>"><a
                                        href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a></li>
                            </ul>
                            <?php if($general->multi_language): ?>
                                <div class="language-select d-none">
                                    <select class="nice-select langSel language-select">
                                        <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(__($item->code)); ?>"
                                                <?php if(session('lang') == $item->code): ?> selected <?php endif; ?>><?php echo e(__($item->name)); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <div class="header-bottom-action d-none">
                                <a href="<?php echo e(route('doctors.all')); ?>" class="cmn-btn"><?php echo app('translator')->get('Book Now'); ?></a>
                            </div>
                            <div class="header-bottom-action d-none">
                                <a href="<?php echo e(route('login')); ?>" class="cmn-btn"><?php echo app('translator')->get('Login'); ?></a>
                            </div>
                        </div> -->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-section end --><?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/templates/basic/partials/header.blade.php ENDPATH**/ ?>