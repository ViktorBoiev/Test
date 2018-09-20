@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Loyalty Points</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
        </thead>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin-custom.css">
@stop

@section('js')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.users.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'loyalty_points', name: 'loyalty_points' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', searchable:false, sortable:false }
                ],
                responsive: true
            });
        });
    </script>
@stop