<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'Employee Salary'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    
                    <section id="">
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
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h1 class= "">Salary</h1>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <button onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="<?php echo e(url('/update-salary')); ?>" method="post"
                                                        id="myForm">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">

                                                            
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="start_date">Start
                                                                        Date</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="start_date"
                                                                            name="start_date" class="form-control"
                                                                            required
                                                                            value="<?= @$sDetails->start_date ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="end_date">End
                                                                        Date</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="end_date"
                                                                            name="end_date" class="form-control"
                                                                            value="<?= @$sDetails->end_date ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="amount">Salary</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="amount"
                                                                            name="amount" class="form-control"
                                                                            value="<?= @$sDetails->amount ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-2 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="tds">TDS (in
                                                                        %)</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="tds"
                                                                            name="tds" class="form-control"
                                                                            value="<?= @$sDetails->tds ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="pt">Professional
                                                                        Tax</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="pt"
                                                                            name="pt" class="form-control"
                                                                            value="<?= @$sDetails->pt ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="allowance">Allowance</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="allowance"
                                                                            name="allowance" class="form-control"
                                                                            value="<?= @$sDetails->allowance ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-4 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="bonus">Bonus</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="bonus"
                                                                            name="bonus" class="form-control"
                                                                            value="<?= @$sDetails->bonus ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3 d-flex justify-content-end">
                                                            <input type="hidden" name="e_id" value="<?= $e_id ?>">
                                                            <button type="submit"
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
        function goBack() {
            history.go(-1);
        }

        $("#start_date").flatpickr({
            dateFormat: "Y-m-d",
            // maxDate: "today",
        });
        $("#end_date").flatpickr({
            dateFormat: "Y-m-d",
            // maxDate: "today",
        });
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/admin/employee/salary.blade.php ENDPATH**/ ?>