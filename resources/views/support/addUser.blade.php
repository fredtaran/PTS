<?php
$user = Session::get('auth');
$searchKeyword = Session::get('searchKeyword');
$keyword = '';
if($searchKeyword){
    $keyword = $searchKeyword['keyword'];
}
$status = session('status');
?>
@extends('layouts.app')

@section('content')
    <style>
        .table-input tr td:first-child {
            background: #f5f5f5;
            text-align: right;
            vertical-align: middle;
            font-weight: bold;
            padding: 3px;
            width:30%;
        }
        .table-input tr td {
            border:1px solid #bbb !important;
        }
        label {
            padding: 0px !important;
        }
    </style>
    <div class="col-md-9">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}</h3>
            </div>
            <div class="box-body">
                @if($status=='added')
                    <div class="alert alert-success">
                    <span class="text-success">
                        <i class="fa fa-check"></i> Successfully added!
                    </span>
                    </div>
                @endif
                    <form method="POST" action="{{ url('support/uers/add') }}" id="addUserForm">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" class="form-control" autofocus name="fname" required>
                                </div>
                                <div class="form-group">
                                    <label>Middle Name:</label>
                                    <input type="text" class="form-control" name="mname">
                                </div>
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" class="form-control" name="lname" required>
                                </div>
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input type="text" class="form-control" name="contact" required>
                                </div>
                                <div class="form-group">
                                    <label>Email Address <small class="text-muted"><em>(Optional):</em></small></label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <hr />

                                <div class="form-group">
                                    <label>Designation:</label>
                                    <input type="text" class="form-control" name="designation" required>
                                </div>
                                <div class="form-group">
                                    <label>Department:</label>
                                    <select class="form-control" name="department_id" required>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <hr />

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control username_1" name="username" required>
                                    <div class="username-has-error text-bold text-danger hide">
                                        <small>Username already taken!</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" pattern=".{3,}" title="Password - minimum of 3 character" class="form-control" id="password1" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" pattern=".{3,}" title="Confirm password - minimum of 3 Character" class="form-control" id="password2" name="confirm" required>
                                    <div class="password-has-error has-error text-bold text-danger hide">
                                        <small>Password not match!</small>
                                    </div>
                                    <div class="password-has-match has-match text-bold text-success hide">
                                        <small><i class="fa fa-check-circle"></i> Password matched!</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ url('support/users') }}" class="btn btn-default btn-sm" ><i class="fa fa-arrow-left"></i> Back</a>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </form>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('support.sidebar.quick')
    </div>
@endsection
@section('js')
    @include('script.filterMuncity')
    <script>
        $('#addUserForm').one('submit',function(e){
            proceed = 0;
            e.preventDefault();
            $('.loading').show();
            var string = $('.username_1').val();
            var link = "{{ url('support/users/check_username') }}/"+string;
            console.log(link);
            $.ajax({
                url: link,
                type: "GET",
                success: function(data){
                    if(data==1){
                        $('.username-has-error').removeClass('hide');
                    }else{
                        $('.username-has-error').addClass('hide');
                        proceed += 1;
                    }

                    var password1 = $('#password1').val();
                    var password2 = $('#password2').val();
                    if(password1 && password2){
                        if(password1==password2){
                            proceed += 1;
                            $('.password-has-error').addClass('hide');
                            $('.password-has-match').removeClass('hide');
                        }else{
                            $('.password-has-error').removeClass('hide');
                            $('.password-has-match').addClass('hide');
                        }
                    }

                    if(proceed==2){
                        $('#addUserForm').submit();
                    }else{
                        console.log('dont submit');
                        $('.loading').hide();
                    }
                }
            });


        });
    </script>
@endsection

