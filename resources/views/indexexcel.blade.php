@extends('layouts.master')

@section('title')
    Excel Import
@endsection

@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
@endsection

@section('content')
<head>
    <title>Excel Import</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Excel Import</h2>
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

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Upload Excel File</label>
            <input type="file" class="form-control" name="file" required>
        </div>
        <button style="margin-top: 2%" type="submit" class="btn btn-primary ">Upload</button>
    </form>
    
</div>
</body>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
@endsection
