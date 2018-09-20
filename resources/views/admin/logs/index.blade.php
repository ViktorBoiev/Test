@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Winner Name</th>
            <th>Win type</th>
            <th>Gift type</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Created At</th>
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
                ajax: '{!! route('admin.logs.data') !!}',
                columns: [
                    { data: 'winner_name', name: 'winner_name',
                        render: function(data, type, row){
                            return '<a href="/admin/users/show/'+row.winner_id+'">'+data+'</a>';

                        }
                    },
                    { data: 'win_type', name: 'win_type' },
                    { data: 'gift_type', name: 'gift_type',
                        render: function(data, type, row){
                            if(data) {
                                return data;
                            }
                            return '';

                        }
                    },
                    { data: 'win_quantity', name: 'win_quantity' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', searchable:false, sortable:false }
                ],
                responsive: true
            });
        });
    </script>
@stop