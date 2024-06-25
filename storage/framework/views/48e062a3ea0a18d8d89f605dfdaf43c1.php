

<?php $__env->startSection('title'); ?>
    Role.Index
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">

            <?php if(session('status')): ?>
                <div class="alert alert-success"><?php echo e(session('status')); ?></div>
            <?php endif; ?>

            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Roles
                        
                        <a href="<?php echo e(url('roles/create')); ?>" class="btn btn-primary float-end">Add Role</a>
                        
                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th width="40%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($role->id); ?></td>
                                <td><?php echo e($role->name); ?></td>
                                <td>
                                    <a href="<?php echo e(url('roles/'.$role->id.'/permissions')); ?>" class="btn btn-warning">
                                        Add / Edit Role Permission
                                    </a>

                                    
                                    <a href="<?php echo e(url('roles/'.$role->id.'/edit')); ?>" class="btn btn-success">
                                        Edit
                                    </a>
                                   

                                    
                                    <a href="<?php echo e(url('roles/'.$role->id.'/delete')); ?>" class="btn btn-danger mx-2">
                                        Delete
                                    </a>
                                    
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

    

    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\template\Starterkit\resources\views/role-permission/role/index.blade.php ENDPATH**/ ?>