<?php
$user = Auth::user();
$searchKeyword = Session::get('searchKeyword');
$keyword = '';
if($searchKeyword) {
    $keyword = $searchKeyword['keyword'];
}
?>
@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px;
        }
        .form-group {
             margin-bottom: 10px;
        }
    </style>
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <form action="{{ url('doctor/affiliated') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-sm" style="margin-bottom: 10px;">
                        <input type="text" style="width: 40%;" class="form-control" placeholder="Search name..." name="search" value="{{ $searchKeyword }}">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="refreshPage()"><i class="fa fa-eye"></i> View All</button>
                        <a href="#addFacilityModal" data-toggle="modal" class="btn btn-primary btn-sm affiliated_body_click">
                            <i class="fa fa-user-plus"></i> Add Facility
                        </a>
                    </div>
                </form>

                <h3>
                    {{ @$title }}
                </h3>
            </div>

            <div class="box-body">
                @if(count($data) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Code</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Chief Hospital</th>
                            <th>Level</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>

                        @foreach($data as $row)
                        <tr>
                            <td>
                                {{$row->facility_code}}
                            </td>

                            <td>
                                {{ $row->name }}
                            </td>

                            <td>
                                {{ $row->address }}
                            </td>

                            <td>
                            {{ $row->chief_hospital }}
                            </td>

                            <td>
                            {{ $row->level }}
                            </td>

                            <td>
                            {{ $row->hospital_type }}
                            </td>

                            <td>
                                <button class="btn btn-sm btn-danger btn-action delete_affiliated_btn"
                                    title="Delete Affiliated"
                                    data-toggle="modal"
                                    data-toggle="tooltip"
                                    data-id="{{ $row->main_id }}">
                                     <i class="fa fa-times"></i> Delete
                                 </button>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="pagination">
                        {{ $data->links() }}
                    </div>
                </div>
                @else
                <div class="alert alert-warning">
                    <span class="text-warning">
                        <i class="fa fa-warning"></i> No Facility found!
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>

@include('doctor.modal.affiliated')
@endsection
@section('js')
@include('doctor.script.affiliatedjs')
@endsection