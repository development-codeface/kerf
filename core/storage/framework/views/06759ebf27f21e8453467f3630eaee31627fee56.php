<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar__main-logo"><img src="<?php echo e(getImage(getFilePath('logoIcon') .'/logo_dark.png')); ?>" alt="<?php echo app('translator')->get('image'); ?>"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.dashboard')); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Dashboard'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.department.index')); ?>">
                    <a href="<?php echo e(route('admin.department.index')); ?>" class="nav-link ">
                        <i class="menu-icon las la-layer-group"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Departments'); ?></span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo e(menuActive('admin.department.location')); ?>">
                    <a href="<?php echo e(route('admin.department.location')); ?>" class="nav-link ">
                        <i class="menu-icon las la-street-view"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Locations'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.appointment*',3)); ?>">
                        <i class="menu-icon las la-handshake"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Appointments'); ?></span>
                        <?php if(0 < $newAppointmentsCount): ?>
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.appointment*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.appointment.form')); ?> ">
                                <a href="<?php echo e(route('admin.appointment.form')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Make Appoinment'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.appointment.new')); ?> ">
                                <a href="<?php echo e(route('admin.appointment.new')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('New Appointments'); ?></span>
                                    <?php if($newAppointmentsCount): ?>
                                        <span class="menu-badge pill bg--danger ms-auto"><?php echo e($newAppointmentsCount); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.appointment.done')); ?> ">
                                <a href="<?php echo e(route('admin.appointment.done')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Done Appointments'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.appointment.trashed')); ?> ">
                                <a href="<?php echo e(route('admin.appointment.trashed')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Trashed Appointments'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.deposit*',3)); ?>">
                        <i class="menu-icon las la-file-invoice-dollar"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Payments'); ?></span>
                        <?php if(0 < $pendingDepositsCount): ?>
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.deposit*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.pending')); ?> ">
                                <a href="<?php echo e(route('admin.deposit.pending')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Pending'); ?></span>
                                    <?php if($pendingDepositsCount): ?>
                                        <span class="menu-badge pill bg--danger ms-auto"><?php echo e($pendingDepositsCount); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.approved')); ?> ">
                                <a href="<?php echo e(route('admin.deposit.approved')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Approved'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.successful')); ?> ">
                                <a href="<?php echo e(route('admin.deposit.successful')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Successful'); ?></span>
                                </a>
                            </li>


                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.rejected')); ?> ">
                                <a href="<?php echo e(route('admin.deposit.rejected')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Rejected'); ?></span>
                                </a>
                            </li>


                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.initiated')); ?> ">
                                <a href="<?php echo e(route('admin.deposit.initiated')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Initiated'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.deposit.list')); ?> ">
                                <a href="<?php echo e(route('admin.deposit.list')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('All'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.doctor*',3)); ?>">
                        <i class="menu-icon las la-stethoscope"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Manage Doctors'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.doctor*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.doctor.form')); ?> ">
                                <a href="<?php echo e(route('admin.doctor.form')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Add New'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.doctor.index')); ?> ">
                                <a href="<?php echo e(route('admin.doctor.index')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('All Doctors'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.doctor.active', Status::ACTIVE)); ?>">
                                <a href="<?php echo e(route('admin.doctor.active',Status::ACTIVE)); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Active Doctors'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.doctor.inactive',Status::INACTIVE)); ?>">
                                <a href="<?php echo e(route('admin.doctor.inactive', Status::INACTIVE)); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Inactive Doctors'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.doctor.notification.all')); ?>">
                                <a href="<?php echo e(route('admin.doctor.notification.all')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Notification to All'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.doctor.login.history')); ?>">
                                <a href="<?php echo e(route('admin.doctor.login.history')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Login History'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.assistant*',3)); ?>">
                        <i class="menu-icon las la-user-friends"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Manage Assistants'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.assistant*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.assistant.form')); ?> ">
                                <a href="<?php echo e(route('admin.assistant.form')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Add New'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.assistant.index')); ?> ">
                                <a href="<?php echo e(route('admin.assistant.index')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('All Assistants'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.assistant.active', Status::ACTIVE)); ?>">
                                <a href="<?php echo e(route('admin.assistant.active', Status::ACTIVE)); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Active Assistants'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.assistant.inactive', Status::INACTIVE)); ?>">
                                <a href="<?php echo e(route('admin.assistant.inactive', Status::INACTIVE)); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Inactive Assistants'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.assistant.notification.all')); ?>">
                                <a href="<?php echo e(route('admin.assistant.notification.all')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Notification to All'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.assistant.login.history')); ?>">
                                <a href="<?php echo e(route('admin.assistant.login.history')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Login History'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.staff*',3)); ?>">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Manage Staff'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.staff*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff.form')); ?> ">
                                <a href="<?php echo e(route('admin.staff.form')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Add New'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff.index')); ?> ">
                                <a href="<?php echo e(route('admin.staff.index')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('All Staff'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff.active', Status::ACTIVE)); ?>">
                                <a href="<?php echo e(route('admin.staff.active', Status::ACTIVE)); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Active Staff'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff.inactive', Status::INACTIVE)); ?>">
                                <a href="<?php echo e(route('admin.staff.inactive', Status::INACTIVE)); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Inactive Staff'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff.notification.all')); ?>">
                                <a href="<?php echo e(route('admin.staff.notification.all')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Notification to All'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.staff.login.history')); ?>">
                                <a href="<?php echo e(route('admin.staff.login.history')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Login History'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.gateway*',3)); ?>">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Payment Gateways'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.gateway*',2)); ?> ">
                        <ul>

                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.gateway.automatic.*')); ?> ">
                                <a href="<?php echo e(route('admin.gateway.automatic.index')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Automatic Gateways'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.gateway.manual.*')); ?> ">
                                <a href="<?php echo e(route('admin.gateway.manual.index')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Manual Gateways'); ?></span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>




                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.ticket*',3)); ?>">
                        <i class="menu-icon la la-ticket"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Support Ticket'); ?> </span>
                        <?php if(0 < $pendingTicketCount): ?>
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.ticket*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.pending')); ?> ">
                                <a href="<?php echo e(route('admin.ticket.pending')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Pending Ticket'); ?></span>
                                    <?php if($pendingTicketCount): ?>
                                    <span
                                    class="menu-badge pill bg--danger ms-auto"><?php echo e($pendingTicketCount); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.closed')); ?> ">
                                <a href="<?php echo e(route('admin.ticket.closed')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Closed Ticket'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.answered')); ?> ">
                                <a href="<?php echo e(route('admin.ticket.answered')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Answered Ticket'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.ticket.index')); ?> ">
                                <a href="<?php echo e(route('admin.ticket.index')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('All Ticket'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.report*',3)); ?>">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Report'); ?> </span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.report*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive(['admin.report.transaction','admin.report.transaction.search'])); ?>">
                                <a href="<?php echo e(route('admin.report.transaction')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Transaction Log'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.report.notification.history')); ?>">
                                <a href="<?php echo e(route('admin.report.notification.history')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Notification History'); ?></span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item  <?php echo e(menuActive('admin.subscriber.*')); ?>">
                    <a href="<?php echo e(route('admin.subscriber.index')); ?>" class="nav-link"
                       data-default-url="<?php echo e(route('admin.subscriber.index')); ?>">
                        <i class="menu-icon las la-thumbs-up"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Subscribers'); ?> </span>
                    </a>
                </li>


                <li class="sidebar__menu-header"><?php echo app('translator')->get('Settings'); ?></li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.index')); ?>">
                    <a href="<?php echo e(route('admin.setting.index')); ?>" class="nav-link">
                        <i class="menu-icon las la-life-ring"></i>
                        <span class="menu-title"><?php echo app('translator')->get('General Setting'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.system.configuration')); ?>">
                    <a href="<?php echo e(route('admin.setting.system.configuration')); ?>" class="nav-link">
                        <i class="menu-icon las la-cog"></i>
                        <span class="menu-title"><?php echo app('translator')->get('System Configuration'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.logo.icon')); ?>">
                    <a href="<?php echo e(route('admin.setting.logo.icon')); ?>" class="nav-link">
                        <i class="menu-icon las la-images"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Logo & Favicon'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.extensions.index')); ?>">
                    <a href="<?php echo e(route('admin.extensions.index')); ?>" class="nav-link">
                        <i class="menu-icon las la-cogs"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Extensions'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item  <?php echo e(menuActive(['admin.language.manage','admin.language.key'])); ?>">
                    <a href="<?php echo e(route('admin.language.manage')); ?>" class="nav-link"
                       data-default-url="<?php echo e(route('admin.language.manage')); ?>">
                        <i class="menu-icon las la-language"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Language'); ?> </span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.seo')); ?>">
                    <a href="<?php echo e(route('admin.seo')); ?>" class="nav-link">
                        <i class="menu-icon las la-globe"></i>
                        <span class="menu-title"><?php echo app('translator')->get('SEO Manager'); ?></span>
                    </a>
                </li>




                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.setting.notification*',3)); ?>">
                        <i class="menu-icon las la-bell"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Notification Setting'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.setting.notification*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.global')); ?> ">
                                <a href="<?php echo e(route('admin.setting.notification.global')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Global Template'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.email')); ?> ">
                                <a href="<?php echo e(route('admin.setting.notification.email')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Email Setting'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.sms')); ?> ">
                                <a href="<?php echo e(route('admin.setting.notification.sms')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('SMS Setting'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.notification.templates')); ?> ">
                                <a href="<?php echo e(route('admin.setting.notification.templates')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Notification Templates'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar__menu-header"><?php echo app('translator')->get('Frontend Manager'); ?></li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.frontend.templates')); ?>">
                    <a href="<?php echo e(route('admin.frontend.templates')); ?>" class="nav-link ">
                        <i class="menu-icon la la-html5"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Manage Templates'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.frontend.manage.*')); ?>">
                    <a href="<?php echo e(route('admin.frontend.manage.pages')); ?>" class="nav-link ">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Manage Pages'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.frontend.sections*',3)); ?>">
                        <i class="menu-icon la la-puzzle-piece"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Manage Section'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.frontend.sections*',2)); ?> ">
                        <ul>
                            <?php
                               $lastSegment =  collect(request()->segments())->last();
                            ?>
                            <?php $__currentLoopData = getPageSections(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $secs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($secs['builder']): ?>
                                    <li class="sidebar-menu-item  <?php if($lastSegment == $k): ?> active <?php endif; ?> ">
                                        <a href="<?php echo e(route('admin.frontend.sections',$k)); ?>" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title"><?php echo e(__($secs['name'])); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </li>

                <li class="sidebar__menu-header"><?php echo app('translator')->get('Extra'); ?></li>


                <li class="sidebar-menu-item <?php echo e(menuActive('admin.maintenance.mode')); ?>">
                    <a href="<?php echo e(route('admin.maintenance.mode')); ?>" class="nav-link">
                        <i class="menu-icon las la-robot"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Maintenance Mode'); ?></span>
                    </a>
                </li>



                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="<?php echo e(menuActive('admin.system*',3)); ?>">
                        <i class="menu-icon la la-server"></i>
                        <span class="menu-title"><?php echo app('translator')->get('System'); ?></span>
                    </a>
                    <div class="sidebar-submenu <?php echo e(menuActive('admin.system*',2)); ?> ">
                        <ul>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.info')); ?> ">
                                <a href="<?php echo e(route('admin.system.info')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Application'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.server.info')); ?> ">
                                <a href="<?php echo e(route('admin.system.server.info')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Server'); ?></span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo e(menuActive('admin.system.optimize')); ?> ">
                                <a href="<?php echo e(route('admin.system.optimize')); ?>" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title"><?php echo app('translator')->get('Cache'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item <?php echo e(menuActive('admin.setting.custom.css')); ?>">
                    <a href="<?php echo e(route('admin.setting.custom.css')); ?>" class="nav-link">
                        <i class="menu-icon lab la-css3-alt"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Custom CSS'); ?></span>
                    </a>
                </li>

                <li class="sidebar-menu-item  <?php echo e(menuActive('admin.request.report')); ?>">
                    <a href="<?php echo e(route('admin.request.report')); ?>" class="nav-link"
                       data-default-url="<?php echo e(route('admin.request.report')); ?>">
                        <i class="menu-icon las la-bug"></i>
                        <span class="menu-title"><?php echo app('translator')->get('Report & Request'); ?> </span>
                    </a>
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
        if($('li').hasClass('active')){
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            },500);
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\wamp64\www\kerfapthostgit\core\resources\views/admin/partials/sidenav.blade.php ENDPATH**/ ?>