<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('doctor.dashboard') }}" class="sidebar__main-logo"><img
                    src="{{ getImage(getFilePath('logoIcon') . '/logo_dark.png') }}" alt="@lang('image')"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{ menuActive('doctor.dashboard') }}">
                    <a href="{{ route('doctor.dashboard') }}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('doctor.appointment*', 3) }}">
                        <i class="menu-icon las la-handshake"></i>
                        <span class="menu-title">@lang('Appointments')</span>
                        @if (@$newAppointmentsCount)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('doctor.appointment*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('doctor.appointment.booking') }} ">
                                <a href="{{ route('doctor.appointment.booking') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Make Appoinment')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('doctor.appointment.new') }} ">
                                <a href="{{ route('doctor.appointment.new') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('New Appointments')</span>
                                    @if (@$newAppointmentsCount)
                                        <span
                                            class="menu-badge pill bg--danger ms-auto">{{ $newAppointmentsCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('doctor.appointment.done') }} ">
                                <a href="{{ route('doctor.appointment.done') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Done Appointments')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('doctor.appointment.trashed') }} ">
                                <a href="{{ route('doctor.appointment.trashed') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Trashed Appointments')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item {{ menuActive('doctor.leave.index') }}">
                    <a href="{{ route('doctor.leave.index') }}" class="nav-link ">
                        <i class="menu-icon las la-user-plus "></i>
                        <span class="menu-title">@lang('Manage Leaves')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('doctor.schedule.index') }}">
                    <a href="{{ route('doctor.schedule.index') }}" class="nav-link ">
                        <i class="menu-icon las la-calendar-check"></i>
                        <span class="menu-title">@lang('Schedules')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('doctor.info*', 3) }}">
                        <i class="menu-icon las la-info-circle"></i>
                        <span class="menu-title">@lang('My Info')</span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('doctor.info*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('doctor.info.profile') }} ">
                                <a href="{{ route('doctor.info.profile') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Profile')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('doctor.info.about') }} ">
                                <a href="{{ route('doctor.info.about') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('About')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('doctor.info.speciality') }} ">
                                <a href="{{ route('doctor.info.speciality') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Speciality')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('doctor.info.educations') }} ">
                                <a href="{{ route('doctor.info.educations') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Education')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('doctor.info.experiences') }} ">
                                <a href="{{ route('doctor.info.experiences') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Experiences')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('doctor.info.social.icon') }} ">
                                <a href="{{ route('doctor.info.social.icon') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Social Icons')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">{{ __(systemDetails()['name']) }}</span>
                <span class="text--success">@lang('V'){{ systemDetails()['version'] }} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
@endpush
