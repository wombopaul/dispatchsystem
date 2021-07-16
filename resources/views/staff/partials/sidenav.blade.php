<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
     data-background="{{getImage('assets/staff/images/sidebar/2.jpg','400x800')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('staff.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('staff.dashboard')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('staff.dashboard')}}">
                    <a href="{{route('staff.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>
                
                <li class="sidebar-menu-item {{menuActive('staff.courier.create')}}">
                    <a href="{{route('staff.courier.create')}}" class="nav-link"
                       data-default-url="{{ route('staff.courier.create') }}">
                        <i class="menu-icon las la-paper-plane"></i>
                        <span class="menu-title">@lang('Courier Send')</span>
                    </a>
                </li>


                 <li class="sidebar-menu-item {{menuActive('staff.courier*')}}">
                    <a href="{{route('staff.courier.list')}}" class="nav-link"
                       data-default-url="{{ route('staff.courier.list') }}">
                        <i class="menu-icon las la-share"></i>
                        <span class="menu-title">@lang('Manage Courier')</span>
                    </a>
                </li>


                <li class="sidebar-menu-item {{menuActive('staff.delivery.list')}}">
                    <a href="{{route('staff.delivery.list')}}" class="nav-link"
                       data-default-url="{{ route('staff.delivery.list') }}">
                        <i class="menu-icon las la-truck-loading"></i>
                        <span class="menu-title">@lang('Upcoming Courier')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('staff.branch*')}}">
                    <a href="{{route('staff.branch.index')}}" class="nav-link"
                       data-default-url="{{ route('staff.branch.index') }}">
                        <i class="menu-icon las la-code-branch"></i>
                        <span class="menu-title">@lang('Branch List')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('staff.cash.income')}}">
                    <a href="{{route('staff.cash.income')}}" class="nav-link"
                       data-default-url="{{ route('staff.cash.income') }}">
                        <i class="menu-icon las la-wallet"></i>
                        <span class="menu-title">@lang('Cash Collection')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('ticket*')}}">
                    <a href="{{route('ticket')}}" class="nav-link"
                       data-default-url="{{ route('ticket') }}">
                        <i class="menu-icon las la-ticket-alt"></i>
                        <span class="menu-title">@lang('Support Ticket')</span>
                    </a>
                </li>


                <li class="sidebar-menu-item {{menuActive('staff.twofactor')}}">
                    <a href="{{route('staff.twofactor')}}" class="nav-link"
                       data-default-url="{{ route('staff.twofactor') }}">
                        <i class="menu-icon las la-lock"></i>
                        <span class="menu-title">@lang('2FA')</span>
                    </a>
                </li>
               
            </ul>
        </div>
    </div>
</div>
