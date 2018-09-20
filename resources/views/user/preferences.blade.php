@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center home">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Welcome {{$user->name}}
                        <br>
                        You currently have <b>{{$user->loyalty_points}}</b> Loyalty points
                    </div>
                    <form action="{{route('preferences.update')}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Full Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name"
                                           value="{{ old('name') ? old('name') : $user->name}}">
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email"
                                           value="{{ old('email') ? old('email') : $user->email}}">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="delivery_country" class="col-sm-4 col-form-label">Country</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('delivery_country') ? ' is-invalid' : '' }}" name="delivery_country" id="delivery_country"
                                           value="{{ old('delivery_country') ? old('delivery_country') : $user->preferences->delivery_country}}">
                                    @if ($errors->has('delivery_country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('delivery_country') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="delivery_city" class="col-sm-4 col-form-label">City</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('delivery_city') ? ' is-invalid' : '' }}" name="delivery_city" id="delivery_city"
                                           value="{{ old('delivery_city') ? old('delivery_city') : $user->preferences->delivery_city}}">
                                    @if ($errors->has('delivery_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('delivery_city') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="delivery_zip" class="col-sm-4 col-form-label">Zip</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('delivery_zip') ? ' is-invalid' : '' }}" name="delivery_zip" id="delivery_zip"
                                           value="{{ old('delivery_zip') ? old('delivery_zip') : $user->preferences->delivery_zip}}">
                                    @if ($errors->has('delivery_zip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('delivery_zip') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="delivery_street" class="col-sm-4 col-form-label">Delivery Street</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('delivery_street') ? ' is-invalid' : '' }}" name="delivery_street" id="delivery_street"
                                           value="{{ old('delivery_street') ? old('delivery_street') : $user->preferences->delivery_street}}">
                                    @if ($errors->has('delivery_street'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('delivery_street') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="delivery_building" class="col-sm-4 col-form-label">Delivery Building</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('delivery_building') ? ' is-invalid' : '' }}" name="delivery_building" id="delivery_building"
                                           value="{{ old('delivery_building') ? old('delivery_building') : $user->preferences->delivery_building}}">
                                    @if ($errors->has('delivery_building'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('delivery_building') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="delivery_apartment" class="col-sm-4 col-form-label">Delivery Apartment</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control {{ $errors->has('delivery_apartment') ? ' is-invalid' : '' }}" name="delivery_apartment" id="delivery_apartment"
                                           value="{{ old('delivery_apartment') ? old('delivery_apartment') : $user->preferences->delivery_apartment}}">
                                    @if ($errors->has('delivery_apartment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('delivery_apartment') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
