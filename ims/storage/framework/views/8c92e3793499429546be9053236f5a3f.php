<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Task Details'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                    <div class="card">
                                        <div class="card-header">
                                            <div div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="f-700 f-black">Task Details </h2>
                                                </div>

                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <?php if(in_array($empLogin,json_decode($data->assign_task)) && $data->status == 'complete' ){ ?>
                                                        <span class="badge bg-success me-4 d-flex align-self-center f-20">Complete</span>
                                                    <?php }else{ ?>
                                                    <div class="me-3 d-flex align-items-center ">
                                                        <form action="<?php echo e(URL('update-task-status')); ?>" method="POST"
                                                            class="h-50px" id="taskStatusForm">
                                                            <div class="form-group">
                                                                <input type="hidden" value="<?php echo e($data->tm_id); ?>"
                                                                    name="id" id="taskId">
                                                                <select name="status" id="status"
                                                                    class="form-select select3">
                                                                    <option value="to_do"
                                                                        <?php echo e($data->status == 'to_do' ? 'selected' : ''); ?>>
                                                                        to_do
                                                                    </option>
                                                                    <option value="in_progress"
                                                                        <?php echo e($data->status == 'in_progress' ? 'selected' : ''); ?>>
                                                                        in_progress</option>
                                                                    <option value="hold"
                                                                        <?php echo e($data->status == 'hold' ? 'selected' : ''); ?>>
                                                                        hold
                                                                    </option>
                                                                    <option value="complete"
                                                                        <?php echo e($data->status == 'complete' ? 'selected' : ''); ?>>
                                                                        complete</option>
                                                                </select>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <?php } ?>
                                                    <button onclick="goBack()" class="btn btn-primary task-detail-back"><i
                                                            class="fa fa-arrow-left f-20" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-md-12 mb-3">
                                                    <div class="mt-2 d-flex">
                                                        <label class="control-label f-18  f-600">Task Title
                                                            :</label>
                                                        <p class="f-20 f-black ms-1 f-700">
                                                            <?php echo e($data->task_title); ?>

                                                        </p>
                                                    </div>
                                                </div>

                                                
                                                <?php if($data->project_title != null): ?>
                                                    <div class="col-md-12 ">
                                                        <div class="mt-2">
                                                            <label class="control-label f-18  f-600">
                                                                Project :</label>
                                                            <p class="f-20 f-black f-700">
                                                                <?php echo e($data->project_title); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                
                                                <div class="col-md-3">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18 f-600">Task Type:</label>
                                                        <p class="f-20 f-black f-700">
                                                            <?php if($data->task_type == 0): ?>
                                                                Project Task
                                                            <?php elseif($data->task_type == 1): ?>
                                                                Individual Task
                                                            <?php elseif($data->task_type == 2): ?>
                                                                Other Task
                                                            <?php else: ?>
                                                                Unknown Task Type
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                
                                                <div class="col-md-3">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18  f-600">Assign By
                                                            :</label>
                                                        <p class="f-20 f-black f-700">
                                                            <?php echo e($data->fname); ?> <?php echo e($data->lname); ?>

                                                        </p>
                                                    </div>
                                                </div>

                                                
                                                <div class="col-md-3">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18  f-600">Deadline
                                                            :</label>
                                                        <p class="f-20 f-black f-700">
                                                            <?php echo e($data->deadline); ?>

                                                        </p>
                                                    </div>
                                                </div>

                                                
                                                <?php if($data->complete_date != null): ?>
                                                    <div class="col-md-3">
                                                        <div class="mt-2">
                                                            <label class="control-label f-18  f-600">Complete Date
                                                                :</label>
                                                            <p class="f-20 f-black f-700">
                                                                <?php echo e($data->complete_date); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                
                                                <div class="col-md-12 mt-4">
                                                    <div class="form-group">
                                                        <label class="control-label f-18  f-600">Project
                                                            Description</label>
                                                        <div class="f-20 f-black f-700" id="taskdetails_description">
                                                            <?php echo $data->task_description; ?> </div>
                                                    </div>
                                                </div>

                                                
                                                <?php if($data->comment != null): ?>
                                                    <div class="col-md-3">
                                                        <div class="mt-2">
                                                            <label class="control-label f-18  f-600">Comment
                                                                :</label>
                                                            <p class="f-20 f-black f-700">
                                                                <?php echo e($data->comment); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                
                                                <?php if($show == 1): ?>
                                                    <form action="<?php echo e(URL('submit-task-comment')); ?>" method="POST"
                                                        id="myForm">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label f-18  f-600">comment</label>
                                                                <textarea type="text" id="comment" name="comment" class="form-control  h-100" rows="3"
                                                                    value="<?php echo e($data->comment); ?>" placeholder="Enter Your Comments"></textarea>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id"
                                                            value="<?php echo e($data->tm_id); ?>">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                <?php endif; ?>
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
    </script>
    <script>
        $('.select3').select2({
            placeholder: "-Select -",
            tags: true,
            allowClear: true,
            minimumResultsForSearch: Infinity,
        });
        $('#status').on('change', function() {
            var status = $(this).val();
            var id = $('#taskId').val();

            $.ajax({
                url: "<?php echo e(URL('update-task-status')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    status: status,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    console.log('Task status updated successfully:', response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error updating task status:', error);
                }
            });
        });
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/task/task-details.blade.php ENDPATH**/ ?>