@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{route('admin.users.index')}}">< Back</a>
        <div class="row">
            <div class="col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>Loyalty points</td>
                            <td>{{$user->loyalty_points}}</td>
                        </tr>
                        <tr>
                            <td>Delivery country</td>
                            <td>{{$user->preferences->delivery_country}}</td>
                        </tr>
                        <tr>
                            <td>Delivery city</td>
                            <td>{{$user->preferences->delivery_city}}</td>
                        </tr>
                        <tr>
                            <td>Delivery state</td>
                            <td>{{$user->preferences->delivery_state}}</td>
                        </tr>
                        <tr>
                            <td>Delivery zip</td>
                            <td>{{$user->preferences->delivery_zip}}</td>
                        </tr>
                        <tr>
                            <td>Delivery street</td>
                            <td>{{$user->preferences->delivery_street}}</td>
                        </tr>
                        <tr>
                            <td>Delivery building</td>
                            <td>{{$user->preferences->delivery_building}}</td>
                        </tr>
                        <tr>
                            <td>Delivery apartment</td>
                            <td>{{$user->preferences->delivery_apartment}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin-custom.css">
@stop
