

<?php $__env->startSection('title'); ?>
    Excel Import
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<head>
    <title>Laravel Excel Import</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Laravel Excel Import</h2>
    <?php if(Session::has('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(Session::get('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

    <form action="<?php echo e(route('import')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="file">Upload Excel File</label>
            <input type="file" class="form-control" name="file" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    
</div>
</body>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\excel\Starterkit\resources\views/indexexcel.blade.php ENDPATH**/ ?>