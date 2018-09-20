@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center home">
        <div class="col-md-8">
            @guest
            <h2 class="text-center">Please log in first!</h2>
            @else
            <div class="card">
                <div class="card-header">Welcome</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You can now continue to try your luck to win something interesting!
                </div>
                <div class="card-footer">
                    <a href="{{route('lottery')}}" class="btn btn-success ml-auto">Go ahead!</a>

                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
