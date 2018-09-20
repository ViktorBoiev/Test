@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{route('admin.gifts.index')}}">< Back</a>
        <div class="row">
            <div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                <div class="panel panel-default">
                    <form action="{{route('admin.gifts.store')}}" method="post">
                        @csrf
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 text-right col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="{{old('name')}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="quantity" class="col-sm-4 text-right col-form-label">Win Type</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="quantity" id="quantity"
                                           value="{{old('quantity')}}">
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
