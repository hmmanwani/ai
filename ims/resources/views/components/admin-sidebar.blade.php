<div class="card" id="custom-adminsidebar">
    <div class="card-body ">
        <div class="row ">
            <div class="col-md-12 ">
                <div class="sidebar-admin ">
                    <a href="{{ URL('overview') }}"
                        class="p-3 f-600 f-base {{ Request::is('overview') ? 'active' : '' }}">
                        <i class="fa fa-pie-chart f-22 me-1" aria-hidden="true"></i>
                        Overview
                    </a>
                    <a href="{{ URL('employee') }}"
                        class="p-3 f-600 f-base {{ Request::is('employee') ? 'active' : '' }}  {{ Request::is('employee*') ? 'active' : '' }}">
                        <i class="fa fa-user f-22 me-1" aria-hidden="true"></i>
                        Employee
                    </a>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <a class="accordion-button d-flex collapsed p-3 f-600 f-base {{ Request::is('pending-leave') ? 'active' : '' }} {{ Request::is('approved-leave') ? 'active' : '' }} {{ Request::is('leave*') ? 'active' : '' }}  {{ Request::is('add-emp-leave*') ? 'active' : '' }}"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class="fa fa-sign-out f-22 me-1" aria-hidden="true"></i>
                                    Leave
                                </a>
                            </h2>
                            <div id="flush-collapseOne"
                                class="accordion-collapse collapse {{ Request::is('pending-leave') ? 'show' : '' }} {{ Request::is('approved-leave') ? 'show' : '' }} {{ Request::is('leave-type') ? 'show' : '' }}  {{ Request::is('add-emp-leave') ? 'show' : '' }} {{ Request::is('leave*') ? 'show' : '' }}  "
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <a href="{{ URL('pending-leave') }}"
                                    class="p-3 f-600 child-collapse f-base {{ Request::is('pending-leave') ? 'active2' : '' }}">
                                    <i class="fa fa-hourglass-end f-18 me-1" aria-hidden="true"></i>
                                    Pending leaves
                                </a>
                                <a href="{{ URL('approved-leave') }}"
                                    class="p-3 f-600 child-collapse f-base {{ Request::is('approved-leave') ? 'active2' : '' }}">
                                    <i class="fa fa-check f-18 me-1" aria-hidden="true"></i>
                                    All leaves
                                </a>
                                <a href="{{ URL('leave-type') }}"
                                    class="p-3 f-600 child-collapse f-base {{ Request::is('leave-type') ? 'active2' : '' }}">
                                    <i class="fa fa-th-list f-18 me-1" aria-hidden="true"></i>
                                    Leave Type
                                </a>
                                <a href="{{ URL('add-emp-leave') }}"
                                    class="p-3 f-600 child-collapse f-base {{ Request::is('add-emp-leave') ? 'active2' : '' }}">
                                    <i class="fa fa-plus f-18 me-1" aria-hidden="true"></i>
                                    Add Emp-Leave
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <a class="accordion-button d-flex collapsed p-3 f-600 f-base  {{ Request::is('pending-wfh') ? 'active' : '' }} {{ Request::is('approved-wfh') ? 'active' : '' }} {{ Request::is('wfh*') ? 'active' : '' }}"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <i class="fa fa-home f-22 me-1" aria-hidden="true"></i>
                                    Work From Home
                                </a>
                            </h2>
                            <div id="flush-collapseTwo"
                                class="accordion-collapse collapse {{ Request::is('pending-wfh') ? 'show' : '' }} {{ Request::is('approved-wfh') ? 'show' : '' }} {{ Request::is('wfh*') ? 'show' : '' }}{{ Request::is('add-employee-wfh*') ? 'show' : ''  }}"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <a href="{{ URL('pending-wfh') }}"
                                    class="p-3 f-600 child-collapse f-base {{ Request::is('pending-wfh') ? 'active2' : '' }}">
                                    <i class="fa fa-hourglass-end f-18 me-1" aria-hidden="true"></i>
                                    Pending WFH
                                </a>
                                <a href="{{ URL('approved-wfh') }}"
                                    class="p-3 f-600 child-collapse f-base {{ Request::is('approved-wfh') ? 'active2' : '' }}">
                                    <i class="fa fa-check f-18 me-1" aria-hidden="true"></i>
                                    All WFH
                                </a>
                                <a href="{{ URL('add-employee-wfh') }}"
                                    class="p-3 f-600 child-collapse f-base {{ Request::is('add-employee-wfh') ? 'active2' : '' }}">
                                    <i class="fa fa-plus f-18 me-1" aria-hidden="true"></i>
                                    Add Employee WFH
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ URL('approve-extra-time') }}"
                        class="p-3 f-600 f-base {{ Request::is('approve-extra-time') ? 'active' : '' }}  {{ Request::is('approve-extra-time*') ? 'active' : '' }}">
                        <i class="fa fa-hourglass-end f-22 me-1" aria-hidden="true"></i>
                        Approve Extra time
                    </a>

                    {{-- documentation --}}
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThreee">
                                <a class="accordion-button d-flex collapsed p-3 f-600 f-base {{ Request::is('admin-hr-policy') ? 'active' : '' }}{{ Request::is('admin-salary-slip') ? 'active' : '' }} "
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThreee"
                                    aria-expanded="false" aria-controls="flush-collapseThreee">
                                    <i class="fa fa-file-text  me-1" aria-hidden="true"></i>
                                    Documents
                                </a>
                            </h2>
                            <div id="flush-collapseThreee"
                                class="accordion-collapse collapse {{ Request::is('admin-hr-policy') ? 'show' : '' }}{{ Request::is('admin-salary-slip') ? 'show' : '' }} "
                                aria-labelledby="flush-headingThreee" data-bs-parent="#accordionFlushExample">
                                <a href="{{ URL('admin-hr-policy') }}"
                                    class="p-3 f-600 child-collapse f-base {{ Request::is('admin-hr-policy') ? 'active2' : '' }}">
                                    <i class="fa fa-shield f-18 me-1" aria-hidden="true"></i>
                                    HR Policy
                                </a>
                                <!-- <a href="{{ URL('admin-salary-slip') }}"
                                    class="p-3 f-600 child-collapse f-base d-none {{ Request::is('admin-salary-slip') ? 'active2' : '' }} ">
                                    <i class="fa fa-money f-18 me-1" aria-hidden="true"></i>
                                    Salary Slip
                                </a> -->
                            </div>
                        </div>
                    </div>
                    <a href="{{ URL('holiday') }}"
                        class="p-3 f-600  f-base {{ Request::is('holiday') ? 'active' : '' }} ">
                        <i class="fa fa-anchor f-22 me-1" aria-hidden="true"></i>
                        Holiday
                    </a>
                    <a href="{{ URL('team') }}"
                        class="p-3 f-600  f-base {{ Request::is('team') ? 'active' : '' }}">
                        <i class="fa fa-users f-22 me-1" aria-hidden="true"></i>
                        Team
                    </a>
                    <a href="{{ URL('admin-resignation') }}"
                        class="p-3 f-600  f-base {{ Request::is('admin-resignation') ? 'active' : '' }}">
                        <i class="fa fa-exclamation-triangle f-22 me-1" aria-hidden="true"></i>
                        Resignation
                    </a>
                    <a href="{{ URL('manage-email') }}"
                        class="p-3 f-600  f-base d-none {{ Request::is('manage-email') ? 'active' : '' }}">
                        <i class="fa fa-envelope f-22 me-1" aria-hidden="true"></i>
                        Email Control
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
