@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gifts</h1>
@stop

@section('content')
    <a href="{{route('admin.gifts.create')}}" class="btn btn-success">Create new</a>
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Gift Name</th>
            <th>Quantity</th>
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
                ajax: '{!! route('admin.gifts.data') !!}',
                columns: [

                    { data: 'name', name: 'name' },
                    { data: 'quantity', name: 'quantity' },
                    { data: 'action', searchable:false, sortable:false }
                ],
                responsive: true
            });
        });
    </script>
@stop