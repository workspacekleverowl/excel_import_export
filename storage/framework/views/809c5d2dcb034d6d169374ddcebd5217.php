

<?php $__env->startSection('title'); ?>
    Excel Data
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            function collectFilteredData() {
                var filteredData = [];
                $("#dataTable tr:visible").each(function() {
                    var row = $(this);
                    var rowData = {
                        season: row.find("td:nth-child(1)").text(),
                        sum_quantity: row.find("td:nth-child(2)").text(),
                        fabric_cost_per_gmt: row.find("td:nth-child(3)").text(),
                        trim_cost: row.find("td:nth-child(4)").text(),
                        fob: row.find("td:nth-child(5)").text(),
                        mrp: row.find("td:nth-child(6)").text()
                    };
                    filteredData.push(rowData);
                });
                $("#exportData").val(JSON.stringify(filteredData));
            }

            $("#exportForm").on("submit", function() {
                collectFilteredData();
            });
        });
    </script>
    <style>
        .table-container {
            max-height: 400px;
            overflow-y: auto;
        }
        
        
        .download-button-container {
            position: relative;
            height: 50px;
        }
        .download-button-container button {
            position: absolute;
            bottom: 0px;
            right: 10px;
        }
    </style>
</head>
<body style="margin:0%">
    
    <div class="container" style="max-height: 100%;max-width:100%;">
        <h2>Analysis of Imported Excel</h2>
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
        <form method="GET" action="<?php echo e(route('showData', ['identifier' => request()->route('identifier')])); ?>">
            <div class="row">
                <div class="mb-3 col-md-3">
                    <div class="form-group">
                        <label for="seasonFilter">Season:</label>
                        <select id="seasonFilter" name="season" class="form-control">
                            <option value="">All</option>
                            <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($season); ?>" <?php echo e(request('season') == $season ? 'selected' : ''); ?>><?php echo e($season); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 col-md-3">
                    <div class="form-group">
                        <label for="categoryFilter">Category:</label>
                        <select id="categoryFilter" name="category" class="form-control">
                            <option value="">All</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category); ?>" <?php echo e(request('category') == $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 col-md-3">
                    <div class="form-group">
                        <label for="clusterFilter">Cluster:</label>
                        <select id="clusterFilter" name="cluster" class="form-control">
                            <option value="">All</option>
                            <?php $__currentLoopData = $clusters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cluster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cluster); ?>" <?php echo e(request('cluster') == $cluster ? 'selected' : ''); ?>><?php echo e($cluster); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 col-md-3">
                    <div class="form-group">
                        <label for="subBrandFilter">Sub-brand:</label>
                        <select id="subBrandFilter" name="sub_brand" class="form-control">
                            <option value="">All</option>
                            <?php $__currentLoopData = $subBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subBrand); ?>" <?php echo e(request('sub_brand') == $subBrand ? 'selected' : ''); ?>><?php echo e($subBrand); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Filter</button>
        </form>

        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Season</th>
                        <th>Sum of Ordered Quantity</th>
                        <th>Fabric Cost per GMT</th>
                        <th>Trim Cost</th>
                        <th>FOB</th>
                        <th>MRP</th>
                    </tr>
                </thead>
                <tbody id="dataTable">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($row->season); ?></td>
                            <td><?php echo e($row->Sum_quantity); ?></td>
                            <td><?php echo e($row->Fabric_Cost_per_GMT); ?></td>
                            <td><?php echo e($row->trim_cost); ?></td>
                            <td><?php echo e($row->fob); ?></td>
                            <td><?php echo e($row->mrp); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        
        <div class="download-button-container">
            <form id="exportForm" action="<?php echo e(route('export-excel',$identifier)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="exportData" id="exportData">
                <button type="submit" class="btn btn-success">Download Excel</button>
            </form>
        </div>
    </div>
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\excel\Starterkit\resources\views/showdata.blade.php ENDPATH**/ ?>