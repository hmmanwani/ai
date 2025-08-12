<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="{{ url('/') }}"><img
                            src="{{ url('assets/images/logo/HMMBiz-logo.svg') }}" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img
                            src="{{ url('assets/images/logo/HMMBiz-logo.svg') }}" alt="logo" /></a>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            id="profileDropdown">
                            <span class="nav-profile-name">
                                {{ ucfirst(session()->get('emp_login')['fname']) }}
                                {{ ucfirst(session()->get('emp_login')['lname']) }}
                            </span>
                            <span class="online-status"></span>
                            <img src="{{ url('assets/images/logo/logo.png') }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ URL('profile') }}">
                                <i class="mdi mdi-account text-primary f-base"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ URL('change-password') }}">
                                <i class="fa fa-key text-primary f-base"></i>
                                Change Password
                            </a>
                            <a class="dropdown-item" href="{{ URL('logout') }}">
                                <i class="mdi mdi-logout text-primary f-base"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </div>
    </nav>
    <div class="header-h">

    </div>
    <nav class="bottom-navbar shadow">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('dashboard') }}" class="nav-link ">
                        <i class="fa fa-home menu-icon f-22 "></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                {{-- attendance --}}
                <li
                    class="nav-item {{ Request::is('view-attendance') ? 'active' : '' }}  {{ Request::is('manage-leave') ? 'active' : '' }} {{ Request::is('manage-wfh') ? 'active' : '' }} {{ Request::is('manage-extra-time') ? 'active' : '' }} {{ Request::is('add-leave') ? 'active' : '' }} {{ Request::is('work-form-home') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="nav-link pointer">
                        <i class="fa fa-calendar menu-icon f-22"></i>
                        <span class="menu-title">Attendance</span>
                    </a>
                    <div class="submenu">
                        <ul>
                            <li class="nav-item"><a class="nav-link pointer" href="{{ URL('view-attendance') }}">View
                                    Attendance</a>
                            </li>
                            <li class="nav-item"><a class="nav-link pointer" href="{{ URL('manage-leave') }}">Manage
                                    Leave</a></li>
                            <li class="nav-item"><a class="nav-link pointer" href="{{ URL('manage-wfh') }}">Manage
                                    WFH</a>
                            </li>
                            <li class="nav-item"><a class="nav-link pointer"
                                    href="{{ URL('manage-extra-time') }}">Manage Overtime</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Projects  --}}
                <li
                    class="nav-item {{ Request::is('project*') ? 'active' : '' }} {{ Request::is('manage-task') ? 'active' : '' }} {{ Request::is('add-project') ? 'active' : '' }} {{ Request::is('project-details') ? 'active' : '' }}{{ Request::is('edit-project-details*') ? 'active' : '' }}{{ Request::is('add-task') ? 'active' : '' }} {{ Request::is('task-details*') ? 'active' : '' }} {{ Request::is('edit-task*') ? 'active' : '' }}{{ Request::is('daily-work-report*') ? 'active' : '' }}{{ Request::is('work-email-setting') ? 'active' : '' }}{{ Request::is('add-work-report') ? 'active' : '' }} ">
                    <a class="nav-link pointer" href="javascript:void(0)">
                        <i class="fa fa-pencil-square-o menu-icon f-22"></i>
                        <span class="menu-title">Projects</span>
                    </a>
                    <div class="submenu">
                        <ul>
                            <li class="nav-item"><a class="nav-link pointer" href="{{ URL('project') }}">Assign
                                    Project </a>
                            </li>

                            <li class="nav-item"><a class="nav-link pointer" href="{{ URL('manage-task') }}">Manage
                                    Task</a></li>
                            <li class="nav-item"><a class="nav-link pointer" href="{{ URL('daily-work-report') }}">Daily Work Report</a></li>

                            <li class="nav-item d-none"><a class="nav-link pointer"
                                href="{{ URL('manage-notification') }}">Manage
                                Notification</a></li>
                        </ul>
                    </div>
                </li>

                {{-- documentation --}}

                <li
                    class="nav-item {{ Request::is('hr-policy') ? 'active' : '' }} {{ Request::is('salary-slip-request') ? 'active' : '' }} {{ Request::is('submit-salary-slip-request') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="fa fa-file-text menu-icon f-22"></i>
                        <span class="menu-title">Documentation</span></a>
                    <div class="submenu">
                        <ul>
                            <li class="nav-item"><a class="nav-link pointer" href="{{ URL('hr-policy') }}">HR Policy
                                </a>
                            </li>
                            <li class="nav-item d-none"><a class="nav-link pointer "
                                    href="{{ URL('salary-slip-request') }}">Salary
                                    Slip
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- resignation  --}}
                <?php
                 if (session()->get('emp_login')['role'] != 1 ) {  ?>
                <li
                    class="nav-item {{ Request::is('resignation') ? 'active' : '' }} {{ Request::is('admin-resignation-details') ? 'active' : '' }}">
                    <a href="{{ URL('resignation') }}" class="nav-link">
                        <i class="fa fa-file menu-icon f-22"></i> <i class=""></i>
                        <span class="menu-title">Resignation</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
                <?php  }
             ?>
                {{-- admin --}}
                <?php
                if (session()->get('emp_login')['role'] == 1 || session()->get('emp_login')['role'] == 2) {  ?>
                <li
                    class="nav-item {{ Request::is('overview') ? 'active' : '' }} {{ Request::is('employee*') ? 'active' : '' }} {{ Request::is('addemployee') ? 'active' : '' }} {{ Request::is('employee-detail*') ? 'active' : '' }} {{ Request::is('edit-employee*') ? 'active' : '' }} {{ Request::is('edit-attendance*') ? 'active' : '' }} {{ Request::is('admin-view-attendance*') ? 'active' : '' }} {{ Request::is('pending-leave') ? 'active' : '' }} {{ Request::is('leave-details*') ? 'active' : '' }} {{ Request::is('approved-leave') ? 'active' : '' }} {{ Request::is('leave-type') ? 'active' : '' }} {{ Request::is('edit-leave-type*') ? 'active' : '' }} {{ Request::is('pending-wfh') ? 'active' : '' }} {{ Request::is('approved-wfh') ? 'active' : '' }} {{ Request::is('wfh-details*') ? 'active' : '' }} {{ Request::is('approve-extra-time') ? 'active' : '' }} {{ Request::is('admin-hr-policy') ? 'active' : '' }} {{ Request::is('admin-salary-slip') ? 'active' : '' }} {{ Request::is('admin-add-salary-slip') ? 'active' : '' }} {{ Request::is('edit-salary-slip-detials*') ? 'active' : '' }} {{ Request::is('holiday') ? 'active' : '' }} {{ Request::is('team') ? 'active' : '' }} {{ Request::is('view-team-member*') ? 'active' : '' }} {{ Request::is('admin-resignation') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('overview') }}">
                        <i class="fa fa-lock menu-icon f-22"></i>
                        <span class="menu-title">Admin</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>
