<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Add-Employee'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Head::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal781d22988f835a9692410092c1d21cd6)): ?>
<?php $attributes = $__attributesOriginal781d22988f835a9692410092c1d21cd6; ?>
<?php unset($__attributesOriginal781d22988f835a9692410092c1d21cd6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal781d22988f835a9692410092c1d21cd6)): ?>
<?php $component = $__componentOriginal781d22988f835a9692410092c1d21cd6; ?>
<?php unset($__componentOriginal781d22988f835a9692410092c1d21cd6); ?>
<?php endif; ?>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Header::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $attributes = $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $component = $__componentOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <section id="addemployee">
                        <div class="conatiner">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 align-self-center">
                                            <h2>Add Employee</h2>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end"><button onclick="goBack()"
                                                class="btn btn-primary"><i class="fa fa-arrow-left me-2"
                                                    aria-hidden="true"></i>Back</button></div>
                                    </div>
                                    <hr>
                                    <div class="row mt-4">
                                        <div class="col-md-12 f-black f-500">
                                            <form action="<?php echo e(url('/submit-employee')); ?>" method="post" id="myForm">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">

                                                    
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="fname">First Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="fname" name="fname"
                                                                    class="form-control" required>
                                                                <div class="invalid-feedback" id="fname-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="mname">Middle Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="mname" name="mname"
                                                                    class="form-control">
                                                                <div class="invalid-feedback" id="mname-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="lname">Last Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="lname" name="lname"
                                                                    class="form-control">
                                                                <div class="invalid-feedback" id="lname-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="email">Email</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="email" name="email"
                                                                    class="form-control">
                                                                <div class="invalid-feedback" id="email-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="password">Password</label>
                                                            <div class="col-md-12 input-group">
                                                                <input type="password" id="password" name="password"
                                                                    class="form-control">
                                                                <i class="fa fa-eye toggle-password input-group-text"
                                                                    id="togglePassword1"></i>
                                                                <div class="invalid-feedback" id="password-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="confirm_password">Confirm
                                                                Password</label>
                                                            <div class="col-md-12 input-group">
                                                                <input type="password" id="confirm_password"
                                                                    name="confirm_password" class="form-control">
                                                                <i class="fa fa-eye toggle-password input-group-text"
                                                                    id="togglePassword2"></i>
                                                                <div class="invalid-feedback"
                                                                    id="confirm_password-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="nationality">Nationality</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="nationality"
                                                                    name="nationality" class="form-control">
                                                                <div class="invalid-feedback" id="nationality-error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="required" for="marital_status">Marital
                                                                Status</label>
                                                            <select name="marital_status" id="marital_status"
                                                                class="form-select">
                                                                <option value="">-Select Marital Status-</option>
                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Divorced">Divorced</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="required" for="lname">Gender</label>
                                                            <select name="gender" id="gender"
                                                                class="form-select">
                                                                <option value="">-Select Your Gender-</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="required" for="bloodtype">Blood Type</label>
                                                            <select name="bloodtype" id="bloodtype"
                                                                class="form-select">
                                                                <option value="">-Select Your bloodtype-</option>
                                                                <option value="A+">A+</option>
                                                                <option value="A-">A-</option>
                                                                <option value="B+">B+</option>
                                                                <option value="B-">B-</option>
                                                                <option value="AB+">AB+</option>
                                                                <option value="AB-">AB-</option>
                                                                <option value="O+">O+</option>
                                                                <option value="O-">O-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="phone">Contact
                                                                number</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="phone" name="phone"
                                                                    class="form-control" maxlength="10">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="pemail">Personal
                                                                Email</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="pemail" name="pemail"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="dob">Date of
                                                                Birth</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="dob" name="dob"
                                                                    class="form-control date"
                                                                    placeholder="dd-mm-yyyy">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="required" for="team">Team</label>
                                                            <select name="team" id="team"
                                                                class="form-select">
                                                                <option value="">-Select team-</option>
                                                                <?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teams): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($teams->t_id); ?>">
                                                                        <?php echo e($teams->team); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label class="required f-16" for="join_date">
                                                                Leader</label>
                                                            <div class="">
                                                                <input type="checkbox" name="team_lead"
                                                                    class="js-switch-team-leader mt-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4" id="work-report-team-container"
                                                        style="display: none;">
                                                        <div class="form-group">
                                                            <label class="required" for="workreportteam">Daily Work
                                                                Report Team</label>
                                                            <select name="workreportteam[]" id="WorkReportTeam"
                                                                class="form-select select2" multiple>
                                                                <option value="" disabled>-Select Work Report
                                                                    Team-</option>
                                                                    <?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teams): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($teams->t_id); ?>">
                                                                        <?php echo e($teams->team); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="designations">Designation</label>
                                                            <div class="col-md-12">
                                                                <select id="designation" name="designation"
                                                                    class="form-select" required="">
                                                                    <option value="">Choose a Role</option>
                                                                    <option value="CEO">CEO</option>
                                                                    <option value="Project Manager - Intern">Project
                                                                        Manager - Intern</option>
                                                                    <option value="Jr. Project Manager">Jr. Project
                                                                        Manager</option>
                                                                    <option value="Project Manager">Project Manager
                                                                    </option>
                                                                    <option value="Sr. Project Manager">Sr. Project
                                                                        Manager</option>
                                                                    <option value="HR Executive - Intern">HR Executive
                                                                        - Intern
                                                                    </option>
                                                                    <option value="Jr. HR Executive">Jr. HR Executive
                                                                    </option>
                                                                    <option value="Sr. HR Executive">Sr. HR Executive
                                                                    </option>
                                                                    <option value="HR Manager">HR Manager</option>
                                                                    <option value="PHP - Intern">PHP - Intern</option>
                                                                    <option value="Jr. PHP Developer">Jr. PHP Developer
                                                                    </option>
                                                                    <option value="PHP Developer">PHP Developer
                                                                    </option>
                                                                    <option value="Sr. PHP Developer">Sr. PHP Developer
                                                                    </option>
                                                                    <option value="PHP Team Leder">PHP Team Leder
                                                                    </option>
                                                                    <option value="Digital Marketing - Intern">Digital
                                                                        Marketing - Intern
                                                                    </option>
                                                                    <option value="Jr. Digital Marketer">Jr. Digital
                                                                        Marketer
                                                                    </option>
                                                                    <option value="Digital Marketing Executive">Digital
                                                                        Marketing Executive
                                                                    </option>
                                                                    <option value="Sr. Digital Marketer">Sr. Digital
                                                                        Marketer
                                                                    </option>
                                                                    <option value="SEO Executive">SEO Executive
                                                                    </option>
                                                                    <option value="Social Media Manager">Social Media
                                                                        Manager</option>
                                                                    <option value="Digital Marketing Strategist">
                                                                        Digital Marketing Strategist</option>
                                                                    <option value="Jr. Accoutant">Jr. Accoutant
                                                                    </option>
                                                                    <option value="Accountant">Accountant</option>
                                                                    <option value="Sr. Accountant">Sr. Accountant
                                                                    </option>
                                                                    <option value="Cloud Engeener - Intern">Cloud
                                                                        Engeener - Intern</option>
                                                                    <option value="Jr. Cloud Engeener">Jr. Cloud
                                                                        Engeener</option>
                                                                    <option value="Cloud Engeener">Cloud Engeener
                                                                    </option>
                                                                    <option value="UI/UX Designer - Intern">UI/UX
                                                                        Designer - Intern
                                                                    </option>
                                                                    <option value="Graphic Designer - Intern">Graphic
                                                                        Designer - Intern</option>
                                                                    <option value="Jr. UI/UX Designer">Jr. UI/UX
                                                                        Designer</option>
                                                                    <option value="Jr. Graphic Designer">Jr. Graphic
                                                                        Designer</option>
                                                                    <option value="Graphic Designer">Graphic Designer
                                                                    </option>
                                                                    <option value="UI/UX Designer">UI/UX Designer
                                                                    </option>
                                                                    <option value="Graphic Designer & UI/UX Designer">
                                                                        Graphic Designer & UI/UX Designer</option>
                                                                    <option value="Sr. UI/UX Designer">Sr. UI/UX
                                                                        Designer</option>
                                                                    <option value="Sr. Graphic Designer">Sr. Graphic
                                                                        Designer</option>
                                                                    <option
                                                                        value="UI/UX Designer & Graphic Team Leder  ">
                                                                        UI/UX Designer & Graphic Team Leder</option>
                                                                    <option value="WordPress - Intern">WordPress -
                                                                        Intern</option>
                                                                    <option value="Jr. WordPress Developer">Jr.
                                                                        WordPress Developer
                                                                    </option>
                                                                    <option value="WordPress Developer">WordPress
                                                                        Developer</option>
                                                                    <option value="Sr. WordPress Developer">Sr.
                                                                        WordPress Developer
                                                                    </option>
                                                                    <option value="QWordPress Team LederA">WordPress
                                                                        Team Leder
                                                                    </option>

                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="emp_experience">Experience</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="emp_experience"
                                                                    name="emp_experience" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <label class="required" for="role" class="">Select
                                                            Role</label>
                                                        <select class="form-select" id="role" name="role"
                                                            aria-label="Default select example">
                                                            <option value="">-Select Role-</option>
                                                            <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($roles->r_id); ?>">
                                                                    <?php echo e($roles->role); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <label class="required" for="join_date">Join Date</label>
                                                        <div class="col-md-12">
                                                            <input type="text" name="join_date" id="join_date"
                                                                class="form-control date" placeholder="dd-mm-yyyy">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="required" for="download_ss">Download Salary
                                                                Slip</label>
                                                            <div class="d-flex">
                                                                <input type="checkbox" name="download_ss"
                                                                    class="js-switch-download mt-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="required" for="permanent_wfh">Permanent
                                                                WFH</label>
                                                            <div class="d-flex">
                                                                <input type="checkbox" name="is_wfh_permanent"
                                                                    class="js-switch-wfh-permanent mt-5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3 d-flex justify-content-end">
                                                    <button type="submit" id="submitBtn"
                                                        class="btn btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php if (isset($component)) { $__componentOriginalaa4a76679997a5d7ba3507fdf5954ccf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa4a76679997a5d7ba3507fdf5954ccf = $attributes; } ?>
<?php $component = App\View\Components\FooterCon::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer-con'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\FooterCon::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaa4a76679997a5d7ba3507fdf5954ccf)): ?>
<?php $attributes = $__attributesOriginalaa4a76679997a5d7ba3507fdf5954ccf; ?>
<?php unset($__attributesOriginalaa4a76679997a5d7ba3507fdf5954ccf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaa4a76679997a5d7ba3507fdf5954ccf)): ?>
<?php $component = $__componentOriginalaa4a76679997a5d7ba3507fdf5954ccf; ?>
<?php unset($__componentOriginalaa4a76679997a5d7ba3507fdf5954ccf); ?>
<?php endif; ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <?php if (isset($component)) { $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $attributes; } ?>
<?php $component = App\View\Components\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Footer::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $attributes = $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $component = $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
    <script>
        $(document).ready(function() {
            $('#phone').on('keypress', function(event) {
                var charCode = (event.which) ? event.which : event.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            });
        });
    </script>
    <script>
        $("#dob").flatpickr({
            dateFormat: "d-m-Y",
            maxDate: "today",
        });

        $("#join_date").flatpickr({
            dateFormat: "d-m-Y",
            maxDate: "today",
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            //  Team Leader
            var elemTeamLeader = document.querySelector('.js-switch-team-leader');
            var switcheryTeamLeader = new Switchery(elemTeamLeader, {
                color: '#2bf503',
                secondaryColor: '#f51303',
                disabled: false
            });
            $('#work-report-team-container').toggle(elemTeamLeader.checked);
            elemTeamLeader.addEventListener('change', function() {
                var hiddenInputTeamLeader = document.querySelector('[name="team_lead_hidden"]');
                hiddenInputTeamLeader.value = elemTeamLeader.checked ? 1 : 0;
                // Show or hide
                $('#work-report-team-container').toggle(elemTeamLeader.checked);
            });


            //  Download Salary Slip
            var elemDownloadSS = document.querySelector('.js-switch-download');
            var switcheryDownloadSS = new Switchery(elemDownloadSS, {
                color: '#2bf503',
                secondaryColor: '#f51303',
                disabled: false
            });
            elemDownloadSS.addEventListener('change', function() {
                var hiddenInputDownloadSS = document.querySelector('[name="download_ss"]');
                hiddenInputDownloadSS.value = elemDownloadSS.checked ? 1 : 0;
            });

            //  is wfh permanent
            var elemDownloadSS = document.querySelector('.js-switch-wfh-permanent');
            var switcheryDownloadSS = new Switchery(elemDownloadSS, {
                color: '#2bf503',
                secondaryColor: '#f51303',
                disabled: false
            });
            elemDownloadSS.addEventListener('change', function() {
                var hiddenInputDownloadSS = document.querySelector('[name="is_wfh_permanent"]');
                hiddenInputDownloadSS.value = elemDownloadSS.checked ? 1 : 0;
            });
        });
    </script>
    <script>
        // Daily Work Report Team Select 2
        $(document).ready(function() {
            // Initialize Select2
            $("#WorkReportTeam").select2({
                placeholder: "-Select Work Report Team-", // Optional: Custom placeholder
                allowClear: true // Optional: Enable clear button
            });

            // Show or hide the container based on the checkbox state
            var elemTeamLeader = document.querySelector('.js-switch-team-leader');
            $('#work-report-team-container').toggle(elemTeamLeader.checked);

            elemTeamLeader.addEventListener('change', function() {
                $('#work-report-team-container').toggle(elemTeamLeader.checked);
            });
        });
    </script>
    <script>
        function goBack() {
            history.go(-1);
        }


        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    fname: {
                        required: true
                    },
                    mname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "[name='password']"
                    },
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    nationality: {
                        required: true
                    },
                    pemail: {
                        required: true
                    },
                    designation: {
                        required: true
                    },
                    emp_experience: {
                        required: true
                    },
                    team: {
                        required: true
                    },
                    marital_status: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    bloodtype: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    dob: {
                        required: true
                    },
                    join_date: {
                        required: true
                    }
                },
                errorPlacement: function(error, element) {
                    // Customize where error messages are placed if needed
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    $("#submitBtn").prop('disabled', true);
                    form.submit();
                }
            });
        });
    </script>
    <script>
        document.getElementById('togglePassword1').addEventListener('click', function(e) {
            const password = document.getElementById('password');
            if (password.type === 'password') {
                password.type = 'text';
                e.target.classList.remove('fa-eye');
                e.target.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                e.target.classList.remove('fa-eye-slash');
                e.target.classList.add('fa-eye');
            }
        });

        document.getElementById('togglePassword2').addEventListener('click', function(e) {
            const confirmPassword = document.getElementById('confirm_password');
            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                e.target.classList.remove('fa-eye');
                e.target.classList.add('fa-eye-slash');
            } else {
                confirmPassword.type = 'password';
                e.target.classList.remove('fa-eye-slash');
                e.target.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/admin/employee/addemployee.blade.php ENDPATH**/ ?>