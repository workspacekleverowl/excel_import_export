@extends('layouts.master')

@section('title')
    Role.Index
@endsection

@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Roles
                        
                        <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a>
                        
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
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ url('roles/'.$role->id.'/permissions') }}" class="btn btn-warning">
                                        Add / Edit Role Permission
                                    </a>

                                    
                                    <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">
                                        Edit
                                    </a>
                                   

                                    
                                    <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger mx-2">
                                        Delete
                                    </a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

    

    
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    
@endsection
