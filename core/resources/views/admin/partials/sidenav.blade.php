<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img src="{{getImage(getFilePath('logoIcon') .'/logo_dark.png')}}" alt="@lang('image')"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('admin.dashboard')}}">
                    <a href="{{route('admin.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.department.index')}}">
                    <a href="{{route('admin.department.index')}}" class="nav-link ">
                        <i class="menu-icon las la-layer-group"></i>
                        <span class="menu-title">@lang('Departments')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{menuActive('admin.department.location')}}">
                    <a href="{{route('admin.department.location')}}" class="nav-link ">
                        <i class="menu-icon las la-street-view"></i>
                        <span class="menu-title">@lang('Locations')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.appointment*',3)}}">
                        <i class="menu-icon las la-handshake"></i>
                        <span class="menu-title">@lang('Appointments')</span>
                        @if(0 < $newAppointmentsCount)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.appointment*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.appointment.form')}} ">
                                <a href="{{route('admin.appointment.form')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Make Appoinment')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.appointment.new')}} ">
                                <a href="{{route('admin.appointment.new')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('New Appointments')</span>
                                    @if($newAppointmentsCount)
                                        <span class="menu-badge pill bg--danger ms-auto">{{$newAppointmentsCount}}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.appointment.done')}} ">
                                <a href="{{route('admin.appointment.done')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Done Appointments')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.appointment.trashed')}} ">
                                <a href="{{route('admin.appointment.trashed')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Trashed Appointments')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.deposit*',3)}}">
                        <i class="menu-icon las la-file-invoice-dollar"></i>
                        <span class="menu-title">@lang('Payments')</span>
                        @if(0 < $pendingDepositsCount)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.deposit*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.deposit.pending')}} ">
                                <a href="{{route('admin.deposit.pending')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending')</span>
                                    @if($pendingDepositsCount)
                                        <span class="menu-badge pill bg--danger ms-auto">{{$pendingDepositsCount}}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.approved')}} ">
                                <a href="{{route('admin.deposit.approved')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.successful')}} ">
                                <a href="{{route('admin.deposit.successful')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Successful')</span>
                                </a>
                            </li>


                            <li class="sidebar-menu-item {{menuActive('admin.deposit.rejected')}} ">
                                <a href="{{route('admin.deposit.rejected')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Rejected')</span>
                                </a>
                            </li>


                            <li class="sidebar-menu-item {{menuActive('admin.deposit.initiated')}} ">
                                <a href="{{route('admin.deposit.initiated')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Initiated')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.list')}} ">
                                <a href="{{route('admin.deposit.list')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.doctor*',3)}}">
                        <i class="menu-icon las la-stethoscope"></i>
                        <span class="menu-title">@lang('Manage Doctors')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.doctor*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.doctor.form')}} ">
                                <a href="{{route('admin.doctor.form')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Add New')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.doctor.index')}} ">
                                <a href="{{route('admin.doctor.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Doctors')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.doctor.active', Status::ACTIVE)}}">
                                <a href="{{route('admin.doctor.active',Status::ACTIVE)}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Active Doctors')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.doctor.inactive',Status::INACTIVE)}}">
                                <a href="{{route('admin.doctor.inactive', Status::INACTIVE)}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Inactive Doctors')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.doctor.notification.all')}}">
                                <a href="{{route('admin.doctor.notification.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Notification to All')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.doctor.login.history') }}">
                                <a href="{{ route('admin.doctor.login.history') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Login History')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.assistant*',3)}}">
                        <i class="menu-icon las la-user-friends"></i>
                        <span class="menu-title">@lang('Manage Assistants')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.assistant*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.assistant.form')}} ">
                                <a href="{{route('admin.assistant.form')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Add New')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.assistant.index')}} ">
                                <a href="{{route('admin.assistant.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Assistants')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.assistant.active', Status::ACTIVE)}}">
                                <a href="{{route('admin.assistant.active', Status::ACTIVE)}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Active Assistants')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.assistant.inactive', Status::INACTIVE)}}">
                                <a href="{{route('admin.assistant.inactive', Status::INACTIVE)}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Inactive Assistants')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.assistant.notification.all')}}">
                                <a href="{{route('admin.assistant.notification.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Notification to All')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.assistant.login.history') }}">
                                <a href="{{ route('admin.assistant.login.history') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Login History')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.staff*',3)}}">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Manage Staff')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.staff*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.staff.form')}} ">
                                <a href="{{route('admin.staff.form')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Add New')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.staff.index')}} ">
                                <a href="{{route('admin.staff.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Staff')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.staff.active', Status::ACTIVE)}}">
                                <a href="{{route('admin.staff.active', Status::ACTIVE)}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Active Staff')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.staff.inactive', Status::INACTIVE)}}">
                                <a href="{{route('admin.staff.inactive', Status::INACTIVE)}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Inactive Staff')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.staff.notification.all')}}">
                                <a href="{{route('admin.staff.notification.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Notification to All')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.staff.login.history') }}">
                                <a href="{{ route('admin.staff.login.history') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Login History')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.gateway*',3)}}">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Payment Gateways')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.gateway*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('admin.gateway.automatic.*')}} ">
                                <a href="{{route('admin.gateway.automatic.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Automatic Gateways')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.gateway.manual.*')}} ">
                                <a href="{{route('admin.gateway.manual.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Manual Gateways')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>




                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.ticket*',3)}}">
                        <i class="menu-icon la la-ticket"></i>
                        <span class="menu-title">@lang('Support Ticket') </span>
                        @if(0 < $pendingTicketCount)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.ticket*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.ticket.pending')}} ">
                                <a href="{{route('admin.ticket.pending')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending Ticket')</span>
                                    @if($pendingTicketCount)
                                    <span
                                    class="menu-badge pill bg--danger ms-auto">{{$pendingTicketCount}}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.ticket.closed')}} ">
                                <a href="{{route('admin.ticket.closed')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Closed Ticket')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.ticket.answered')}} ">
                                <a href="{{route('admin.ticket.answered')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Answered Ticket')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.ticket.index')}} ">
                                <a href="{{route('admin.ticket.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Ticket')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.report*',3)}}">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Report') </span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.report*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive(['admin.report.transaction','admin.report.transaction.search'])}}">
                                <a href="{{route('admin.report.transaction')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Transaction Log')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.report.notification.history')}}">
                                <a href="{{route('admin.report.notification.history')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Notification History')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item  {{menuActive('admin.subscriber.*')}}">
                    <a href="{{route('admin.subscriber.index')}}" class="nav-link"
                       data-default-url="{{ route('admin.subscriber.index') }}">
                        <i class="menu-icon las la-thumbs-up"></i>
                        <span class="menu-title">@lang('Subscribers') </span>
                    </a>
                </li>


                <li class="sidebar__menu-header">@lang('Settings')</li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.index')}}">
                    <a href="{{route('admin.setting.index')}}" class="nav-link">
                        <i class="menu-icon las la-life-ring"></i>
                        <span class="menu-title">@lang('General Setting')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.system.configuration')}}">
                    <a href="{{route('admin.setting.system.configuration')}}" class="nav-link">
                        <i class="menu-icon las la-cog"></i>
                        <span class="menu-title">@lang('System Configuration')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.logo.icon')}}">
                    <a href="{{route('admin.setting.logo.icon')}}" class="nav-link">
                        <i class="menu-icon las la-images"></i>
                        <span class="menu-title">@lang('Logo & Favicon')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.extensions.index')}}">
                    <a href="{{route('admin.extensions.index')}}" class="nav-link">
                        <i class="menu-icon las la-cogs"></i>
                        <span class="menu-title">@lang('Extensions')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item  {{menuActive(['admin.language.manage','admin.language.key'])}}">
                    <a href="{{route('admin.language.manage')}}" class="nav-link"
                       data-default-url="{{ route('admin.language.manage') }}">
                        <i class="menu-icon las la-language"></i>
                        <span class="menu-title">@lang('Language') </span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.seo')}}">
                    <a href="{{route('admin.seo')}}" class="nav-link">
                        <i class="menu-icon las la-globe"></i>
                        <span class="menu-title">@lang('SEO Manager')</span>
                    </a>
                </li>




                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.setting.notification*',3)}}">
                        <i class="menu-icon las la-bell"></i>
                        <span class="menu-title">@lang('Notification Setting')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.setting.notification*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.setting.notification.global')}} ">
                                <a href="{{route('admin.setting.notification.global')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Global Template')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.setting.notification.email')}} ">
                                <a href="{{route('admin.setting.notification.email')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Email Setting')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.setting.notification.sms')}} ">
                                <a href="{{route('admin.setting.notification.sms')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('SMS Setting')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.setting.notification.templates')}} ">
                                <a href="{{route('admin.setting.notification.templates')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Notification Templates')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar__menu-header">@lang('Frontend Manager')</li>

                <li class="sidebar-menu-item {{menuActive('admin.frontend.templates')}}">
                    <a href="{{route('admin.frontend.templates')}}" class="nav-link ">
                        <i class="menu-icon la la-html5"></i>
                        <span class="menu-title">@lang('Manage Templates')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.frontend.manage.*')}}">
                    <a href="{{route('admin.frontend.manage.pages')}}" class="nav-link ">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Manage Pages')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.frontend.sections*',3)}}">
                        <i class="menu-icon la la-puzzle-piece"></i>
                        <span class="menu-title">@lang('Manage Section')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.frontend.sections*',2)}} ">
                        <ul>
                            @php
                               $lastSegment =  collect(request()->segments())->last();
                            @endphp
                            @foreach(getPageSections(true) as $k => $secs)
                                @if($secs['builder'])
                                    <li class="sidebar-menu-item  @if($lastSegment == $k) active @endif ">
                                        <a href="{{ route('admin.frontend.sections',$k) }}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">{{__($secs['name'])}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="sidebar__menu-header">@lang('Extra')</li>


                <li class="sidebar-menu-item {{menuActive('admin.maintenance.mode')}}">
                    <a href="{{route('admin.maintenance.mode')}}" class="nav-link">
                        <i class="menu-icon las la-robot"></i>
                        <span class="menu-title">@lang('Maintenance Mode')</span>
                    </a>
                </li>



                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.system*',3)}}">
                        <i class="menu-icon la la-server"></i>
                        <span class="menu-title">@lang('System')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.system*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.system.info')}} ">
                                <a href="{{route('admin.system.info')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Application')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.system.server.info')}} ">
                                <a href="{{route('admin.system.server.info')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Server')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.system.optimize')}} ">
                                <a href="{{route('admin.system.optimize')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Cache')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.custom.css')}}">
                    <a href="{{route('admin.setting.custom.css')}}" class="nav-link">
                        <i class="menu-icon lab la-css3-alt"></i>
                        <span class="menu-title">@lang('Custom CSS')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item  {{menuActive('admin.request.report')}}">
                    <a href="{{route('admin.request.report')}}" class="nav-link"
                       data-default-url="{{ route('admin.request.report') }}">
                        <i class="menu-icon las la-bug"></i>
                        <span class="menu-title">@lang('Report & Request') </span>
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
