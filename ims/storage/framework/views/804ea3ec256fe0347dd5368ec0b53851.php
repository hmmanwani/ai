<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Edit Employee'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    
                    <section id="edit-employee">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end  mb-3 ">
                                        <button onclick="goBack()" class="btn btn-primary"><i
                                                class="fa fa-arrow-left me-2" aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 f-black f-500">
                                                    <form action="<?php echo e(url('/submit-admin-employee')); ?>" method="post"
                                                        id="myForm">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo e($data->e_id); ?>">
                                                            
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="fname">First
                                                                        Name</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="fname"
                                                                            name="fname" class="form-control"
                                                                            value="<?php echo e($data->fname); ?>" required>
                                                                        <div class="invalid-feedback" id="fname-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="mname">Middle
                                                                        Name</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="mname"
                                                                            name="mname" class="form-control"
                                                                            value="<?php echo e($data->mname); ?>">
                                                                        <div class="invalid-feedback" id="mname-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="lname">Last
                                                                        Name</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="lname"
                                                                            name="lname" class="form-control"
                                                                            value="<?php echo e($data->lname); ?>">
                                                                        <div class="invalid-feedback" id="lname-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required" for="email">Email</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="email"
                                                                            name="email" class="form-control"
                                                                            value="<?php echo e($data->email); ?>">
                                                                        <div class="invalid-feedback" id="email-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="nationality">Nationality</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="nationality"
                                                                            name="nationality" class="form-control"
                                                                            value="<?php echo e($data->nationality); ?>">
                                                                        <div class="invalid-feedback"
                                                                            id="nationality-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required" for="marital_status">Marital
                                                                        Status</label>
                                                                    <select name="marital_status" id="marital_status"
                                                                        class="form-select"
                                                                        value="<?php echo e($data->marital_status); ?>">
                                                                        <option value="">-Select Marital Status-
                                                                        </option>
                                                                        <option value="Single" <?php echo $data->marital_status == 'Single' ? 'selected' : ''; ?>>
                                                                            Single
                                                                        </option>
                                                                        <option value="Married" <?php echo $data->marital_status == 'Married' ? 'selected' : ''; ?>>
                                                                            Married
                                                                        </option>
                                                                        <option value="Divorced" <?php echo $data->marital_status == 'Divorced' ? 'selected' : ''; ?>>
                                                                            Divorced
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="lname">Gender</label>
                                                                    <select name="gender" id="gender"
                                                                        class="form-select"
                                                                        value="<?php echo e($data->gender); ?>">
                                                                        <option value="">-Select Your Gender-
                                                                        </option>
                                                                        <option value="Male" <?php echo $data->gender == 'Male' ? 'selected' : ''; ?>>
                                                                            Male</option>
                                                                        <option value="Female" <?php echo $data->gender == 'Female' ? 'selected' : ''; ?>>
                                                                            Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required" for="bloodtype">Blood
                                                                        Type</label>
                                                                    <select name="bloodtype" id="bloodtype"
                                                                        class="form-select"
                                                                        value="<?php echo e($data->bloodtype); ?>">
                                                                        <option value="">-Select Your bloodtype-
                                                                        </option>
                                                                        <option value="A+" <?php echo $data->bloodtype == 'A+' ? 'selected' : ''; ?>> A+
                                                                        </option>
                                                                        <option value="A-" <?php echo $data->bloodtype == 'A-' ? 'selected' : ''; ?>>A-
                                                                        </option>
                                                                        <option value="B+" <?php echo $data->bloodtype == 'B+' ? 'selected' : ''; ?>>B+
                                                                        </option>
                                                                        <option value="B-" <?php echo $data->bloodtype == 'B-' ? 'selected' : ''; ?>>B-
                                                                        </option>
                                                                        <option value="AB+" <?php echo $data->bloodtype == 'AB+' ? 'selected' : ''; ?>> AB+
                                                                        </option>
                                                                        <option value="AB-" <?php echo $data->bloodtype == 'AB-' ? 'selected' : ''; ?>>
                                                                            AB-</option>
                                                                        <option value="O+" <?php echo $data->bloodtype == 'O+' ? 'selected' : ''; ?>>O+
                                                                        </option>
                                                                        <option value="O-" <?php echo $data->bloodtype == 'O-' ? 'selected' : ''; ?>>O-
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="required" for="phone">Contact
                                                                        number</label>
                                                                    <div class="col-md-12">
                                                                        <input type="number" id="phone"
                                                                            value="<?php echo e($data->phone); ?>"
                                                                            name="phone" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="required" for="pemail">Personal
                                                                        Email</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="pemail"
                                                                            name="pemail" class="form-control"
                                                                            value="<?php echo e($data->pemail); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="required" for="dob">Date of
                                                                        Birth</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="dob"
                                                                            name="dob" class="form-control"
                                                                            placeholder="dd-mm-yyyy"
                                                                            value="<?php echo e($data->dob); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="team">Team</label>
                                                                    <select name="team" id="team"
                                                                        class="form-select"
                                                                        value="<?php echo e($data->team); ?> ">
                                                                        <option value="">-Select team-</option>
                                                                        <?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teams): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($teams->t_id); ?>"
                                                                                <?php echo e($teams->t_id == $data->team ? 'selected' : ''); ?>>
                                                                                <?php echo e($teams->team); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label class="required f-16" for="team_lead">
                                                                        Leader</label>
                                                                    <div class="">
                                                                        <input type="checkbox" name="team_lead"
                                                                            class="js-switch-team-leader mt-5"
                                                                            <?php echo $data->team_lead == 1 ? 'checked' : ''; ?>>
                                                                        <input type="hidden" name="team_lead_hidden"
                                                                            value="<?php echo $data->team_lead; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4" id="work-report-team-container"
                                                                style="display: none;">
                                                                <div class="form-group">
                                                                    <label class="required" for="workreportteam">Daily
                                                                        Work Report Team</label>
                                                                    <select name="workreportteam[]"
                                                                        id="WorkReportTeam"
                                                                        class="form-select select2" multiple>
                                                                        <option value="" disabled>-Select Work
                                                                            Report Team-</option>
                                                                        <?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teams): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($teams->t_id); ?>"
                                                                                <?php echo e(in_array($teams->t_id, json_decode($data->work_report_team, true) ?? []) ? 'selected' : ''); ?>>
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
                                                                            class="form-select">
                                                                            <option value="">Choose a Role
                                                                            </option>
                                                                            <option value="CEO"
                                                                                <?php if($data->designation == 'CEO'): echo 'selected'; endif; ?>>CEO
                                                                            </option>
                                                                            <option value="Project Manager - Intern"
                                                                                <?php if($data->designation == 'Project Manager - Intern'): echo 'selected'; endif; ?>>
                                                                                Project Manager - Intern</option>
                                                                            <option value="Jr. Project Manager"
                                                                                <?php if($data->designation == 'Jr. Project Manager'): echo 'selected'; endif; ?>>
                                                                                Jr. Project Manager</option>
                                                                            <option value="Project Manager"
                                                                                <?php if($data->designation == 'Project Manager'): echo 'selected'; endif; ?>>
                                                                                Project Manager</option>
                                                                            <option value="Sr. Project Manager"
                                                                                <?php if($data->designation == 'Sr. Project Manager'): echo 'selected'; endif; ?>>
                                                                                Sr. Project Manager</option>
                                                                            <option value="HR Executive - Intern"
                                                                                <?php if($data->designation == 'HR Executive - Intern'): echo 'selected'; endif; ?>>
                                                                                HR Executive - Intern</option>
                                                                            <option value="Jr. HR Executive"
                                                                                <?php if($data->designation == 'Jr. HR Executive'): echo 'selected'; endif; ?>>
                                                                                Jr. HR Executive</option>
                                                                            <option value="Sr. HR Executive"
                                                                                <?php if($data->designation == 'Sr. HR Executive'): echo 'selected'; endif; ?>>
                                                                                Sr. HR Executive</option>
                                                                            <option value="HR Manager"
                                                                                <?php if($data->designation == 'HR Manager'): echo 'selected'; endif; ?>>
                                                                                HR Manager</option>
                                                                            <option value="PHP - Intern"
                                                                                <?php if($data->designation == 'PHP - Intern'): echo 'selected'; endif; ?>>
                                                                                PHP - Intern</option>
                                                                            <option value="Jr. PHP Developer"
                                                                                <?php if($data->designation == 'Jr. PHP Developer'): echo 'selected'; endif; ?>>
                                                                                Jr. PHP Developer</option>
                                                                            <option value="PHP Developer"
                                                                                <?php if($data->designation == 'PHP Developer'): echo 'selected'; endif; ?>>
                                                                                PHP Developer</option>
                                                                            <option value="Sr. PHP Developer"
                                                                                <?php if($data->designation == 'Sr. PHP Developer'): echo 'selected'; endif; ?>>
                                                                                Sr. PHP Developer</option>
                                                                            <option value="PHP Team Leader"
                                                                                <?php if($data->designation == 'PHP Team Leader'): echo 'selected'; endif; ?>>
                                                                                PHP Team Leader</option>
                                                                            <option value="Digital Marketing - Intern"
                                                                                <?php if($data->designation == 'Digital Marketing - Intern'): echo 'selected'; endif; ?>>
                                                                                Digital Marketing - Intern</option>
                                                                            <option value="Jr. Digital Marketer"
                                                                                <?php if($data->designation == 'Jr. Digital Marketer'): echo 'selected'; endif; ?>>
                                                                                Jr. Digital Marketer</option>
                                                                            <option value="Digital Marketing Executive"
                                                                                <?php if($data->designation == 'Digital Marketing Executive'): echo 'selected'; endif; ?>>
                                                                                Digital Marketing Executive</option>
                                                                            <option value="Sr. Digital Marketer"
                                                                                <?php if($data->designation == 'Sr. Digital Marketer'): echo 'selected'; endif; ?>>
                                                                                Sr. Digital Marketer</option>
                                                                            <option value="SEO Executive"
                                                                                <?php if($data->designation == 'SEO Executive'): echo 'selected'; endif; ?>>
                                                                                SEO Executive</option>
                                                                            <option value="Social Media Manager"
                                                                                <?php if($data->designation == 'Social Media Manager'): echo 'selected'; endif; ?>>
                                                                                Social Media Manager</option>
                                                                            <option
                                                                                value="Digital Marketing Strategist"
                                                                                <?php if($data->designation == 'Digital Marketing Strategist'): echo 'selected'; endif; ?>>
                                                                                Digital Marketing Strategist</option>
                                                                            <option value="Jr. Accountant"
                                                                                <?php if($data->designation == 'Jr. Accountant'): echo 'selected'; endif; ?>>
                                                                                Jr. Accountant</option>
                                                                            <option value="Accountant"
                                                                                <?php if($data->designation == 'Accountant'): echo 'selected'; endif; ?>>
                                                                                Accountant</option>
                                                                            <option value="Sr. Accountant"
                                                                                <?php if($data->designation == 'Sr. Accountant'): echo 'selected'; endif; ?>>
                                                                                Sr. Accountant</option>
                                                                            <option value="Cloud Engineer - Intern"
                                                                                <?php if($data->designation == 'Cloud Engineer - Intern'): echo 'selected'; endif; ?>>
                                                                                Cloud Engineer - Intern</option>
                                                                            <option value="Jr. Cloud Engineer"
                                                                                <?php if($data->designation == 'Jr. Cloud Engineer'): echo 'selected'; endif; ?>>
                                                                                Jr. Cloud Engineer</option>
                                                                            <option value="Cloud Engineer"
                                                                                <?php if($data->designation == 'Cloud Engineer'): echo 'selected'; endif; ?>>
                                                                                Cloud Engineer</option>
                                                                            <option value="UI/UX Designer - Intern"
                                                                                <?php if($data->designation == 'UI/UX Designer - Intern'): echo 'selected'; endif; ?>>
                                                                                UI/UX Designer - Intern</option>
                                                                            <option value="Graphic Designer - Intern"
                                                                                <?php if($data->designation == 'Graphic Designer - Intern'): echo 'selected'; endif; ?>>
                                                                                Graphic Designer - Intern</option>
                                                                            <option value="Jr. UI/UX Designer"
                                                                                <?php if($data->designation == 'Jr. UI/UX Designer'): echo 'selected'; endif; ?>>
                                                                                Jr. UI/UX Designer</option>
                                                                            <option value="Jr. Graphic Designer"
                                                                                <?php if($data->designation == 'Jr. Graphic Designer'): echo 'selected'; endif; ?>>
                                                                                Jr. Graphic Designer</option>
                                                                            <option value="Graphic Designer"
                                                                                <?php if($data->designation == 'Graphic Designer'): echo 'selected'; endif; ?>>
                                                                                Graphic Designer</option>
                                                                            <option value="UI/UX Designer"
                                                                                <?php if($data->designation == 'UI/UX Designer'): echo 'selected'; endif; ?>>
                                                                                UI/UX Designer</option>
                                                                            <option
                                                                                value="Graphic Designer & UI/UX Designer"
                                                                                <?php if($data->designation == 'Graphic Designer & UI/UX Designer'): echo 'selected'; endif; ?>>
                                                                                Graphic Designer & UI/UX Designer
                                                                            </option>
                                                                            <option value="Sr. UI/UX Designer"
                                                                                <?php if($data->designation == 'Sr. UI/UX Designer'): echo 'selected'; endif; ?>>
                                                                                Sr. UI/UX Designer</option>
                                                                            <option value="Sr. Graphic Designer"
                                                                                <?php if($data->designation == 'Sr. Graphic Designer'): echo 'selected'; endif; ?>>
                                                                                Sr. Graphic Designer</option>
                                                                            <option
                                                                                value="UI/UX Designer & Graphic Team Leader"
                                                                                <?php if($data->designation == 'UI/UX Designer & Graphic Team Leader'): echo 'selected'; endif; ?>>
                                                                                UI/UX Designer & Graphic Team Leader
                                                                            </option>
                                                                            <option value="WordPress - Intern"
                                                                                <?php if($data->designation == 'WordPress - Intern'): echo 'selected'; endif; ?>>
                                                                                WordPress - Intern</option>
                                                                            <option value="Jr. WordPress Developer"
                                                                                <?php if($data->designation == 'Jr. WordPress Developer'): echo 'selected'; endif; ?>>
                                                                                Jr. WordPress Developer</option>
                                                                            <option value="WordPress Developer"
                                                                                <?php if($data->designation == 'WordPress Developer'): echo 'selected'; endif; ?>>
                                                                                WordPress Developer</option>
                                                                            <option value="Sr. WordPress Developer"
                                                                                <?php if($data->designation == 'Sr. WordPress Developer'): echo 'selected'; endif; ?>>
                                                                                Sr. WordPress Developer</option>
                                                                            <option value="WordPress Team Leader"
                                                                                <?php if($data->designation == 'WordPress Team Leader'): echo 'selected'; endif; ?>>
                                                                                WordPress Team Leader</option>
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
                                                                            name="emp_experience" class="form-control"
                                                                            value="<?php echo e($data->emp_experience); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <label class="required" for="role"
                                                                    class="">Select
                                                                    Role</label>
                                                                <select class="form-select" id="role"
                                                                    name="role" aria-label="Default select example"
                                                                    value="<?php echo e($data->role); ?>">
                                                                    <option value="">-Select Role-</option>
                                                                    <option value="1" <?php echo $data->role == '1' ? 'selected' : ''; ?>>Admin
                                                                    </option>
                                                                    <option value="2" <?php echo $data->role == '2' ? 'selected' : ''; ?>>Hr
                                                                    </option>
                                                                    <option value="3" <?php echo $data->role == '3' ? 'selected' : ''; ?>>
                                                                        Employee</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <label class="required" for="join_date">Join
                                                                    Date</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="join_date"
                                                                        id="join_date" class="form-control"
                                                                        placeholder="dd-mm-yyyy"
                                                                        value="<?php echo e($data->join_date); ?>">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-2">
                                                                <label class="required"
                                                                    for="download_salary_slip">Download
                                                                    Salary Slip</label>
                                                                <div class="col-md-12">
                                                                    <input type="checkbox" name="download_ss"
                                                                        class="js-switch-download mt-5"
                                                                        <?php echo $data->download_ss == 1 ? 'checked' : ''; ?>>
                                                                    <input type="hidden" name="download_ss_hidden"
                                                                        value="<?php echo $data->download_ss; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="required"
                                                                    for="is_wfh_permanent">Permanent WFH</label>
                                                                <div class="col-md-12">
                                                                    <input type="checkbox"
                                                                        id="is_wfh_permanent_checkbox"
                                                                        class="js-switch-wfh-permanent mt-5"
                                                                        <?php echo $data->is_wfh_permanent == 1 ? 'checked' : ''; ?>>
                                                                    <input type="hidden" id="is_wfh_permanent_hidden"
                                                                        name="is_wfh_permanent"
                                                                        value="<?php echo $data->is_wfh_permanent; ?>">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="mt-3 d-flex justify-content-end">
                                                            <button type="submit" id="submitBtn"
                                                                class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
                var hiddenInputDownloadSS = document.querySelector('[name="download_ss_hidden"]');
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
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
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
                    },
                },
                errorPlacement: function(error, element) {
                    // error.insertAfter(element);
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
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
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/admin/employee/edit-employee.blade.php ENDPATH**/ ?>