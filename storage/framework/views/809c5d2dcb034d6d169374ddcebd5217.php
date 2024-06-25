

<?php $__env->startSection('title'); ?>
    Excel Data
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            function filterTable() {
                var seasonFilter = $("#seasonFilter").val().toLowerCase();
                var categoryFilter = $("#categoryFilter").val().toLowerCase();
                var clusterFilter = $("#clusterFilter").val().toLowerCase();
                var subBrandFilter = $("#subBrandFilter").val().toLowerCase();

                $("#dataTable tr").each(function() {
                    var row = $(this);
                    var seasonText = row.find("td:nth-child(1)").text().toLowerCase();
                    var categoryText = row.find("td:nth-child(2)").text().toLowerCase();
                    var clusterText = row.find("td:nth-child(3)").text().toLowerCase();
                    var subBrandText = row.find("td:nth-child(4)").text().toLowerCase();

                    var seasonMatch = seasonFilter === "" || seasonText.indexOf(seasonFilter) > -1;
                    var categoryMatch = categoryFilter === "" || categoryText.indexOf(categoryFilter) > -1;
                    var clusterMatch = clusterFilter === "" || clusterText.indexOf(clusterFilter) > -1;
                    var subBrandMatch = subBrandFilter === "" || subBrandText.indexOf(subBrandFilter) > -1;

                    if (seasonMatch && categoryMatch && clusterMatch && subBrandMatch) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            }

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

            $("#seasonFilter, #categoryFilter, #clusterFilter, #subBrandFilter").on("change keyup", function() {
                filterTable();
            });

            $("#exportForm").on("submit", function() {
                collectFilteredData();
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Average per Season</h2>
        <div class="row">
            <div class="mb-3 col-md-3">
                <div class="form-group">
                    <label for="seasonFilter">Season:</label>
                    <select id="seasonFilter" class="form-control">
                        <option value="">All</option>
                        <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($season); ?>"><?php echo e($season); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 col-md-3">
                <div class="form-group">
                    <label for="categoryFilter">Category:</label>
                    <select id="categoryFilter" class="form-control">
                        <option value="">All</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 col-md-3">
                <div class="form-group">
                    <label for="clusterFilter">Cluster:</label>
                    <select id="clusterFilter" class="form-control">
                        <option value="">All</option>
                        <?php $__currentLoopData = $clusters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cluster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cluster); ?>"><?php echo e($cluster); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 col-md-3">
                <div class="form-group">
                    <label for="subBrandFilter">Sub-brand:</label>
                    <select id="subBrandFilter" class="form-control">
                        <option value="">All</option>
                        <?php $__currentLoopData = $subBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subBrand); ?>"><?php echo e($subBrand); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
        
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
        <form id="exportForm" action="<?php echo e(route('export-excel')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="exportData" id="exportData">
            <button type="submit" class="btn btn-success">Download Excel</button>
        </form>
    </div>
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\excel\Starterkit\resources\views/showdata.blade.php ENDPATH**/ ?>