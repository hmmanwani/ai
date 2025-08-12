<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Profile '] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    <div class="container-scroller" id="profile-page">
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
                    
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="">
                                        <div class="card ">
                                            <div class="row">
                                                <div class="col-md-3 pe-0  mb-4">
                                                    <div class="list-group mx-4" id="list-tab" role="tablist">
                                                        <div class="profile-picture d-flex justify-content-center">
                                                            <img src="<?php echo e(URL('assets\images\logo\logo.png')); ?>"
                                                                class="w-50  me-2 my-4 ms-2" alt="">
                                                        </div>
                                                        <h3 class="text-center  f-700">
                                                            <?php echo e(ucfirst(session()->get('emp_login')['fname'])); ?>

                                                            <?php echo e(ucfirst(session()->get('emp_login')['lname'])); ?>

                                                        </h3>
                                                        <a class="list-group-item list-group-item-action active"
                                                            id="personal-details-list" data-bs-toggle="list"
                                                            href="#personal-details" role="tab"
                                                            aria-controls="personal-details">Personal
                                                            Details</a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="address-list" data-bs-toggle="list" href="#address"
                                                            role="tab" aria-controls="address">Address</a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="emergency-contacts-list" data-bs-toggle="list"
                                                            href="#emergency-contact" role="tab"
                                                            aria-controls="emergency-contact">Emergency Contacts</a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="bank-information-list" data-bs-toggle="list"
                                                            href="#bank-information" role="tab"
                                                            aria-controls="bank-information">Bank Information</a>
                                                        <a class="list-group-item list-group-item-action" id="job-list"
                                                            data-bs-toggle="list" href="#job" role="tab"
                                                            aria-controls="job">Job</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 nav-content">
                                                    <div class="tab-content" id="nav-tabContent">
                                                        
                                                        <div class="tab-pane fade show active" id="personal-details"
                                                            role="tabpanel" aria-labelledby="personal-details-list">
                                                            <div class="card ">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Personal Details</h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end">
                                                                            <?php if ($employee->p_details_status == 'Pending') { ?>
                                                                            <p class="f-red align-self-end me-4">Your
                                                                                request is under
                                                                                approval.</p>
                                                                            <?php } ?>
                                                                            <a href="<?php echo e(URL('/edit-personal-details')); ?>/<?php echo e($employee->e_id); ?>"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-pencil f-24 f-white"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <input type="hidden" name="e_id"
                                                                            value="<?php echo e($employee->e_id); ?>">
                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Employee
                                                                                Full
                                                                                Name :</label>
                                                                            <p><?php echo e($employee->fname); ?>

                                                                                <?php echo e($employee->mname); ?>

                                                                                <?php echo e($employee->lname); ?></p>
                                                                        </div>

                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Employee
                                                                                Id :</label>
                                                                            <p>FS-200</p>
                                                                        </div>

                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Date of
                                                                                Birth :</label>
                                                                            <p><?php echo e(date('d-m-Y', strtotime($employee->dob))); ?>

                                                                            </p>
                                                                        </div>

                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label
                                                                                class="control-label  f-700">Nationality
                                                                                :</label>
                                                                            <p><?php echo e($employee->nationality); ?></p>
                                                                        </div>

                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Marital
                                                                                Status :</label>
                                                                            <p><?php echo e($employee->marital_status); ?></p>
                                                                        </div>

                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Gender
                                                                                :</label>
                                                                            <p><?php echo e($employee->gender); ?></p>
                                                                        </div>

                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Blood
                                                                                Types :</label>
                                                                            <p><?php echo e($employee->bloodtype); ?></p>
                                                                        </div>

                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-600">Phone
                                                                                No :</label>
                                                                            <p><?php echo e($employee->phone); ?></p>
                                                                        </div>

                                                                        
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-600">Personal
                                                                                Email :</label>
                                                                            <p><?php echo e($employee->pemail); ?>

                                                                            <p>
                                                                        </div>
                                                                        <?php if($employee->aadhaarcard != null): ?>
                                                                            <div class="col-md-4 form-group">
                                                                                <label
                                                                                    class="control-label f-600">Aadhaar
                                                                                    Card
                                                                                    :</label>
                                                                                <a href="<?php echo e(URL('storage/' . $employee->aadhaarcard)); ?>"
                                                                                    target="_blank"><i
                                                                                        class="fa fa-eye ms-2 f-black"
                                                                                        aria-hidden="true"></i></a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Education Qualification
                                                                            </h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end align-items-center">
                                                                            <a href="<?php echo e(URL('/add-education-qualification')); ?>"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-plus f-24 f-white"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>

                                                                    <div class="row">
                                                                        <?php if($education_qualifications->isEmpty()): ?>
                                                                            <div class="col-md-12">
                                                                                <h3>Please add qualifications.</h3>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <?php $__currentLoopData = $education_qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education_qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="col-md-4">
                                                                                    <label
                                                                                        class="control-label f-900"></label>
                                                                                    <p><?php echo e($education_qualification->qualification); ?>

                                                                                    </p>
                                                                                    <hr>
                                                                                </div>
                                                                                <div
                                                                                    class="col-md-8 d-flex justify-content-end align-items-center">
                                                                                    <?php if ($education_qualification->status == 'Pending') { ?>
                                                                                    <p
                                                                                        class="f-red align-self-center me-2">
                                                                                        Your
                                                                                        request is under
                                                                                        approval.</p>
                                                                                    <?php } ?>
                                                                                    <a href="<?php echo e(URL('/edit-education-qualification')); ?>/<?php echo e($education_qualification->edq_id); ?>"
                                                                                        class="btn btn-primary p-1">
                                                                                        <i class="fa fa-pencil f-16 f-white"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="row mb-0">
                                                                                    <div class="col-md-4 form-group">
                                                                                        <label
                                                                                            class="control-label f-700">University
                                                                                            Name:</label>
                                                                                        <p><?php echo e($education_qualification->university_name); ?>

                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-md-4 form-group">
                                                                                        <label
                                                                                            class="control-label f-700">Starting
                                                                                            Year:</label>
                                                                                        <p><?php echo e(date('m-Y', strtotime($education_qualification->starting_year))); ?>

                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-md-4 form-group">
                                                                                        <label
                                                                                            class="control-label f-700">Ending
                                                                                            Year:</label>
                                                                                        <p><?php echo e(date('m-Y', strtotime($education_qualification->ending_year))); ?>

                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="tab-pane fade" id="address" role="tabpanel"
                                                            aria-labelledby="address-list">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Address
                                                                            </h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end align-items-center">
                                                                            <a href="<?php echo e(URl('/add-address')); ?>"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-plus f-24 f-white"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <?php if($addresses->isEmpty()): ?>
                                                                        <div class="col-md-12">
                                                                            <h3>Please add your address.</h3>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div class="border p-3 mb-3 p-relative"
                                                                                style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <p
                                                                                            class="f-20 f-black mb-2 f-600">
                                                                                            <?php echo e($address->address_type); ?>

                                                                                            :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-md-11 form-group d-flex ">
                                                                                        <h3><?php echo e($address->apartment_no); ?>,
                                                                                            <?php echo e($address->apartment_name); ?>,
                                                                                            <?php echo e($address->area); ?>,
                                                                                            <?php echo e($address->city); ?>,
                                                                                            <?php echo e($address->state); ?>,
                                                                                            <?php echo e($address->country); ?>,
                                                                                            <?php echo e($address->postal_code); ?>

                                                                                        </h3>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-end">
                                                                                        <a href="<?php echo e(URL('/edit-address')); ?>/<?php echo e($address->ad_id); ?>"
                                                                                            class="btn btn-primary p-1">
                                                                                            <i class="fa fa-pencil f-16 f-white"
                                                                                                aria-hidden="true"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                    <?php if ($address->status == 'Pending') { ?>
                                                                                    <p
                                                                                        class="f-red align-self-center ">
                                                                                        Your
                                                                                        request is under
                                                                                        approval.</p>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="tab-pane fade" id="emergency-contact"
                                                            role="tabpanel" aria-labelledby="emergency-contacts-list">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Emergency Contacts
                                                                            </h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end">
                                                                            <a href="<?php echo e(URL('/add-emergency-contect')); ?>"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-plus f-24 f-white"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="mt-2">
                                                                    <div class="row">
                                                                        <?php if($emergencycontactes->isEmpty()): ?>
                                                                            <div class="col-md-12">
                                                                                <h3>Please add contacts details.
                                                                                </h3>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <?php $__currentLoopData = $emergencycontactes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emergencycontact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="col-md-6">
                                                                                    <p class="f-18 f-700">
                                                                                        Person <?php echo e($loop->iteration); ?>:
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-6 text-end">
                                                                                    <?php if ($emergencycontact->status == 'Pending') { ?>
                                                                                    <p class="f-red  ">
                                                                                        Your
                                                                                        request is under
                                                                                        approval.</p>
                                                                                    <?php } ?>
                                                                                </div>

                                                                                <hr>
                                                                                <div class="col-md-4 form-group mt-3">
                                                                                    <label class="control-label f-600">
                                                                                        Name:</label>
                                                                                    <p><?php echo e($emergencycontact->name); ?>

                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-4 form-group mt-3">
                                                                                    <label
                                                                                        class="control-label f-600">Relationship</label>
                                                                                    <p><?php echo e($emergencycontact->relationship); ?>

                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-3 form-group mt-3">
                                                                                    <label
                                                                                        class="control-label f-600">Mobile</label>
                                                                                    <p><?php echo e($emergencycontact->phone); ?>

                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-1 text-end">
                                                                                    <a href="<?php echo e(URL('/edit-emergency-contact')); ?>/<?php echo e($emergencycontact->ec_id); ?>"
                                                                                        class="btn btn-primary p-1">
                                                                                        <i class="fa fa-pencil f-16 f-white"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="tab-pane fade" id="bank-information"
                                                            role="tabpanel" aria-labelledby="bank-information-list">
                                                            <div class="card ">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Bank Information</h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end">

                                                                            <?php if(is_null($bankinformation)): ?>
                                                                                <a href="<?php echo e(URL('/add-bank-information')); ?>"
                                                                                    class="btn btn-primary">
                                                                                    <i class="fa fa-plus f-24 f-white"
                                                                                        aria-hidden="true"></i>
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <?php if(is_null($bankinformation)): ?>
                                                                            <div class="col-md-12">
                                                                                <h3>Please add the Bank Information.
                                                                                </h3>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <?php if ($bankinformation->status == 'Pending') { ?>
                                                                            <p class="f-red align-self-center ">
                                                                                Your
                                                                                request is under
                                                                                approval.</p>
                                                                            <?php } ?>
                                                                            <div class="row">
                                                                                <div class="col-md-11">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">Bank
                                                                                                Name:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p><?php echo e($bankinformation->bank_name); ?>

                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">Branch:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p><?php echo e($bankinformation->branch); ?>

                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">Account
                                                                                                No:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p><?php echo e($bankinformation->account_no); ?>

                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">IFSC
                                                                                                Code:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p><?php echo e($bankinformation->ifsc_code); ?>

                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">Pan
                                                                                                Card No:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p><?php echo e($bankinformation->pan_no); ?>

                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">UAN
                                                                                                No:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p><?php echo e($bankinformation->uan_no); ?>

                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">PF
                                                                                                No:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p><?php echo e($bankinformation->pf_no); ?>

                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    <a href="<?php echo e(URL('/edit-bank-information')); ?>/<?php echo e($bankinformation->bi_id); ?>"
                                                                                        class="btn btn-primary">
                                                                                        <i class="fa fa-pencil f-24 f-white"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="tab-pane fade" id="job" role="tabpanel"
                                                            aria-labelledby="job-list">
                                                            <div class="card ">
                                                                <div class="card-body">
                                                                    <div class="heading">
                                                                        <h2>Job Details</h2>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Joined
                                                                                Date :</label>
                                                                            <p><?php echo e(date('d-m-Y', strtotime($employee->join_date))); ?>

                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Job
                                                                                Category :</label>
                                                                            <p><?php echo e($employee->team); ?></p>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Job
                                                                                Title :</label>
                                                                            <p><?php echo e($employee->designation); ?></p>
                                                                        </div>
                                                                        <div class="col-md-4 form-group d-none">
                                                                            <label
                                                                                class="control-label f-700">Experience</label>
                                                                            <p><?php echo e($employee->emp_experience); ?>

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        // contact details
        $(document).ready(function() {
            if (window.location.hash === "#address") {
                var contactDetailsTab = new bootstrap.Tab($('#address-list')[0]);
                contactDetailsTab.show();
            }
        });
        // Emergency Contact
        $(document).ready(function() {
            if (window.location.hash === "#emergency-contacts") {
                var contactDetailsTab = new bootstrap.Tab($('#emergency-contacts-list')[0]);
                contactDetailsTab.show();
            }
        });
        // Bank Infromation
        $(document).ready(function() {
            if (window.location.hash === "#bank-information") {
                var contactDetailsTab = new bootstrap.Tab($('#bank-information-list')[0]);
                contactDetailsTab.show();
            }
        });
    </script>

</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/profile/profile.blade.php ENDPATH**/ ?>