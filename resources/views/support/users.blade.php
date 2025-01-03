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
                <form action="{{ url('support/users') }}" method="GET" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-sm" style="margin-bottom: 10px;">
                        <input type="text" style="width: 40%;" class="form-control" placeholder="Search name..." name="search" value="{{ $search }}">

                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-search"></i> Search
                        </button>

                        <a href="#filter_user" data-toggle="modal" class="btn btn-info btn-sm">
                            <i class="fa fa-filter"></i> Filter
                        </a>

                        <button type="button" class="btn btn-sm btn-warning" onclick="refreshPage()"><i class="fa fa-eye"></i> View All</button>

                        <a href="#addUserModal" data-toggle="modal" class="btn btn-primary btn-sm ">
                            <i class="fa fa-user-plus"></i> Add User
                        </a>
                    </div>
                </form>

                <div class="modal fade" role="dialog" id="filter_user">
                    <div class="modal-dialog modal-sm" role="document">
                        <form method="GET" action="{{ url('support/users') }}">
                            {{ csrf_field() }}
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Department:</label>
                                        <select class="form-control" name="department_id" required>
                                            <option value="">Select Department...</option>
                                            @foreach($group_by_department as $row)
                                                <option value="{{ $row->department_id }}">{{ $row->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-info"></i> Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <h3>
                    {{ $title }}
                    @foreach($group_by_department as $row)
                        <span class="badge bg-blue"> {{ $row->y }}</span> <span style="font-size: 8pt;">{{ $row->label }}</span>
                    @endforeach
                </h3>
            </div>

            <div class="box-body">
                @if(count($data)>0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr class="bg-black">
                            <th>Name</th>
                            <th>Department</th>
                            <th>Contact</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Last Login</th>
                        </tr>
                        @foreach($data as $row)
                        <tr>
                            <td>
                                <a href="#updateUserModal"
                                   data-toggle="modal"
                                   data-id = "{{ $row->id }}"
                                   class="title-info update_info">
                                <?php
                                    if($row->level == 'doctor')
                                        $abre = "Dr. ";
                                    else
                                        $abre = "";

                                    echo $abre.$row->fname . ' ' . $row->mname . ' ' . $row->lname;
                                ?>
                                </a>
                            </td>

                            <td>
                                <?php
                                    $department = \App\Models\Department::find($row->department_id);
                                    $description = '';
                                    if($department) {
                                        $description = $department->description;
                                    }
                                ?>
                                {{ $description }}
                            </td>

                            <td>
                                {{ $row->contact }}
                            </td>

                            <td>
                                {{ $row->username }}
                            </td>

                            <td>
                                <span class="{{ ($row->status == 'active') ? 'text-success': 'text-danger' }}">
                                    {{ strtoupper($row->status) }}
                                </span>
                            </td>

                            <td class="text-warning">
                                @if(!is_null($row->last_login))
                                {{ date('M d, Y h:i A', strtotime($row->last_login)) }}
                                @else
                                Never Login
                                @endif
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
                        <i class="fa fa-warning"></i> No doctors found!
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>

    @include('support.modal.addUser')
@endsection

@section('js')
@include('support.script.users')
@endsection

