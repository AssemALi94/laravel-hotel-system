<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="brand-image"
             style="opacity: .8">
        <span class="mt-2">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                <img src="{{ Auth::user()->avatar ? "/storage/avatar/".Auth::user()->avatar:asset('img/user2-160x160.jpg') }}"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.edit',['user'=>Auth::user()->id]) }}" class="d-">{{ Auth::user()->name }}</a>
                <a class="d-inline" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt ml-2" data-toggle="tooltip" data-placement="bottom"
                       title="Logout"></i>
                </a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/user" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item
                    {{  request()->routeIs('showAllDeletedUsers')  |
                        request()->routeIs('user.index')  |
                        request()->routeIs('user.admin') |
                        request()->routeIs('user.manager') |
                        request()->routeIs('user.receptionist') |
                        request()->routeIs('user.client')
                        ? 'menu-open' : '' }}
                    ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(in_array(Auth::user()->role,['admin','manager']))
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link
                                    {{ request()->routeIs('user.index') ? 'active' : '' }}
                                ">
                                <i class="fas fa-stream nav-icon"></i>
                                <p>Show all</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.manager') }}" class="nav-link
                                    {{ request()->routeIs('user.manager') ? 'active' : '' }}
                                ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.receptionist') }}" class="nav-link
                                    {{ request()->routeIs('user.receptionist') ? 'active' : '' }}
                                ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Receptionist</p>
                            </a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ route('showAllDeletedUsers') }}" class="nav-link
                                    {{ request()->routeIs('showAllDeletedUsers') ? 'active' : '' }}
                                    ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Trash</p>
                                </a>
                            </li>
                        @endif

                        @if(in_array(Auth::user()->role,['admin','manager','receptionist']))
                        <li class="nav-item">
                            <a href="{{ route('user.client') }}" class="nav-link
                                {{ request()->routeIs('user.client') ? 'active' : '' }}
                                ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clients</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>

                @if(in_array(Auth::user()->role,['admin','manager']))
                    <li class="nav-item">
                        <a href="{{ route('floors.index') }}" class="nav-link
                                {{ request()->routeIs('floors.index') ? 'active' : '' }}
                            ">
                            <i class="fas fa-bars nav-icon"></i>
                            <p>Floors</p>
                        </a>
                    </li>
                @endif

                @if(in_array(Auth::user()->role,['admin','manager']))
                    <li class="nav-item">
                        <a href="{{ route('rooms.index') }}" class="nav-link
                                {{ request()->routeIs('rooms.index') ? 'active' : '' }}
                            ">
                            <i class="fab fa-buromobelexperte nav-icon"></i>
                            <p>Rooms</p>
                        </a>
                    </li>
                @endif


                @if(in_array(Auth::user()->role,['admin','manager','receptionist']))
                <li class="nav-item">
                    <a href="{{ route('reservation.index') }}" class="nav-link
                            {{ request()->routeIs('reservation.index') ? 'active' : '' }}
                        ">
                        <i class="fas fa-suitcase-rolling nav-icon"></i>
                        <p>Reservations</p>
                    </a>
                </li>
                @endif

                @if(in_array(Auth::user()->role,['admin']))
                <li class="nav-item">
                    <a href="{{ route('service.index') }}" class="nav-link
                                {{ request()->routeIs('service.index') ? 'active' : '' }}
                        ">
                        <i class="fas fa-drumstick-bite nav-icon"></i>
                        <p>Services</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
