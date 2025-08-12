<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Edit Task'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    
                    <form action="<?php echo e(URL('submit-edit-task')); ?>" method="POST" id="myForm">

                    <section id="EditTask">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="f-700 f-black">Edit <?php echo e($task_type); ?></h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <div class="me-3 d-flex align-items-center ">
                                                        
                                                            <div class="form-group">
                                                                <input type="hidden" value="<?php echo e($task->tm_id); ?>"
                                                                    name="id" id="taskId">
                                                                <select name="status" id="status"
                                                                    class="form-select select3">
                                                                    <option value="to_do"
                                                                        <?php echo e($task->status == 'to_do' ? 'selected' : ''); ?>>
                                                                        to_do
                                                                    </option>
                                                                    <option value="in_progress"
                                                                        <?php echo e($task->status == 'in_progress' ? 'selected' : ''); ?>>
                                                                        in_progress</option>
                                                                    <option value="hold"
                                                                        <?php echo e($task->status == 'hold' ? 'selected' : ''); ?>>
                                                                        hold
                                                                    </option>
                                                                    <option value="complete"
                                                                        <?php echo e($task->status == 'complete' ? 'selected' : ''); ?>>
                                                                        complete</option>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <button onclick="goBack()" class="btn btn-primary task-detail-back"><i
                                                            class="fa fa-arrow-left f-20" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <?php if(empty($project->project_title)): ?>
                                                        
                                                    <?php else: ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    class="control-label f-600 required">Project:</label>
                                                                <input type="text" id="task_title" name="task_title"
                                                                    class="form-control"
                                                                    value="<?php echo e($project->project_title); ?>"
                                                                    placeholder="Enter Task Title">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php
                                                                    if (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2 || session()->get('emp_login')['team_lead'] == 1) { ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Assign
                                                                Task:</label>
                                                            <select name="assign_task[]" id="assign_task"
                                                                class="form-select select3" value="<?php echo e($empIds); ?>">
                                                                <option value="" disabled id="firstoption"
                                                                    class="f-black f-700">-Select
                                                                    Employee-</option>
                                                                <?php $__currentLoopData = $emp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($emps->e_id); ?>"
                                                                        <?php echo e($emps->e_id == $empIds ? 'selected' : ''); ?>>
                                                                        <?php echo e($emps->fname); ?> <?php echo e($emps->lname); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Task
                                                                Title</label>
                                                            <input type="text" id="task_title" name="task_title"
                                                                class="form-control" value="<?php echo e($task->task_title); ?>"
                                                                placeholder="Enter Task Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Deadline</label>
                                                            <input type="text" id="deadline" name="deadline"
                                                                class="form-control" value="<?php echo e($task->deadline); ?>"
                                                                placeholder="Enter Hours">
                                                        </div>
                                                    </div>
                                                    <?php if ($task->status == 'complete' && (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2 || session()->get('emp_login')['team_lead'] == 1)){ ?>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 ">comment</label>
                                                            <textarea type="text" id="comment" name="comment" class="form-control  h-100" rows="3"
                                                                value="<?php echo e($task->comment); ?>" placeholder="Enter Your Comments"></textarea>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="col-md-12">
                                                        <div class="form-group f-black">
                                                            <label class="control-label f-600 required">Project
                                                                Description</label>
                                                            <input type="hidden" id="task_description_hidden"
                                                                name="task_description_hidden">
                                                            <textarea id="project-task-description" name="task_description" class="form-control" placeholder="Enter Project Title"><?php echo e($task->task_description); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" name="id" value="<?php echo e($task->tm_id); ?>">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" id="submitBtn"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
                    
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
            $("#deadline").flatpickr({
                dateFormat: "d-m-Y",
                minDate: "today",
            });
        });
    </script>
    <script>
        $('#assign_task').select2({
            placeholder: "-Select Employee-",
            allowClear: true
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#project-task-description').summernote({
                height: 150,
                codemirror: {
                    theme: 'monokai'
                },
                onChange: function(contents, $editable) {
                    $('#task_description_hidden').val(contents);
                }
            });
        });
    </script>
    <script>
        $('.select3').select2({
            placeholder: "-Select -",
            tags: true,
            allowClear: true,
            minimumResultsForSearch: Infinity,
        });
        // $('#status').on('change', function() {
        //     var status = $(this).val();
        //     var id = $('#taskId').val();

        //     $.ajax({
        //         url: "<?php echo e(URL('update-task-status')); ?>",
        //         method: 'POST',
        //         data: {
        //             id: id,
        //             status: status,
        //             _token: '<?php echo e(csrf_token()); ?>'
        //         },
        //         success: function(response) {
        //             console.log('Task status updated successfully:', response);
        //             location.reload();
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error updating task status:', error);
        //         }
        //     });
        // });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
        $("#MyForm").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {
                task_title: {
                    required: true
                },
                deadline: {
                    required: true
                },
                emp: {
                    required: true
                },
                'emp[]': {
                    required: true
                },
                task_description_hidden: {
                    required: true
                },
            },
            messages: {

            },
            errorPlacement: function(error, element) {
                //  error.insertAfter(element);
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
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/task/edit-task.blade.php ENDPATH**/ ?>