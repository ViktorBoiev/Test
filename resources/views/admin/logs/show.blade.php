@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{route('admin.users.index')}}">< Back</a>
        <div class="row">
            <div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                <div class="panel panel-default">
                    <form action="{{route('admin.logs.update', $log->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="winner-name" class="col-sm-4 text-right col-form-label">Winner Name</label>
                                <div class="col-sm-8">
                                    <a href="{{route('admin.users.show', $log->winner_id)}}" class="form-control">{{$log->winner->name}}</a>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="win_type" class="col-sm-4 text-right col-form-label">Win Type</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="win_type" id="win_type" disabled
                                           value="{{$log->win_type}}">
                                </div>
                            </div>

                            @if($log->gift_type)
                                <div class="form-group row">
                                    <label for="gift_type" class="col-sm-4 text-right col-form-label">Gift Type</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="gift_type" id="gift_type" disabled
                                               value="{{$log->gift_type}}">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="win_quantity" class="col-sm-4 text-right col-form-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="win_quantity" id="win_quantity" disabled
                                           value="{{$log->win_quantity}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-sm-4 text-right col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select name="status" class="form-control" id="status">
                                        @foreach(\App\Models\WinnerLog::ARRAY_OF_STATUSES as $key => $value)
                                            <option value="{{$key}}" @if($log->status == $key) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin-custom.css">
@stop
