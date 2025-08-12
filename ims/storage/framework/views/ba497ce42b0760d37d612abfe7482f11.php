<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Admin Employee Details'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    
                    <section id="overview">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <?php if (isset($component)) { $__componentOriginal5dbcd2c5f624951ffc95c729c55bdb11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5dbcd2c5f624951ffc95c729c55bdb11 = $attributes; } ?>
<?php $component = App\View\Components\AdminSidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminSidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5dbcd2c5f624951ffc95c729c55bdb11)): ?>
<?php $attributes = $__attributesOriginal5dbcd2c5f624951ffc95c729c55bdb11; ?>
<?php unset($__attributesOriginal5dbcd2c5f624951ffc95c729c55bdb11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5dbcd2c5f624951ffc95c729c55bdb11)): ?>
<?php $component = $__componentOriginal5dbcd2c5f624951ffc95c729c55bdb11; ?>
<?php unset($__componentOriginal5dbcd2c5f624951ffc95c729c55bdb11); ?>
<?php endif; ?>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-end ">
                                        <button onclick="goBack()" class="btn btn-primary"><i
                                                class="fa fa-arrow-left me-2" aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class= "f-600">Employee Details</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end align-self-center">
                                                    <label class="control-label f-18 f-600">Emp Id :</label>
                                                    <p class="f-18 ms-2  f-20 f-black f-800">
                                                        <?php echo e($details->empid); ?> </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="border p-3 mb-3 p-relative"
                                                style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <?php if($details->p_details_status === 'Pending'): ?>
                                                            <span class="badge badge-warning peronal-d-old">Old</span>
                                                            <!-- Badge for old info -->
                                                        <?php endif; ?>
                                                        <div class="mt-2">
                                                            <label class="control-label f-20 f-600">Employee Name
                                                                :</label>
                                                            <p class="f-18"><?php echo e($details->fname); ?>

                                                                <?php echo e($details->mname); ?>

                                                                <?php echo e($details->lname); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Date of Birth
                                                                :</label>
                                                            <p class="f-18">
                                                                <?php echo e(date('d-m-Y', strtotime($details->dob))); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Nationality
                                                                :</label>
                                                            <p class="f-18"><?php echo e($details->nationality); ?> </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Marital Status
                                                                :</label>
                                                            <p class="f-18"><?php echo e($details->marital_status); ?> </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Gender :</label>
                                                            <p class="f-18"><?php echo e($details->gender); ?> </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Blood Types
                                                                :</label>
                                                            <p class="f-18"><?php echo e($details->bloodtype); ?> </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Phone Number
                                                                :</label>
                                                            <p class="f-18"><?php echo e($details->phone); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Personal Email
                                                                :</label>
                                                            <p class="f-18"><?php echo e($details->pemail); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class="mt-2">
                                                            <label class="control-label f-20 f-600">Aadhaar Card
                                                                :</label>
                                                            <?php if($details->aadhaarcard != null): ?>
                                                                <p class="f-18"> <a
                                                                        href="<?php echo e(URL('storage/' . $details->aadhaarcard)); ?>"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye ms-2 f-black"
                                                                            aria-hidden="true"></i></a>
                                                                </p>
                                                            <?php else: ?>
                                                                <p>-</p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $__currentLoopData = $details_change; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp_change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($details->e_id == $emp_change->e_id): ?>
                                                        <hr>
                                                        <div class="row">
                                                            <span class="badge badge-success peronal-d-new">New</span>
                                                            <div class="col-md-4">
                                                                <div class="mt-2">
                                                                    <label class="control-label f-20 f-600">Employee
                                                                        Name
                                                                        :</label>
                                                                    <p class="f-18"><?php echo e($emp_change->fname); ?>

                                                                        <?php echo e($emp_change->mname); ?>

                                                                        <?php echo e($emp_change->lname); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Date of
                                                                        Birth
                                                                        :</label>
                                                                    <p class="f-18">
                                                                        <?php echo e(date('d-m-Y', strtotime($emp_change->dob))); ?>

                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Nationality
                                                                        :</label>
                                                                    <p class="f-18"><?php echo e($emp_change->nationality); ?>

                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Marital
                                                                        Status
                                                                        :</label>
                                                                    <p class="f-18"><?php echo e($emp_change->marital_status); ?>

                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Gender
                                                                        :</label>
                                                                    <p class="f-18"><?php echo e($emp_change->gender); ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Blood Types
                                                                        :</label>
                                                                    <p class="f-18"><?php echo e($emp_change->bloodtype); ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Phone Number
                                                                        :</label>
                                                                    <p class="f-18"><?php echo e($emp_change->phone); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class="mt-2">
                                                                    <label class="control-label f-20 f-600">Personal
                                                                        Email
                                                                        :</label>
                                                                    <p class="f-18"><?php echo e($emp_change->pemail); ?>

                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class="mt-2">
                                                                    <label class="control-label f-20 f-600">Aadhaar
                                                                        Card
                                                                        :</label>
                                                                    <p class="f-18"> <a
                                                                            href="<?php echo e(URL('storage/' . $emp_change->aadhaarcard)); ?>"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye ms-2 f-black"
                                                                                aria-hidden="true"></i></a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-12 d-flex align-items-end justify-content-end">
                                                                <span
                                                                    class="badge badge-success personal-details-badge me-2"
                                                                    data-status="approve"
                                                                    data-id=<?php echo e($emp_change->e_id); ?>>
                                                                    <i class="fa fa-check f-14"
                                                                        aria-hidden="true"></i>
                                                                </span>
                                                                <span class="badge badge-danger personal-details-badge"
                                                                    data-status="reject"
                                                                    data-id=<?php echo e($emp_change->e_id); ?>>
                                                                    <i class="fa fa-times f-14"
                                                                        aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <hr>

                                            
                                            <div class="row">
                                                <h2 class="f-600">Education Qualification</h2>
                                            </div>
                                            <hr>
                                            <?php $__currentLoopData = $eduction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="border p-3 mb-3 p-relative"
                                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                    <div class="row mt-3">
                                                        <div class="col-md-4 p-relative">
                                                            <?php if($qualification->status === 'Pending'): ?>
                                                                <span
                                                                    class="badge badge-warning education-badge-old">Old</span>
                                                                <!-- Badge for old info -->
                                                            <?php endif; ?>
                                                            <div class=" mt-2">
                                                                <label class="control-label f-20 f-600">Qualification
                                                                    :</label>
                                                                <p class="f-18 mt-2">
                                                                    <?php echo e($qualification->qualification); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class=" mt-2">
                                                                <label class="control-label f-20 f-600">University Name
                                                                    :</label>
                                                                <p class="f-18 mt-2">
                                                                    <?php echo e($qualification->university_name); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class=" mt-2">
                                                                <label class="control-label f-20 f-600">Starting Year
                                                                    :</label>
                                                                <p class="f-18 mt-2">
                                                                    <?php echo e(date('m-Y', strtotime($qualification->starting_year))); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <div class=" mt-2">
                                                                <label class="control-label f-20 f-600">Ending Year
                                                                    :</label>
                                                                <p class="f-18 mt-2">
                                                                    <?php echo e(date('m-Y', strtotime($qualification->ending_year))); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $__currentLoopData = $education_changes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edq_change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($qualification->edq_id === $edq_change->edq_id): ?>
                                                            <hr>
                                                            <div class="row mt-3">
                                                                <div class="col-md-4 p-relative">
                                                                    <span
                                                                        class="badge badge-success education-badge-new">New</span>
                                                                    <div class=" mt-2">
                                                                        <label
                                                                            class="control-label f-20 f-600">Qualification
                                                                            :</label>
                                                                        <p class="f-18 mt-2">
                                                                            <?php echo e($edq_change->qualification); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class=" mt-2">
                                                                        <label
                                                                            class="control-label f-20 f-600">University
                                                                            Name
                                                                            :</label>
                                                                        <p class="f-18 mt-2">
                                                                            <?php echo e($edq_change->university_name); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class=" mt-2">
                                                                        <label
                                                                            class="control-label f-20 f-600">Starting
                                                                            Year
                                                                            :</label>
                                                                        <p class="f-18 mt-2">
                                                                            <?php echo e($edq_change->starting_year); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 ">
                                                                    <div class=" mt-2">
                                                                        <label class="control-label f-20 f-600">Ending
                                                                            Year
                                                                            :</label>
                                                                        <p class="f-18 mt-2">
                                                                            <?php echo e($edq_change->ending_year); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-8 d-flex align-items-end justify-content-end">
                                                                    <span
                                                                        class="badge badge-success education-badge me-2"
                                                                        data-status="approve"
                                                                        data-id=<?php echo e($edq_change->edq_id); ?>>
                                                                        <i class="fa fa-check f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <span class="badge badge-danger education-badge"
                                                                        data-status="reject"
                                                                        data-id=<?php echo e($edq_change->edq_id); ?>>
                                                                        <i class="fa fa-times f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <hr>
                                            
                                            <div class="row">
                                                <h2 class="f-600">Address</h2>
                                            </div>
                                            <hr>

                                            <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="border p-3 mb-3 p-relative"
                                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="f-20 f-black mb-2 f-600">
                                                                <?php echo e($address->address_type); ?>

                                                                :
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12 ">
                                                            <?php if($address->status == 'Pending'): ?>
                                                                <span
                                                                    class="badge badge-warning address-badge-old">Old</span>
                                                                <!-- Badge for old info -->
                                                            <?php endif; ?>
                                                            <div class="mt-2">
                                                                <p class="f-20"><?php echo e($address->apartment_no); ?>,
                                                                    <?php echo e($address->apartment_name); ?>,
                                                                    <?php echo e($address->area); ?>,
                                                                    <?php echo e($address->city); ?>,
                                                                    <?php echo e($address->state); ?>,
                                                                    <?php echo e($address->country); ?>,
                                                                    <?php echo e($address->postal_code); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php $__currentLoopData = $addresses_changes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($address->ad_id == $add_change->ad_id): ?>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="f-20 f-black mb-2 f-600">
                                                                        <?php echo e($add_change->address_type); ?>

                                                                        :
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <span
                                                                        class="badge badge-warning address-badge-new">New</span>
                                                                    <div class="mt-2">
                                                                        <p class="f-20">
                                                                            <?php echo e($add_change->apartment_no); ?>,
                                                                            <?php echo e($add_change->apartment_name); ?>,
                                                                            <?php echo e($add_change->area); ?>,
                                                                            <?php echo e($add_change->city); ?>,
                                                                            <?php echo e($add_change->state); ?>,
                                                                            <?php echo e($add_change->country); ?>,
                                                                            <?php echo e($add_change->postal_code); ?></p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-1 d-flex align-items-end justify-content-end">
                                                                    <span
                                                                        class="badge badge-success address-badge me-2"
                                                                        data-status="approve"
                                                                        data-id=<?php echo e($add_change->ad_id); ?>>
                                                                        <i class="fa fa-check f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <span class="badge badge-danger address-badge"
                                                                        data-status="reject"
                                                                        data-id=<?php echo e($add_change->ad_id); ?>>
                                                                        <i class="fa fa-times f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <hr>
                                            
                                            <div class="row">
                                                <h2 class="f-600">Emergency Contacts</h2>
                                            </div>
                                            <hr>

                                            <?php $__currentLoopData = $contects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="border p-3 mb-3"
                                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                    <div class="row">
                                                        <div class="col-md-4 p-relative">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Name
                                                                    :</label>
                                                                <p class="f-18">
                                                                    <?php echo e($contect->name); ?>

                                                                    <?php if($contect->status === 'Pending'): ?>
                                                                        <span
                                                                            class="badge badge-warning emp-details-badge-old">Old</span>
                                                                        <!-- Badge for old info -->
                                                                    <?php endif; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Relationship
                                                                    :</label>
                                                                <p class="f-18"><?php echo e($contect->relationship); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Mobile
                                                                    :</label>
                                                                <p class="f-18"><?php echo e($contect->phone); ?></p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <?php $__currentLoopData = $contects_changes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($contect->ec_id === $change->ec_id): ?>
                                                            <div class="row mt-2">
                                                                <div class="col-md-4 p-relative">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">
                                                                            Name :</label>
                                                                        <p class="f-18"><?php echo e($change->name); ?>

                                                                            <span
                                                                                class="badge badge-success emp-details-badge-new">New</span>
                                                                        </p> <!-- Badge for new info -->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">
                                                                            Relationship :</label>
                                                                        <p class="f-18">
                                                                            <?php echo e($change->relationship); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="mt-2">
                                                                                <label
                                                                                    class="control-label f-20 f-600">
                                                                                    Mobile :</label>
                                                                                <p class="f-18">
                                                                                    <?php echo e($change->phone); ?>

                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col d-flex align-items-end">
                                                                            <span
                                                                                class="badge badge-success emp-details-badge me-2"
                                                                                data-status="approve"
                                                                                data-id=<?php echo e($change->ec_id); ?>>
                                                                                <i class="fa fa-check f-14"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                            <span
                                                                                class="badge badge-danger emp-details-badge"
                                                                                data-status="reject"
                                                                                data-id=<?php echo e($change->ec_id); ?>>
                                                                                <i class="fa fa-times f-14"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <hr>

                                            
                                            <div class="row">
                                                <h2 class="f-600">Bank Information</h2>
                                            </div>
                                            <hr>
                                            <?php if($bank): ?>
                                                <div class="border p-3 mb-3"
                                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                    <div class="row">
                                                        <div class="col-md-4 p-relative">
                                                            <?php if($bank->status === 'Pending'): ?>
                                                                <span
                                                                    class="badge badge-warning bank-info-old">Old</span>
                                                                <!-- Badge for old info -->
                                                            <?php endif; ?>
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Bank
                                                                    Name:</label>
                                                                <p class="f-18"><?php echo e($bank->bank_name); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Branch:</label>
                                                                <p class="f-18"><?php echo e($bank->branch); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Account
                                                                    Number:</label>
                                                                <p class="f-18"><?php echo e($bank->account_no); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">IFSC
                                                                    Code:</label>
                                                                <p class="f-18"><?php echo e($bank->ifsc_code); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Pan
                                                                    Number:</label>
                                                                <p class="f-18"><?php echo e($bank->pan_no); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">UAN
                                                                    Number:</label>
                                                                <p class="f-18"><?php echo e($bank->uan_no); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">PF
                                                                    Number:</label>
                                                                <p class="f-18"><?php echo e($bank->pf_no); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $__currentLoopData = $bank_changes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b_change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($bank->e_id === $b_change->e_id): ?>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-4 p-relative">
                                                                    <span
                                                                        class="badge badge-success bank-in-new">New</span>
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">Bank
                                                                            Name:</label>
                                                                        <p class="f-18">
                                                                            <?php echo e($b_change->bank_name); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mt-2">
                                                                        <label
                                                                            class="control-label f-20 f-600">Branch:</label>
                                                                        <p class="f-18"><?php echo e($b_change->branch); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">Account
                                                                            Number:</label>
                                                                        <p class="f-18">
                                                                            <?php echo e($b_change->account_no); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 mt-3">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">IRSC
                                                                            Code:</label>
                                                                        <p class="f-18">
                                                                            <?php echo e($b_change->ifsc_code); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 mt-3">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">Pan
                                                                            Number:</label>
                                                                        <p class="f-18"><?php echo e($b_change->pan_no); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 mt-3">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">UAN
                                                                            Number:</label>
                                                                        <p class="f-18"><?php echo e($b_change->uan_no); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 mt-3">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">PF
                                                                            Number:</label>
                                                                        <p class="f-18"><?php echo e($b_change->pf_no); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-8 d-flex align-items-end justify-content-end">
                                                                    <span
                                                                        class="badge badge-success bank-info-badge me-2"
                                                                        data-status="approve"
                                                                        data-id=<?php echo e($b_change->e_id); ?>>
                                                                        <i class="fa fa-check f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <span class="badge badge-danger bank-info-badge"
                                                                        data-status="reject"
                                                                        data-id=<?php echo e($b_change->e_id); ?>>
                                                                        <i class="fa fa-times f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php else: ?>
                                                <p>No bank information available.</p>
                                            <?php endif; ?>

                                            <hr>
                                            
                                            <h2 class="f-600">Job Details</h2>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class=" mt-2">
                                                        <label class="control-label f-20 f-600">Joined Date
                                                            :</label>
                                                        <p class="f-18">
                                                            <?php echo e(date('d-m-Y', strtotime($details->join_date))); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class=" mt-2">
                                                        <label class="control-label f-20 f-600">Job Category
                                                            :</label>
                                                        <p class="f-18"><?php echo e($details->team); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class=" mt-2">
                                                        <label class="control-label f-20 f-600">Job Title
                                                            :</label>
                                                        <p class="f-18"><?php echo e($details->designation); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-4">
                                                    <div class=" mt-2">
                                                        <label class="control-label f-20 f-600">Experience
                                                            :</label>
                                                        <p class="f-18"><?php echo e($details->emp_experience); ?></p>
                                                    </div>
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
            $(document).on('click', '.personal-details-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/change-personal-details',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $(document).on('click', '.address-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/address-details-update',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $(document).on('click', '.education-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/education-details',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $(document).on('click', '.emp-details-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/change-emergency-contacts',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

    
    <script>
        $(document).ready(function() {
            $(document).on('click', '.bank-info-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/bank-info-change',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        function goBack() {
            history.go(-1);
        }
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/admin/employee/employee-details.blade.php ENDPATH**/ ?>