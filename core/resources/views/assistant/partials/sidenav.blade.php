<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('assistant.dashboard')}}" class="sidebar__main-logo"><img src="{{getImage(getFilePath('logoIcon') .'/logo_dark.png')}}" alt="@lang('image')"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('assistant.dashboard')}}">
                    <a href="{{route('assistant.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('assistant.doctor.appointment.create.form')}}">
                    <a href="{{route('assistant.doctor.appointment.create.form')}}" class="nav-link ">
                        <i class="menu-icon las la-handshake"></i>
                        <span class="menu-title">@lang('Make Appointment')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('assistant.doctors')}}">
                    <a href="{{route('assistant.doctors')}}" class="nav-link ">
                        <i class="menu-icon las la-calendar-check"></i>
                        <span class="menu-title">@lang('Doctors')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('assistant.profile')}}">
                    <a href="{{route('assistant.profile')}}" class="nav-link ">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Profile')</span>
                    </a>
                </li>
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">{{__(systemDetails()['name'])}}</span>
                <span class="text--success">@lang('V'){{systemDetails()['version']}} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
        if($('li').hasClass('active')){
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            },500);
        }
    </script>
@endpush
