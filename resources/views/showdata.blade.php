@extends('layouts.master')

@section('title')
    Excel Data
@endsection

@section('content')
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
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form method="GET" action="{{ route('showData', ['identifier' => request()->route('identifier')]) }}">
            <div class="row">
                <div class="mb-3 col-md-3">
                    <div class="form-group">
                        <label for="seasonFilter">Season:</label>
                        <select id="seasonFilter" name="season" class="form-control">
                            <option value="">All</option>
                            @foreach($seasons as $season)
                                <option value="{{ $season }}" {{ request('season') == $season ? 'selected' : '' }}>{{ $season }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 col-md-3">
                    <div class="form-group">
                        <label for="categoryFilter">Category:</label>
                        <select id="categoryFilter" name="category" class="form-control">
                            <option value="">All</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 col-md-3">
                    <div class="form-group">
                        <label for="clusterFilter">Cluster:</label>
                        <select id="clusterFilter" name="cluster" class="form-control">
                            <option value="">All</option>
                            @foreach($clusters as $cluster)
                                <option value="{{ $cluster }}" {{ request('cluster') == $cluster ? 'selected' : '' }}>{{ $cluster }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 col-md-3">
                    <div class="form-group">
                        <label for="subBrandFilter">Sub-brand:</label>
                        <select id="subBrandFilter" name="sub_brand" class="form-control">
                            <option value="">All</option>
                            @foreach($subBrands as $subBrand)
                                <option value="{{ $subBrand }}" {{ request('sub_brand') == $subBrand ? 'selected' : '' }}>{{ $subBrand }}</option>
                            @endforeach
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
        </div>

        
        <div class="download-button-container">
            <form id="exportForm" action="{{ route('export-excel',$identifier) }}" method="POST">
                @csrf
                <input type="hidden" name="exportData" id="exportData">
                <button type="submit" class="btn btn-success">Download Excel</button>
            </form>
        </div>
    </div>
</body>
@endsection
