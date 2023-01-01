<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
                <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>

                <div class="nav-lavel">{{ __('Layouts')}} </div>
                <div class="nav-item {{ ($segment1 == 'banners') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Banner Management')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_banners')
                        <a href="{{url('banners')}}" class="menu-item {{ ($segment1 == 'banners') ? 'active' : '' }}">{{ __('Banners')}}</a>
                        <a href="{{url('banners/create')}}" class="menu-item {{ ($segment1 == 'banners' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Banners')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="nav-lavel">{{ __('Users Management')}} </div>
                <div class="nav-item {{ ($segment1 == 'banners') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-doctor"></i><span>{{ __('Doctor Management')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_banners')
                        <a href="{{url('doctor')}}" class="menu-item {{ ($segment1 == 'doctor') ? 'active' : '' }}">{{ __('Doctor')}}</a>
                        <a href="{{url('doctor/create')}}" class="menu-item {{ ($segment1 == 'doctor' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Doctor')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'banners') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Agent Management')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_banners')
                        <a href="{{url('agent')}}" class="menu-item {{ ($segment1 == 'agent') ? 'active' : '' }}">{{ __('Agent')}}</a>
                        <a href="{{url('agent/create')}}" class="menu-item {{ ($segment1 == 'agent' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Agent')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'banners') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Patient Management')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_banners')
                        <a href="{{url('patient')}}" class="menu-item {{ ($segment1 == 'patient') ? 'active' : '' }}">{{ __('Patient')}}</a>
                        <a href="{{url('patient/create')}}" class="menu-item {{ ($segment1 == 'patient' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Patient')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="nav-lavel">{{ __('Administative Management')}} </div>
                <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permission' ||$segment1 == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_user')
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add User')}}</a>
                        @endcan
                        <!-- only those have manage_role permission will get access -->
                        @can('manage_roles')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('manage_permission')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        @endcan
                    </div>
                </div>

        </div>
    </div>
</div>