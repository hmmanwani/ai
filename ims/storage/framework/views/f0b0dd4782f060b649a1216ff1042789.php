<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Add Employee Leave'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    <style>
        .select-employee .select2-selection {
            height: 48px !important;
            /* overflow: auto !important; */
        }
    </style>
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
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class= "">Add Employee Leave</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form id="addLeave" name="addLeave"
                                                        action="<?php echo e(url('/submit-add-emp-leave')); ?>" method="POST"
                                                        enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label required">Leave
                                                                        For</label>
                                                                    <div class="col-md-12">
                                                                        <select data-plugin-selectTwo name="leave_for"
                                                                            id="leave_for" class="form-select">
                                                                            <option value="">Leave For</option>
                                                                            <option value="first-half">First Half
                                                                            </option>
                                                                            <option value="second-half">Second Half
                                                                            </option>
                                                                            <option value="full-day">Full Day</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label required">Leave
                                                                        Type</label>
                                                                    <div class="col-md-12">
                                                                        <select data-plugin-selectTwo name="leave_type"
                                                                            id="leave_type" name="leave_type"
                                                                            class="form-select">

                                                                            <option value="">Select Leave Type
                                                                            </option>
                                                                            <?php $__currentLoopData = $leavetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leavetype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($leavetype->lt_id); ?>">
                                                                                    <?php echo e($leavetype->leave_type); ?>

                                                                                </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 select-employee">
                                                                <div class="form-group">
                                                                    <?php $groupedEmployees = $emp->groupBy('team'); ?>
                                                                    <div class="d-flex justify-content-between">
                                                                        <label class="required control-label"
                                                                            for="emp">Leave By</label>
                                                                        <div>
                                                                            <label class="control-label"
                                                                                for="all">All</label>
                                                                            <input type="checkbox" id="selectAllEmp" />
                                                                        </div>
                                                                    </div>
                                                                    <select name="leaveby[]" id="leaveby"
                                                                        class="form-select select3" multiple>
                                                                        <?php $__currentLoopData = $groupedEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team => $employees): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <optgroup label="<?php echo e($team); ?>">
                                                                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($emps->e_id); ?>">
                                                                                        <?php echo e($emps->name); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </optgroup>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class=" control-label required">Leave
                                                                        Reason</label>
                                                                    <textarea class="form-control  h-100" name="leave_reason" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group" id="leave_date_box">
                                                                    <label class=" control-label required">Leave
                                                                        Date</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="leave_date"
                                                                            name="leave_date" class="form-control"
                                                                            title="Leave Date" placeholder="d-m-Y">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label class=" control-label">Document</label>
                                                                    <div class="col-md-12">
                                                                        <input type="file" id="document"
                                                                            name="document" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="align-self-center text-end">
                                                            <button type="submit" class="btn btn-primary">Add
                                                                Leave</button>
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
            // Initialize Select2
            $('#leaveby').select2({
                placeholder: "Select Employee"
            });

            function updateOverflow() {
                const selection = $('#leaveby').val();
                const $selectionBox = $('.select-employee .select2-selection');

                if (selection && selection.length > 0) {
                    $selectionBox.css({
                        'overflow': 'auto',
                        'height': 'auto',
                        'max-height': '100px' // adjust as needed
                    });
                } else {
                    $selectionBox.css({
                        'overflow': 'hidden',
                        'height': '48px'
                    });
                }
            }

            // Call on load (if editing form)
            updateOverflow();

            // Call on change
            $('#leaveby').on('change', function() {
                updateOverflow();
            });

            // Select All Checkbox Logic
            $('#selectAllEmp').change(function() {
                if (this.checked) {
                    // Select all options
                    let allVals = $('#leaveby option').map(function() {
                        return $(this).val();
                    }).get();
                    $('#leaveby').val(allVals).trigger('change');
                } else {
                    // Deselect all options
                    $('#leaveby').val(null).trigger('change');
                }
            });
        });
    </script>
    <script>
        $("#leave_date").flatpickr({
            mode: "range",
            dateFormat: "d-m-Y",
            // minDate: "today",
            disable: [
                    function(date) {
                        // Disable  Saturday (6), Sunday (0)
                        var day = date.getDay();
                        return day === 0 ||  day === 6;
                    }
                ],
        });
    </script>
    <script>
        function goBack() {
            history.go(-1);
        }

        $("#addLeave").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {
                leave_type: {
                    required: true
                },
                leave_for: {
                    required: true
                },
                leave_responsible_person: {
                    required: true
                },
                leave_reason: {
                    required: true
                },
                leave_date: {
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
                form.submit();
            }
        });
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/admin/leave/add-emp-leave.blade.php ENDPATH**/ ?>