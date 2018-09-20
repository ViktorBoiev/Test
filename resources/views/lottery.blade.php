@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center lottery">
        <div class="col-md-8 d-flex flex-column">
            <h2 class="mb-5 lottery-heading">Click a button below to discover your prize!</h2>

            <div class="lottery-block">
                <a href="" class="btn btn-big btn-info lottery-button">Win!</a>
                <div id="body-preloader" class="preloader justify-content-center align-items-center">
                    <svg viewBox="0 0 120 120" width="120px" height="120px">
                        <circle class="inner" cx="60" cy="60" r="32"/>
                        <circle class="middle" cx="60" cy="60" r="38"/>
                        <circle class="outer" cx="60" cy="60" r="44"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="lottery-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Congratulations!</h5>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <a class="btn btn-danger decline">Decline my prize</a>
                <a class="btn btn-primary accept">Accept prize</a>
                <a class="btn btn-warning convert hidden">Convert to loyalty points</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection