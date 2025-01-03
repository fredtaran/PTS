@extends('layouts.app')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <div class="row">
        <div class="box box-success">
            <input type="hidden" id="user" value="{{ Auth::user() }}">
            <div class="box-body" id="app"></div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Scripts -->
    <!-- <script src="{{ asset('/js/app.js') }}" defer></script> -->
    @vite('resources/assets/js/app.js')
@endsection

