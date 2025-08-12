<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS Admin Leave Details'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                    <div class="d-flex justify-content-end">
                                        <button onclick="goBack()" class="btn btn-primary"><i class="fa fa-arrow-left me-2"
                                                aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h1 class="f-600 f-base">Leave Details</h1>
                                                </div>

                                                <div class="col-md-6">
                                                    <?php if($details[0]->status != 'Pending'): ?>
                                                        <div class="d-flex justify-content-end me-2">
                                                            <?php if($details[0]->status == 'Approve'): ?>
                                                                <h3 class="badge f-20 bg-success">Approved</h3>
                                                            <?php elseif($details[0]->status == 'Reject'): ?>
                                                                <h3 class="badge f-20 bg-warning f-black">Rejected</h3>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <input type="hidden" id="lv_id"
                                                            value="<?php echo e($details[0]->lv_id); ?>">
                                                        <input type="hidden" id="e_id"
                                                            value="<?php echo e($details[0]->e_id); ?>">
                                                        <select name="status" id="status" class="form-select">
                                                            <option value="Pending"
                                                                <?php echo e($details[0]->status == 'Pending' ? 'selected' : ''); ?>>
                                                                Pending</option>
                                                            <option value="Reject"
                                                                <?php echo e($details[0]->status == 'Reject' ? 'selected' : ''); ?>>
                                                                Reject</option>
                                                            <option value="Approve"
                                                                <?php echo e($details[0]->status == 'Approve' ? 'selected' : ''); ?>>
                                                                Approve</option>
                                                            <input type="hidden" id="leave_date"
                                                                value="<?php echo e($details[0]->leave_date); ?>">
                                                        </select>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Leave By :</label>
                                                        <span class="f-18 f-700 f-black ms-2"><?php echo e($details[0]->e_fname); ?>

                                                            <?php echo e($details[0]->e_lname); ?></span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Leave Type :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2"><?php echo e($details[0]->leave_for); ?></span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Leave Date :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2"><?php echo e(date('d-m-Y', strtotime($details[0]->leave_date))); ?></span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Leave Type :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2"><?php echo e($details[0]->leaveName); ?></span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Responsible Person :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2"><?php echo e($details[0]->r_fname); ?>

                                                            <?php echo e($details[0]->r_lname); ?></span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Reason :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2"><?php echo e($details[0]->leave_reason); ?></span>
                                                    </div>
                                                    <?php if($details[0]->document != null): ?>
                                                        <div class="d-flex mt-2">
                                                            <label class="f-18 f-600">Document :</label>
                                                            <a href="<?php echo e(URL('storage/' . $details[0]->document)); ?>"
                                                                target="_blank"><i class="fa fa-eye ms-2 f-black"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                    <?php endif; ?>
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
        // back button
        function goBack() {
            history.go(-1);
        }

        $("#status").on("change", function() {
            $status = $(this).val();
            $id = $('#lv_id').val();
            $e_id = $('#e_id').val();
            $date = $('#leave_date').val();
            $.ajax({
                url: baseUrl() + "/update-leave-status",
                type: "post",
                data: {
                    _token: csrf(),
                    status: $status,
                    lv_id: $id,
                    e_id: $e_id,
                    leave_date: $date,
                },
                success: function(res) {
                    location.reload();
                }
            });
        });
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/admin/leave/leave-details.blade.php ENDPATH**/ ?>