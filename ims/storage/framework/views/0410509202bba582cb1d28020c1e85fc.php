<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal781d22988f835a9692410092c1d21cd6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal781d22988f835a9692410092c1d21cd6 = $attributes; } ?>
<?php $component = App\View\Components\Head::resolve(['title' => 'IMS | LogIn'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
<style>
    #login .card {
        background-color: #ededed;
    }

    .mob-section {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 50px;
        background-color: #ffffff !important;
    }

    .mob-section h1 {
        font-size: 24px;
    }

    .mob-section p {
        font-size: 18px;
    }
</style>

<body>
    

    <section id="login-section">
        <img class="circle-1" src="<?php echo e(URL('assets/images/login-svg-1.svg')); ?>" alt="">
        <img class="circle-2" src="<?php echo e(URL('assets/images/login-svg-2.svg')); ?>" alt="">
        <img class="newlogin-logo" src="<?php echo e(URL('assets/images/logo/logo.png')); ?>" alt="">

        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-6 welcome-card">
                    <p class="main-heading">Welcome</p>
                    <h1 class="mt-5">To Employee Portal</h1>
                </div>
                <div class="col-md-6 offset-md-6 login-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-center f-logo f-700 f-50 mb-5">Login</p>
                            <form method="POST" action="#" id="myForm">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label f-logo2 f-18 f-600">Email</label>
                                    <div class="input-group">
                                        <i class="fa fa-envelope input-group-text login-icon f-22"></i>
                                        <input type="email" name="email" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            placeholder="Enter your email">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label f-18 f-600">Password</label>
                                    <div class="input-group">
                                        <i class="fa fa-lock input-group-text login-icon f-26"></i>
                                        <input type="password" name="password" class="form-control lock-input"
                                            id="password" placeholder="Enter your new password">
                                        <i class="fa fa-eye toggle-password input-group-text" id="togglePassword1"></i>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-lg btn-primary login-btn"
                                        id="submitBtn">Login</button>
                                </div>
                                <div class="login-button text-center">
                                    <a class="text-decoration-none  " href="#">Forgot
                                        password?</a>

                                </div>
                                <input type="hidden" name="url" value="<?php echo e($url); ?>">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <img class="circle-3" src="<?php echo e(URL('assets/images/login-svg-3.svg')); ?>" alt="">
    </section>
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

</body>

</html>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/ims/login/newlogin.blade.php ENDPATH**/ ?>