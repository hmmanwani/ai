<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Daily Work Report'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card f-black">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="f-700">Daily Work Report</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="<?php echo e(URL('add-work-report')); ?>" class="me-2">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-plus me-2"
                                                                aria-hidden="true"></i>Add</button></a>
                                                    <?php if($show_project_task == 1): ?>
                                                        <a href="<?php echo e(URL('internal-team-access')); ?>">
                                                            <button type="button" class="btn btn-primary">
                                                                <i class="fa fa-users"
                                                                    aria-hidden="true"></i></button></a>
                                                        <a href="<?php echo e(URL('work-email-setting')); ?>" class="ms-2">
                                                            <button type="button" class="btn btn-primary">
                                                                <i class="fa fa-cog"
                                                                    aria-hidden="true"></i></button></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row mb-5">
                                                        <?php if($emp && !$emp->isEmpty()): ?>
                                                            <div class="col-md-6">
                                                                <label for="name" class="f-black f-18 f-700">Select
                                                                    Employee:</label>
                                                                <select class="form-select mt-2 " id="Empdata"
                                                                    aria-label="Default select example">
                                                                    <option value="">Select Employee
                                                                    </option>
                                                                    <?php $__currentLoopData = $emp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option class="f-18"
                                                                            value="<?php echo e($emps->e_id); ?>">
                                                                            <?php echo e($emps->full_name); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="f-black f-18 f-700">Select
                                                                    Date</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="date" name="date"
                                                                        class="form-control" title="Leave Date"
                                                                        placeholder="d-m-Y">
                                                                </div>
                                                            </div>
                                                        </div>
                                                                <div
                                                                    class="col-md-6 d-flex align-items-center justify-content-center">
                                                        <div class="form-group mb-0">
                                                            <div class="Sreach">
                                                                <a href="javascript:void(0)" id="search"
                                                                    class="btn btn-skyblue f-black">Search</a>
                                                                <a onclick="reload()" id="reset"
                                                                    class="btn btn-danger f-black">Reset</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table id="Worklist"
                                                            class="table table-bordered table-striped f-black">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>No.</th>
                                                                    <th>Name</th>
                                                                    <th>Team</th>
                                                                    <th>Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="WorkDetails">

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
        $(document).on('click', '#reset', function() {
            $('#WorkDetails').html('');
        });
        $(document).on('click', '#search', function() {
            $('#WorkDetails').html('');
        });

        $(document).on('click', 'a[id^="Work-details_"]', function() {
            var id = $(this).data('id');
            var date = $(this).data('date');

            $.ajax({
                url: '<?php echo e(url('work-info')); ?>', // Make sure the route is correct
                method: 'POST',
                data: {
                    id: id,
                    date: date,
                    _token: '<?php echo e(csrf_token()); ?>'
                },

                success: function(response) {
                    if (response.data && response.data.length > 0) {
                        var htmlContent = '';
                        // Loop through the response data array
                        response.data.forEach(function(item) {
                            htmlContent += `
                                <div class="record" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 5px; position: relative;">
                                    <div style="position: absolute; top: -7px; left: 70%; background: white; padding: 0 5px; font-weight: bold;">
                                        ${item.formatted_created_at}
                                    </div>
                                    <div style="padding-top: 20px;">${item.description}</div>
                                </div>`;
                        });

                        $('#WorkDetails').html(htmlContent);
                    } else {
                        $('#WorkDetails').html('<p>No data available for the selected date.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('#WorkDetails').html('<p>Something went wrong. Please try again later.</p>');
                }
            });
        });
    </script>
    <script>
        $("#date").flatpickr({
            dateFormat: "d-m-Y",
        });
    </script>
    <script>
        $(document).ready(function() {
            assignData();
        });
        $('#search').click(function() {
            assignData();
        });

        function reload() {
            $('#Empdata').val('');
            $('#date').val('');
            assignData();
            // toggleResetButton();
        }

        function assignData() {
            $('#Worklist').DataTable().destroy();
            let filter = {};
            filter['e_id'] = $('#Empdata').val();
            filter['date'] = $('#date').val();
            ajaxDataTableInit(baseUrl() + '/get-work-list', 'Worklist', 0, 0, filter);
        }
    </script>
    
</body>

</html>


<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/project/daily-work-report/daily-work-report.blade.php ENDPATH**/ ?>