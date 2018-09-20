@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">
                <div class="panel panel-default">
                    <form action="{{route('admin.configs.update')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($configs as $config)
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 text-right col-form-label">{{ucfirst($config->key)}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has($config->keyForForm) ? ' is-invalid' : '' }}" name="{{$config->keyForForm}}" id="{{$config->keyForForm}}"
                                           value="{{ old($config->keyForForm) ? old($config->keyForForm) : $config->value}}">
                                    @if ($errors->has($config->keyForForm))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first($config->keyForForm) }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
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

