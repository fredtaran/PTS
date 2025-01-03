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
                @if($status=='updated')
                <div class="alert alert-success">
                    <span class="text-success">
                        <i class="fa fa-check"></i> Successfully updated!
                    </span>
                </div>
                @endif
                <form method="POST" class="form-horizontal form-submit" id="hospitalForm" action="{{ asset('support/hospital/update') }}">
                    {{ csrf_field() }}
                    <table class="table table-input table-bordered table-hover" border="1">
                        <tr>
                            <td>Facility Name :<br/></td>
                            <td><input type="text" name="facility_name" class="form-control" value="{{ $info->name }}" /></td>
                        </tr>
                        <tr>
                            <td>Short Name :<br/></td>
                            <td><input type="text" name="abbr" class="form-control" value="{{ $info->abbr }}" /></td>
                        </tr>
                        <tr class="has-group">
                            <td>Municipality/City :</td>
                            <td>
                                <select class="form-control muncity filter_muncity" name="muncity" required>
                                    <option value="">Select Municipal/City...</option>
                                    @foreach($muncity as $m)
                                        <option value="{{ $m->id }}">{{ $m->description }}</option>
                                    @endforeach
                                    <option value="others">Others</option>
                                </select>
                            </td>
                        </tr>

                        <tr class="has-group barangay_holder">
                            <td>Barangay :</td>
                            <td>
                                <select class="form-control barangay" name="brgy">
                                    <option value="">Select Barangay...</option>
                                </select>
                            </td>
                        </tr>

                        <tr class="has-group">
                            <td>Street No./Sitio/Purok :</td>
                            <td><input type="text" name="address" value="{{ $info->address }}" class="form-control" required /> </td>
                        </tr>
                        <tr>
                            <td>Contact :<br/></td>
                            <td><input type="text" name="contact" value="{{ $info->contact }}" class="form-control" required /></td>
                        </tr>
                        <tr>
                            <td>Email :<br/></td>
                            <td><input type="email" name="email" class="form-control" value="{{ $info->email }}" /></td>
                        </tr>
                        <tr>
                            <td>Status :</td>
                            <td>
                                <select name="status" class="form-control" required style="width: 100%">
                                    <option value="1" {{ ($info->status==1) ? 'selected':'' }}>Active</option>
                                    <option value="0" {{ ($info->status==0) ? 'selected':'' }}>Inactive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="fa fa-pencil"></i> Update
                                </button>
                            </td>
                        </tr>
                    </table>
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
        muncity_id = "{{ $info->muncity }}";
        var brgy_id = "{{ $info->brgy }}";
        if(muncity_id){
            $('.muncity').val(muncity_id);
            var brgy = getBarangay();
            $('.barangay').empty()
                .append($('<option>', {
                    value: '',
                    text : 'Select Barangay...'
                }));
            jQuery.each(brgy, function(i,val){
                $('.barangay').append($('<option>', {
                    value: val.id,
                    text : val.description
                }));

            });
            $('.barangay').val(brgy_id);
        }
        $('#hospitalForm').on('submit',function(){
            $('.loading').show();
        });
    </script>
@endsection

