<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | Add Email type'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                                        <button onclick="goBack()" class="btn btn btn-dark"><i
                                                class="fa fa-arrow-left me-2" aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="<?php echo e(URl('submit-email-type')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            
                                                            <div class="col-md-12 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="type">Type</label>
                                                                    <input type="text" id="type" name="type"
                                                                        class="form-control" required>
                                                                    <div class="invalid-feedback" id="type-error">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                                <div class="justify-content-end d-flex p-0">
                                                                    <a class="btn btn-primary add-email-input d-none"
                                                                        href="#" id="add-to-input">
                                                                        <i class="fa fa-plus f-18 f-white"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="row email-to-inputs">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="required" for="email_to">Email
                                                                                To</label>
                                                                            <input type="email" name="email_to[]"
                                                                                id="email_to" class="form-control"
                                                                                required>
                                                                            <div class="invalid-feedback"
                                                                                id="type-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                                <div class="justify-content-end d-flex p-0">
                                                                    <a class="btn btn-primary add-email-input d-none"
                                                                        href="#" id="add-cc-input">
                                                                        <i class="fa fa-plus f-18 f-white"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="row email-cc-inputs">
                                                                    <div class="col-md-4 email-cc-field">
                                                                        <div class="form-group">
                                                                            <label class="required" for="email_cc">Email
                                                                                CC</label>
                                                                            <input type="email" name="email_cc[]"
                                                                                id="email_cc" class="form-control"
                                                                                required>
                                                                            <div class="invalid-feedback"
                                                                                id="type-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class=" d-flex justify-content-end ">
                                                                <button type="submit" id="submitBtn" id="submitBtn"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
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
            $('#email_to').on('input', function() {
                var email = $(this).val();
                var isValidEmail = email.length > 0 && this
                    .checkValidity();

                if (isValidEmail) {
                    $('#add-to-input').removeClass('d-none');
                } else {
                    $('#add-to-input').addClass('d-none');
                }
            });
        });

        // email to
        $(document).ready(function() {
            $('#add-to-input').click(function(e) {
                e.preventDefault();

                var newEmailInput = `
            <div class="col-md-4 email-to-field" style="display:none;">
                <div class="form-group">
                    <label class="required" for="email_to">Email To</label>
                    <div class="d-flex align-items-center">
                        <input type="email" name="email_to[]" id="email_to" class="form-control" required>
                         <a href="#" class="btn f-red btn-sm ml-2 remove-email-to-input">
                            <i class="fa fa-trash"></i>
                        </a>
                        <div class="invalid-feedback" id="type-error"></div>
                    </div>
                </div>
            </div>
        `;
                var firstInput = $('.email-to-inputs .col-md-4').first();
                var newElement = $(newEmailInput).insertAfter(firstInput);
                newElement.hide().fadeIn(500);
            });

            $(document).on('click', '.remove-email-to-input', function(e) {
                e.preventDefault();
                $(this).closest('.email-to-field').fadeOut(500, function() {
                    $(this).remove();
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Show add CC button if email is valid
            $('#email_cc').on('input', function() {
                var email = $(this).val();
                var isValidEmail = email.length > 0 && this.checkValidity();

                if (isValidEmail) {
                    $('#add-cc-input').removeClass('d-none');
                } else {
                    $('#add-cc-input').addClass('d-none');
                }
            });

            $('#add-cc-input').click(function(e) {
                e.preventDefault();

                var newEmailInput = `
            <div class="col-md-4 email-cc-field" style="display:none;">
                <div class="form-group">
                    <label class="required" for="email_cc">Email CC</label>
                    <div class="d-flex align-items-center">
                        <input type="email" name="email_cc[]" class="form-control" required>
                        <a href="#" class="btn f-red btn-sm ml-2 remove-email-cc-input">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                    <div class="invalid-feedback" id="type-error"></div>
                </div>
            </div>
        `;

                var firstInput = $('.email-cc-inputs .col-md-4').first();
                var newElement = $(newEmailInput).insertAfter(firstInput);
                newElement.hide().fadeIn(500);
            });

            $(document).on('click', '.remove-email-cc-input', function(e) {
                e.preventDefault();
                $(this).closest('.email-cc-field').fadeOut(500, function() {
                    $(this).remove();
                });
            });
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    
</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/admin/manage-email/add-email-type.blade.php ENDPATH**/ ?>