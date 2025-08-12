<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="<?php echo e(URL('/')); ?>"><img
                            src="<?php echo e(URL('assets/images/logo/HMMBiz-logo.svg')); ?>" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="<?php echo e(URL('/')); ?>"><img
                            src="<?php echo e(URL('assets/images/logo/HMMBiz-logo.svg')); ?>" alt="logo" /></a>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            id="profileDropdown">
                            <span class="nav-profile-name">
                                <?php echo e(ucfirst(session()->get('emp_login')['fname'])); ?>

                                <?php echo e(ucfirst(session()->get('emp_login')['lname'])); ?>

                            </span>
                            <span class="online-status"></span>
                            <img src="<?php echo e(URL('assets/images/logo/logo.png')); ?>" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="<?php echo e(URL('profile')); ?>">
                                <i class="mdi mdi-account text-primary f-base"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="<?php echo e(URL('change-password')); ?>">
                                <i class="fa fa-key text-primary f-base"></i>
                                Change Password
                            </a>
                            <a class="dropdown-item" href="<?php echo e(URL('logout')); ?>">
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
                <li class="nav-item <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('dashboard')); ?>" class="nav-link ">
                        <i class="fa fa-home menu-icon f-22 "></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                
                <li
                    class="nav-item <?php echo e(Request::is('view-attendance') ? 'active' : ''); ?>  <?php echo e(Request::is('manage-leave') ? 'active' : ''); ?> <?php echo e(Request::is('manage-wfh') ? 'active' : ''); ?> <?php echo e(Request::is('manage-extra-time') ? 'active' : ''); ?> <?php echo e(Request::is('add-leave') ? 'active' : ''); ?> <?php echo e(Request::is('work-form-home') ? 'active' : ''); ?>">
                    <a href="javascript:void(0)" class="nav-link pointer">
                        <i class="fa fa-calendar menu-icon f-22"></i>
                        <span class="menu-title">Attendance</span>
                    </a>
                    <div class="submenu">
                        <ul>
                            <li class="nav-item"><a class="nav-link pointer" href="<?php echo e(URL('view-attendance')); ?>">View
                                    Attendance</a>
                            </li>
                            <li class="nav-item"><a class="nav-link pointer" href="<?php echo e(URL('manage-leave')); ?>">Manage
                                    Leave</a></li>
                            <li class="nav-item"><a class="nav-link pointer" href="<?php echo e(URL('manage-wfh')); ?>">Manage
                                    WFH</a>
                            </li>
                            <li class="nav-item"><a class="nav-link pointer"
                                    href="<?php echo e(URL('manage-extra-time')); ?>">Manage Overtime</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li
                    class="nav-item <?php echo e(Request::is('project*') ? 'active' : ''); ?> <?php echo e(Request::is('manage-task') ? 'active' : ''); ?> <?php echo e(Request::is('add-project') ? 'active' : ''); ?> <?php echo e(Request::is('project-details') ? 'active' : ''); ?><?php echo e(Request::is('edit-project-details*') ? 'active' : ''); ?><?php echo e(Request::is('add-task') ? 'active' : ''); ?> <?php echo e(Request::is('task-details*') ? 'active' : ''); ?> <?php echo e(Request::is('edit-task*') ? 'active' : ''); ?><?php echo e(Request::is('daily-work-report*') ? 'active' : ''); ?><?php echo e(Request::is('work-email-setting') ? 'active' : ''); ?><?php echo e(Request::is('add-work-report') ? 'active' : ''); ?> ">
                    <a class="nav-link pointer" href="javascript:void(0)">
                        <i class="fa fa-pencil-square-o menu-icon f-22"></i>
                        <span class="menu-title">Projects</span>
                    </a>
                    <div class="submenu">
                        <ul>
                            <li class="nav-item"><a class="nav-link pointer" href="<?php echo e(URL('project')); ?>">Assign
                                    Project </a>
                            </li>

                            <li class="nav-item"><a class="nav-link pointer" href="<?php echo e(URL('manage-task')); ?>">Manage
                                    Task</a></li>
                            <li class="nav-item"><a class="nav-link pointer" href="<?php echo e(URL('daily-work-report')); ?>">Daily Work Report</a></li>

                            <li class="nav-item d-none"><a class="nav-link pointer"
                                href="<?php echo e(URL('manage-notification')); ?>">Manage
                                Notification</a></li>
                        </ul>
                    </div>
                </li>

                

                <li
                    class="nav-item <?php echo e(Request::is('hr-policy') ? 'active' : ''); ?> <?php echo e(Request::is('salary-slip-request') ? 'active' : ''); ?> <?php echo e(Request::is('submit-salary-slip-request') ? 'active' : ''); ?>">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="fa fa-file-text menu-icon f-22"></i>
                        <span class="menu-title">Documentation</span></a>
                    <div class="submenu">
                        <ul>
                            <li class="nav-item"><a class="nav-link pointer" href="<?php echo e(URL('hr-policy')); ?>">HR Policy
                                </a>
                            </li>
                            <li class="nav-item d-none"><a class="nav-link pointer "
                                    href="<?php echo e(URL('salary-slip-request')); ?>">Salary
                                    Slip
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <?php
                 if (session()->get('emp_login')['role'] != 1 ) {  ?>
                <li
                    class="nav-item <?php echo e(Request::is('resignation') ? 'active' : ''); ?> <?php echo e(Request::is('admin-resignation-details') ? 'active' : ''); ?>">
                    <a href="<?php echo e(URL('resignation')); ?>" class="nav-link">
                        <i class="fa fa-file menu-icon f-22"></i> <i class=""></i>
                        <span class="menu-title">Resignation</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
                <?php  }
             ?>
                
                <?php
                if (session()->get('emp_login')['role'] == 1 || session()->get('emp_login')['role'] == 2) {  ?>
                <li
                    class="nav-item <?php echo e(Request::is('overview') ? 'active' : ''); ?> <?php echo e(Request::is('employee*') ? 'active' : ''); ?> <?php echo e(Request::is('addemployee') ? 'active' : ''); ?> <?php echo e(Request::is('employee-detail*') ? 'active' : ''); ?> <?php echo e(Request::is('edit-employee*') ? 'active' : ''); ?> <?php echo e(Request::is('edit-attendance*') ? 'active' : ''); ?> <?php echo e(Request::is('admin-view-attendance*') ? 'active' : ''); ?> <?php echo e(Request::is('pending-leave') ? 'active' : ''); ?> <?php echo e(Request::is('leave-details*') ? 'active' : ''); ?> <?php echo e(Request::is('approved-leave') ? 'active' : ''); ?> <?php echo e(Request::is('leave-type') ? 'active' : ''); ?> <?php echo e(Request::is('edit-leave-type*') ? 'active' : ''); ?> <?php echo e(Request::is('pending-wfh') ? 'active' : ''); ?> <?php echo e(Request::is('approved-wfh') ? 'active' : ''); ?> <?php echo e(Request::is('wfh-details*') ? 'active' : ''); ?> <?php echo e(Request::is('approve-extra-time') ? 'active' : ''); ?> <?php echo e(Request::is('admin-hr-policy') ? 'active' : ''); ?> <?php echo e(Request::is('admin-salary-slip') ? 'active' : ''); ?> <?php echo e(Request::is('admin-add-salary-slip') ? 'active' : ''); ?> <?php echo e(Request::is('edit-salary-slip-detials*') ? 'active' : ''); ?> <?php echo e(Request::is('holiday') ? 'active' : ''); ?> <?php echo e(Request::is('team') ? 'active' : ''); ?> <?php echo e(Request::is('view-team-member*') ? 'active' : ''); ?> <?php echo e(Request::is('admin-resignation') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('overview')); ?>">
                        <i class="fa fa-lock menu-icon f-22"></i>
                        <span class="menu-title">Admin</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/components/header.blade.php ENDPATH**/ ?>