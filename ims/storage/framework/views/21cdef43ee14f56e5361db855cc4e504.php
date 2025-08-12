<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Edit-PersonalDetails'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    
                    <section id="edit-personaldeatil">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end  mb-3 ">
                                        <button onclick="goBack()" class="btn btn-primary"><i
                                                class="fa fa-arrow-left me-2" aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="<?php echo e(url('/update-personal-details')); ?>" method="POST"
                                                enctype="multipart/form-data" id="myForm">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <input type="hidden" name="id" value="<?php echo e($data->e_id); ?>">
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="fname">First Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="fname" name="fname"
                                                                    class="form-control" value="<?php echo e($data->fname); ?>"
                                                                    pattern="[A-Za-z]+"
                                                                    title="Please enter alphabets only.">
                                                                <div class="invalid-feedback" id="fname-error"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="mname">Middle Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="mname" name="mname"
                                                                    class="form-control" value="<?php echo e($data->mname); ?>"
                                                                    pattern="[A-Za-z]+"
                                                                    title="Please enter alphabets only.">
                                                                <div class="invalid-feedback" id="mname-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="lname">Last Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="lname" name="lname"
                                                                    class="form-control" value="<?php echo e($data->lname); ?>"
                                                                    pattern="[A-Za-z]+"
                                                                    title="Please enter alphabets only.">
                                                                <div class="invalid-feedback" id="lname-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="nationality">Nationality</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="nationality"
                                                                    name="nationality" class="form-control"
                                                                    value="<?php echo e($data->nationality); ?>" pattern="[A-Za-z]+"
                                                                    title="Please enter alphabets only.">
                                                                <div class="invalid-feedback" id="nationality-error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="dob">Date of Birth</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="dob" name="dob"
                                                                    class="form-control" placeholder="dd-mm-yyyy"
                                                                    value="<?php echo e($data->dob); ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="marital_status">Marital
                                                                Status</label>
                                                            <select name="marital_status" id="marital_status"
                                                                class="form-select form-control f-black">
                                                                <option value="">-Select Marital Status-</option>
                                                                <option value="Single" <?php echo $data->marital_status == 'Single' ? 'selected' : ''; ?>>Single
                                                                </option>
                                                                <option value="Married" <?php echo $data->marital_status == 'Married' ? 'selected' : ''; ?>>Married
                                                                </option>
                                                                <option value="Divorced" <?php echo $data->marital_status == 'Divorced' ? 'selected' : ''; ?>>Divorced
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="gender">Gender</label>
                                                            <select name="gender" id="gender"
                                                                class="form-select form-control f-black">
                                                                <option value="">-Select Your Gender-</option>
                                                                <option value="Male" <?php echo $data->gender == 'Male' ? 'selected' : ''; ?>>
                                                                    Male</option>
                                                                <option value="Female" <?php echo $data->gender == 'Female' ? 'selected' : ''; ?>>
                                                                    Female</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" foadr="bloodtype">Blood
                                                                Type</label>
                                                            <select name="bloodtype" id="bloodtype"
                                                                class="form-select form-control f-black">
                                                                <option value="">-Select Your Blood Type-
                                                                </option>
                                                                <option value="A+" <?php echo $data->bloodtype == 'A+' ? 'selected' : ''; ?>> A+
                                                                </option>
                                                                <option value="A-" <?php echo $data->bloodtype == 'A-' ? 'selected' : ''; ?>>A- </option>
                                                                <option value="B+" <?php echo $data->bloodtype == 'B+' ? 'selected' : ''; ?>>B+ </option>
                                                                <option value="B-" <?php echo $data->bloodtype == 'B-' ? 'selected' : ''; ?>>B- </option>
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
                                                                Number</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="phone" name="phone"
                                                                    class="form-control" value="<?php echo e($data->phone); ?>"
                                                                    pattern="[6-9][0-9]{9}" minlength="10"
                                                                    maxlength="10"
                                                                    title="Please enter a valid 10-digit phone number.">
                                                                <div class="invalid-feedback" id="phone-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="pemail">Personal
                                                                Email</label>
                                                            <div class="col-md-12">
                                                                <input type="email" id="pemail" name="pemail"
                                                                    class="form-control" value="<?php echo e($data->pemail); ?>"
                                                                    required>
                                                                <div class="invalid-feedback" id="pemail-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Aadhar
                                                                card</label>
                                                            <input class="form-control" type="file"
                                                                id="addharcard" name="addharcard">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" d-flex justify-content-end ">
                                                    <button type="submit" id="submitBtn"
                                                        class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
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
            $('#dob').flatpickr({
                dateFormat: "d-m-Y",
                maxDate: 'today',
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#fname,#mname, #lname, #nationality').on('input', function() {
                $(this).val($(this).val().replace(/[^A-Za-z\s]/g, ''));
            });
        });
        $.validator.addMethod("validPhone", function(value, element) {
            return this.optional(element) || /^[6-9][0-9]{9}$/.test(value);
        });
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
                    nationality: {
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
                    dob: {
                        required: true
                    },
                    phone: {
                        required: true,
                        validPhone: true,
                        minlength: 10,
                        maxlength: 10
                    }
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

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/profile/edit-pessonaldetails.blade.php ENDPATH**/ ?>