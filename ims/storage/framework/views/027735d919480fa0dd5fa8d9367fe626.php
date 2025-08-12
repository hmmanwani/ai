<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">



<link rel="shortcut icon" href="<?php echo e(URL('assets/images/logo/logo.png')); ?>" />

<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.1/jquery.timepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.2.7/js/tempus-dominus.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/md-date-time-picker@2.3.0/dist/css/mdDateTimePicker.min.css">

<link rel="stylesheet" href="<?php echo e(URL('vendors/base/vendor.bundle.base.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL('vendors/mdi/css/materialdesignicons.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL('assets/css/panel.css?v1')); ?>">

<link rel="stylesheet" href="<?php echo e(URL('assets/css/jnoty.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(URL('assets/css/mystyle.css?v8')); ?>">

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<title><?php echo e($title); ?></title>
<?php if (isset($component)) { $__componentOriginalb0168babb13dfcd3eb70a71fc643cb05 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb0168babb13dfcd3eb70a71fc643cb05 = $attributes; } ?>
<?php $component = App\View\Components\Headanalytics::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('headanalytics'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Headanalytics::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb0168babb13dfcd3eb70a71fc643cb05)): ?>
<?php $attributes = $__attributesOriginalb0168babb13dfcd3eb70a71fc643cb05; ?>
<?php unset($__attributesOriginalb0168babb13dfcd3eb70a71fc643cb05); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb0168babb13dfcd3eb70a71fc643cb05)): ?>
<?php $component = $__componentOriginalb0168babb13dfcd3eb70a71fc643cb05; ?>
<?php unset($__componentOriginalb0168babb13dfcd3eb70a71fc643cb05); ?>
<?php endif; ?>
<?php /**PATH /home/imshmmbiz/public_html/resources/views/components/head.blade.php ENDPATH**/ ?>