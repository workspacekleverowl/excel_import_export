<!DOCTYPE html>
<html>
<head>
    <title>Match Columns</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Match Columns</h2>
    <form action="<?php echo e(route('orders.import')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="file_path" value="<?php echo e($filePath); ?>">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Database Column</th>
                <th>Excel Column</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $headings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $heading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($heading); ?></td>
                    <td>
                        <select name="columns[<?php echo e($heading); ?>]" class="form-control" required>
                            <?php $__currentLoopData = $headings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($header); ?>"><?php echo e($header); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\excel\Starterkit\resources\views/match_columns.blade.php ENDPATH**/ ?>