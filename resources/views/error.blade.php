<?php
$user = Session::get('auth');
?>
@extends('layouts.app')

@section('content')
    <style>
        .page p {
            color: #858585;
            font-size: 1.2em;
        }
        .page h3 {
            color: #f18b3c;
        }
        .page img {
            margin-right: 20px;
        }
    </style>
    <div class="col-md-9">
        <div class="jim-content page">
            <h3 class="page-header">{{ $title }}
            </h3>
            <div class="row">
                <div class="col-md-12">
                    <img src="{{ url('img/maintenance.png') }}" width="300px" class="pull-left">
                    <h3 class="text-warning">
                        We're Sorry!
                    </h3>
                    <p>
                        This page is down for maintenance.
                    </p>
                    <p>
                        We are working to get it back up and running as soon as possible.
                    </p>
                    <p>
                        Please check back!
                    </p>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>

    </div>
    <div class="col-md-3">
        @include('sidebar.quick')
    </div>
@endsection

@section('js')

@endsection

