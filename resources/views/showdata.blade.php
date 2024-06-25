@extends('layouts.master')

@section('title')
    Excel Data
@endsection

@section('content')
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
                        @foreach($seasons as $season)
                            <option value="{{ $season }}">{{ $season }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 col-md-3">
                <div class="form-group">
                    <label for="categoryFilter">Category:</label>
                    <select id="categoryFilter" class="form-control">
                        <option value="">All</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 col-md-3">
                <div class="form-group">
                    <label for="clusterFilter">Cluster:</label>
                    <select id="clusterFilter" class="form-control">
                        <option value="">All</option>
                        @foreach($clusters as $cluster)
                            <option value="{{ $cluster }}">{{ $cluster }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 col-md-3">
                <div class="form-group">
                    <label for="subBrandFilter">Sub-brand:</label>
                    <select id="subBrandFilter" class="form-control">
                        <option value="">All</option>
                        @foreach($subBrands as $subBrand)
                            <option value="{{ $subBrand }}">{{ $subBrand }}</option>
                        @endforeach
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
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->season }}</td>
                        <td>{{ $row->Sum_quantity }}</td>
                        <td>{{ $row->Fabric_Cost_per_GMT }}</td>
                        <td>{{ $row->trim_cost }}</td>
                        <td>{{ $row->fob }}</td>
                        <td>{{ $row->mrp }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form id="exportForm" action="{{ route('export-excel') }}" method="POST">
            @csrf
            <input type="hidden" name="exportData" id="exportData">
            <button type="submit" class="btn btn-success">Download Excel</button>
        </form>
    </div>
</body>
@endsection
