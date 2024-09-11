<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="<?php echo e(route('doctor.dashboard')); ?>" class="sidebar__main-logo"><img
                    src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo_dark.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item <?php echo e(menuActive('doctor.dashboard')); ?>">
                    <a href="<?php echo e(route('doctor.dashboard')); ?>" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Dashboard'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('doctor.appointment*', 3)); ?>">
                        <i class="menu-icon las la-handshake"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Appointments'); ?></span>
                        <?php if(@$newAppointmentsCount): ?>
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('doctor.appointment*', 2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.appointment.booking')); ?> ">
                                <a href="<?php echo e(route('doctor.appointment.booking')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Make Appoinment'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.appointment.new')); ?> ">
                                <a href="<?php echo e(route('doctor.appointment.new')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('New Appointments'); ?></span>
                                    <?php if(@$newAppointmentsCount): ?>
                                        <span
                                            class="menu-badge pill bg--danger ms-auto"><?php echo e($newAppointmentsCount); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.appointment.done')); ?> ">
                                <a href="<?php echo e(route('doctor.appointment.done')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Done Appointments'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.appointment.trashed')); ?> ">
                                <a href="<?php echo e(route('doctor.appointment.trashed')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Trashed Appointments'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('doctor.leave.index')); ?>">
                    <a href="<?php echo e(route('doctor.leave.index')); ?>" class="nav-link ">
                        <i class="menu-icon las la-user-plus "></i>
                        <span class="menu-title"><?php echo app('translator')->get('Manage Leaves'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('doctor.schedule.index')); ?>">
                    <a href="<?php echo e(route('doctor.schedule.index')); ?>" class="nav-link ">
                        <i class="menu-icon las la-calendar-check"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Schedules'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('doctor.info*', 3)); ?>">
                        <i class="menu-icon las la-info-circle"></i>
                        <span class="menu-title"><?php echo app('translator')->get('My Info'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('doctor.info*', 2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.info.profile')); ?> ">
                                <a href="<?php echo e(route('doctor.info.profile')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Profile'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.info.about')); ?> ">
                                <a href="<?php echo e(route('doctor.info.about')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('About'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.info.speciality')); ?> ">
                                <a href="<?php echo e(route('doctor.info.speciality')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Speciality'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.info.educations')); ?> ">
                                <a href="<?php echo e(route('doctor.info.educations')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Education'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.info.experiences')); ?> ">
                                <a href="<?php echo e(route('doctor.info.experiences')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Experiences'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('doctor.info.social.icon')); ?> ">
                                <a href="<?php echo e(route('doctor.info.social.icon')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Social Icons'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary"><?php echo e(__(systemDetails()['name'])); ?></span>
                <span class="text--success"><?php echo app('translator')->get('V'); ?><?php echo e(systemDetails()['version']); ?> </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

<?php $__env->startPush('script'); ?>
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/doctor/partials/sidenav.blade.php ENDPATH**/ ?>