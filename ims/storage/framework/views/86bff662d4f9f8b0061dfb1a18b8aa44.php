<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Manage Leave'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="card-title mb-0 f-24">Explore leaves</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="<?php echo e(URL('add-leave')); ?>">
                                                        <button type="button" class="btn btn-primary">
                                                            Add Leave</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <label for="name" class="f-black f-18 f-700">Leave:</label>
                                                    <select class="form-select mt-2 " id="leave_type"
                                                        aria-label="Default select example">
                                                        <option value="all" selected>All</option>
                                                        <?php $__currentLoopData = $leavetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leavetype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($leavetype->lt_id); ?>">
                                                                <?php echo e($leavetype->leave_type); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="startDate"
                                                                    class="f-black f-18 f-700">From:</label>
                                                                <input type="text" id="startDate" name="startDate"
                                                                    class="form-select flatpickr">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="endDate"
                                                                    class="f-black f-18 f-700">To:</label>
                                                                <input type="text" id="endDate" name="endDate"
                                                                    class="form-select flatpickr">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-md-12 d-flex align-items-center justify-content-center ">
                                                    <div class="form-group mb-0">
                                                        <div class="Sreach ">
                                                            <a href="javascript:void(0)" id="search"
                                                                class="btn btn-skyblue f-black">Search</a>
                                                            <a onclick="reload()" id="reset"
                                                                class="btn btn-danger f-black ">
                                                                Reset
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="e_id" value="<?= $e_id ?>">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body ">
                                            <table id="leavetable" class="table table-bordered table-striped f-black">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Leave for</th>
                                                        <th>Leave Type</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Requested at</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                </div>
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

    
    <div class="modal" tabindex="-1" id="leaveDetails" data-bs-backdrop="static">
        <div class="modal-dialog  modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Leave Details : <span class="f-black" id="date"></span>
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Leave For :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="leaveFor"></span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Leave Type :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="leaveType"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Responsible Person :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="responsiblePerson"></span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Request At :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="requestAt"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <label class="f-18 f-600">Reason :</label>
                                <span class="f-18 f-700 f-black ms-2" id="reAson"></span>
                            </div>
                            <div class="d-flex mb-3">
                                <label class="f-18 f-600">Document :</label>
                                <span class="f-18 f-700 f-black ms-2" id="docUment"></span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
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
        $('body').on('click', 'a[id^="leave-details_"]', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?php echo e(url('leave-info')); ?>',
                method: 'POST',
                data: {
                    id: id,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    if (response.data) {
                        console.log(response.data);

                        // Set text for each field
                        $('#date').text(response.data.leave_date);
                        $('#leaveFor').text(response.data.leave_for);
                        $('#leaveType').text(response.data.leaveName);
                        $('#responsiblePerson').text(response.data.responsible);
                        $('#requestAt').text(response.data.created);
                        $('#reAson').text(response.data.leave_reason);

                        // Check if document exists
                        if (response.data.document) {
                            $('#docUment').html(
                                `<a href="<?php echo e(url('storage/')); ?>/${response.data.document}" target="_blank">
                                <i class="fa fa-eye ms-2 f-black" aria-hidden="true"></i> View Document
                            </a>`
                            );
                        } else {
                            $('#docUment').text('No document uploaded');
                        }

                        // Show the modal
                        $('#leaveDetails').modal('show');
                    } else {
                        console.error('No data found in response');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.flatpickr').flatpickr({
                dateFormat: "d-m-Y"
            });
            assignData();
        });
    </script>
    <script>
        $(document).ready(function() {
            let toDatePicker = $('#endDate').flatpickr({
                dateFormat: "d-m-Y"
            });

            $('#startDate').flatpickr({
                dateFormat: "d-m-Y",
                onChange: function(selectedDates, dateStr, instance) {
                    let minDate = dateStr;
                    toDatePicker.set('minDate', minDate);
                }
            });

            assignData();
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
            $('#startDate').val('');
            $('#endDate').val('');
            $('#leave_type').val('all').change();
            assignData();
            toggleResetButton();
        }

        function assignData() {
            $('#leavetable').DataTable().destroy();
            let filter = {};
            filter['e_id'] = $('#e_id').val();
            filter['l_type'] = $('#leave_type').val();
            filter['s_date'] = $('#startDate').val();
            filter['e_date'] = $('#endDate').val();
           ajaxDataTableInit(baseUrl() + '/get-user-leave', 'leavetable', 0, '', filter, "", false);
        }
        
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/attendance/manage-leave.blade.php ENDPATH**/ ?>