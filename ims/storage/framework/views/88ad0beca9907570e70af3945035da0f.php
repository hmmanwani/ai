<div class="card" id="custom-adminsidebar">
    <div class="card-body ">
        <div class="row ">
            <div class="col-md-12 ">
                <div class="sidebar-admin ">
                    <a href="<?php echo e(URL('overview')); ?>"
                        class="p-3 f-600 f-base <?php echo e(Request::is('overview') ? 'active' : ''); ?>">
                        <i class="fa fa-pie-chart f-22 me-1" aria-hidden="true"></i>
                        Overview
                    </a>
                    <a href="<?php echo e(URL('employee')); ?>"
                        class="p-3 f-600 f-base <?php echo e(Request::is('employee') ? 'active' : ''); ?>  <?php echo e(Request::is('employee*') ? 'active' : ''); ?>">
                        <i class="fa fa-user f-22 me-1" aria-hidden="true"></i>
                        Employee
                    </a>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <a class="accordion-button d-flex collapsed p-3 f-600 f-base <?php echo e(Request::is('pending-leave') ? 'active' : ''); ?> <?php echo e(Request::is('approved-leave') ? 'active' : ''); ?> <?php echo e(Request::is('leave*') ? 'active' : ''); ?>  <?php echo e(Request::is('add-emp-leave*') ? 'active' : ''); ?>"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class="fa fa-sign-out f-22 me-1" aria-hidden="true"></i>
                                    Leave
                                </a>
                            </h2>
                            <div id="flush-collapseOne"
                                class="accordion-collapse collapse <?php echo e(Request::is('pending-leave') ? 'show' : ''); ?> <?php echo e(Request::is('approved-leave') ? 'show' : ''); ?> <?php echo e(Request::is('leave-type') ? 'show' : ''); ?>  <?php echo e(Request::is('add-emp-leave') ? 'show' : ''); ?> <?php echo e(Request::is('leave*') ? 'show' : ''); ?>  "
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <a href="<?php echo e(URL('pending-leave')); ?>"
                                    class="p-3 f-600 child-collapse f-base <?php echo e(Request::is('pending-leave') ? 'active2' : ''); ?>">
                                    <i class="fa fa-hourglass-end f-18 me-1" aria-hidden="true"></i>
                                    Pending leaves
                                </a>
                                <a href="<?php echo e(URL('approved-leave')); ?>"
                                    class="p-3 f-600 child-collapse f-base <?php echo e(Request::is('approved-leave') ? 'active2' : ''); ?>">
                                    <i class="fa fa-check f-18 me-1" aria-hidden="true"></i>
                                    All leaves
                                </a>
                                <a href="<?php echo e(URL('leave-type')); ?>"
                                    class="p-3 f-600 child-collapse f-base <?php echo e(Request::is('leave-type') ? 'active2' : ''); ?>">
                                    <i class="fa fa-th-list f-18 me-1" aria-hidden="true"></i>
                                    Leave Type
                                </a>
                                <a href="<?php echo e(URL('add-emp-leave')); ?>"
                                    class="p-3 f-600 child-collapse f-base <?php echo e(Request::is('add-emp-leave') ? 'active2' : ''); ?>">
                                    <i class="fa fa-plus f-18 me-1" aria-hidden="true"></i>
                                    Add Emp-Leave
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <a class="accordion-button d-flex collapsed p-3 f-600 f-base  <?php echo e(Request::is('pending-wfh') ? 'active' : ''); ?> <?php echo e(Request::is('approved-wfh') ? 'active' : ''); ?> <?php echo e(Request::is('wfh*') ? 'active' : ''); ?>"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <i class="fa fa-home f-22 me-1" aria-hidden="true"></i>
                                    Work From Home
                                </a>
                            </h2>
                            <div id="flush-collapseTwo"
                                class="accordion-collapse collapse <?php echo e(Request::is('pending-wfh') ? 'show' : ''); ?> <?php echo e(Request::is('approved-wfh') ? 'show' : ''); ?> <?php echo e(Request::is('wfh*') ? 'show' : ''); ?><?php echo e(Request::is('add-employee-wfh*') ? 'show' : ''); ?>"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <a href="<?php echo e(URL('pending-wfh')); ?>"
                                    class="p-3 f-600 child-collapse f-base <?php echo e(Request::is('pending-wfh') ? 'active2' : ''); ?>">
                                    <i class="fa fa-hourglass-end f-18 me-1" aria-hidden="true"></i>
                                    Pending WFH
                                </a>
                                <a href="<?php echo e(URL('approved-wfh')); ?>"
                                    class="p-3 f-600 child-collapse f-base <?php echo e(Request::is('approved-wfh') ? 'active2' : ''); ?>">
                                    <i class="fa fa-check f-18 me-1" aria-hidden="true"></i>
                                    All WFH
                                </a>
                                <a href="<?php echo e(URL('add-employee-wfh')); ?>"
                                    class="p-3 f-600 child-collapse f-base <?php echo e(Request::is('add-employee-wfh') ? 'active2' : ''); ?>">
                                    <i class="fa fa-plus f-18 me-1" aria-hidden="true"></i>
                                    Add Employee WFH
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo e(URL('approve-extra-time')); ?>"
                        class="p-3 f-600 f-base <?php echo e(Request::is('approve-extra-time') ? 'active' : ''); ?>  <?php echo e(Request::is('approve-extra-time*') ? 'active' : ''); ?>">
                        <i class="fa fa-hourglass-end f-22 me-1" aria-hidden="true"></i>
                        Approve Extra time
                    </a>

                    
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThreee">
                                <a class="accordion-button d-flex collapsed p-3 f-600 f-base <?php echo e(Request::is('admin-hr-policy') ? 'active' : ''); ?><?php echo e(Request::is('admin-salary-slip') ? 'active' : ''); ?> "
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThreee"
                                    aria-expanded="false" aria-controls="flush-collapseThreee">
                                    <i class="fa fa-file-text  me-1" aria-hidden="true"></i>
                                    Documents
                                </a>
                            </h2>
                            <div id="flush-collapseThreee"
                                class="accordion-collapse collapse <?php echo e(Request::is('admin-hr-policy') ? 'show' : ''); ?><?php echo e(Request::is('admin-salary-slip') ? 'show' : ''); ?> "
                                aria-labelledby="flush-headingThreee" data-bs-parent="#accordionFlushExample">
                                <a href="<?php echo e(URL('admin-hr-policy')); ?>"
                                    class="p-3 f-600 child-collapse f-base <?php echo e(Request::is('admin-hr-policy') ? 'active2' : ''); ?>">
                                    <i class="fa fa-shield f-18 me-1" aria-hidden="true"></i>
                                    HR Policy
                                </a>
                                <!-- <a href="<?php echo e(URL('admin-salary-slip')); ?>"
                                    class="p-3 f-600 child-collapse f-base d-none <?php echo e(Request::is('admin-salary-slip') ? 'active2' : ''); ?> ">
                                    <i class="fa fa-money f-18 me-1" aria-hidden="true"></i>
                                    Salary Slip
                                </a> -->
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo e(URL('holiday')); ?>"
                        class="p-3 f-600  f-base <?php echo e(Request::is('holiday') ? 'active' : ''); ?> ">
                        <i class="fa fa-anchor f-22 me-1" aria-hidden="true"></i>
                        Holiday
                    </a>
                    <a href="<?php echo e(URL('team')); ?>"
                        class="p-3 f-600  f-base <?php echo e(Request::is('team') ? 'active' : ''); ?>">
                        <i class="fa fa-users f-22 me-1" aria-hidden="true"></i>
                        Team
                    </a>
                    <a href="<?php echo e(URL('admin-resignation')); ?>"
                        class="p-3 f-600  f-base <?php echo e(Request::is('admin-resignation') ? 'active' : ''); ?>">
                        <i class="fa fa-exclamation-triangle f-22 me-1" aria-hidden="true"></i>
                        Resignation
                    </a>
                    <a href="<?php echo e(URL('manage-email')); ?>"
                        class="p-3 f-600  f-base d-none <?php echo e(Request::is('manage-email') ? 'active' : ''); ?>">
                        <i class="fa fa-envelope f-22 me-1" aria-hidden="true"></i>
                        Email Control
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/components/admin-sidebar.blade.php ENDPATH**/ ?>