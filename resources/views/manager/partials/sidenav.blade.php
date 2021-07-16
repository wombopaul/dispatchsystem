<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
     data-background="{{getImage('assets/manager/images/sidebar/2.jpg','400x800')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('manager.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('manager.dashboard')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('manager.dashboard')}}">
                    <a href="{{route('manager.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('manager.branch*')}}">
                    <a href="{{route('manager.branch.index')}}" class="nav-link"
                       data-default-url="{{ route('manager.branch.index') }}">
                        <i class="menu-icon las la-code-branch"></i>
                        <span class="menu-title">@lang('Branch List')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('manager.staff*',3)}}">
                        <i class="menu-icon las la-user-friends"></i>
                        <span class="menu-title">@lang('Manage Staff')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('manager.staff*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('manager.staff.create')}} ">
                                <a href="{{route('manager.staff.create')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Add New')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('manager.staff.index')}} ">
                                <a href="{{route('manager.staff.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Staff')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('manager.courier*',3)}}">
                       <i class="menu-icon las la-mail-bulk"></i>
                        <span class="menu-title">@lang('Manage Courier')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('manager.courier*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('manager.courier.index')}} ">
                                <a href="{{route('manager.courier.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('manager.courier.dispatch')}} ">
                                <a href="{{route('manager.courier.dispatch')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Dispatch')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('manager.courier.upcoming')}} ">
                                <a href="{{route('manager.courier.upcoming')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Upcoming')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item {{menuActive('manager.income.courier')}}">
                    <a href="{{route('manager.income.courier')}}" class="nav-link"
                       data-default-url="{{ route('manager.income.courier') }}">
                        <i class="menu-icon las la-wallet"></i>
                        <span class="menu-title">@lang('Branch Income')</span>
                    </a>
                </li>



                <li class="sidebar-menu-item {{menuActive('ticket*')}}">
                    <a href="{{route('ticket')}}" class="nav-link"
                       data-default-url="{{ route('ticket') }}">
                        <i class="menu-icon las la-ticket-alt"></i>
                        <span class="menu-title">@lang('Support Ticket')</span>
                    </a>
                </li>


                <li class="sidebar-menu-item {{menuActive('manager.twofactor')}}">
                    <a href="{{route('manager.twofactor')}}" class="nav-link"
                       data-default-url="{{ route('manager.twofactor') }}">
                        <i class="menu-icon las la-lock"></i>
                        <span class="menu-title">@lang('2FA')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

