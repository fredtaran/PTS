<?php
$user = Auth::user();
$searchKeyword = Session::get('searchKeyword');
$keyword = '';
if($searchKeyword){
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
                <h3>{{ $title }}</h3>

                <form action="{{ url('admin/users') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="Search name..." value="{{ $search }}">
                        </div>

                        <div class="col-md-4">
                            <select name="facility_filter" class="select2 form-control">
                                <option value="">Select Facility</option>
                                @foreach($facility as $row)
                                    <option value="{{ $row->id }}" <?php if($facility_filter == $row->id)echo 'selected'; ?>>{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-sm btn-flat">
                                <i class="fa fa-search"></i> Search
                            </button>

                            <button type="button" class="btn btn-warning" onclick="refreshPage()"><i class="fa fa-eye"></i> View All</button>
                            
                            @if ($user->facility_id != 25)
                                <a href="#users_modal" data-toggle="modal" data-id="no_id" class="btn btn-primary btn-sm btn-flat add_info">
                                    <i class="fa fa-user-plus"></i> Add User
                                </a>
                            @else
                                <a href="{{ url('support/uers/add') }}" class="btn btn-primary btn-sm btn-flat">
                                    <i class="fa fa-user-plus"></i> Add User
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <div class="box-body">
                @if (count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr class="bg-black">
                                <th>Name</th>
                                <th>Facility</th>
                                <th>Level</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Last Login</th>
                            </tr>

                            @foreach($data as $row)
                            <tr>
                                <td style="width: 8%;">
                                    <a href="#users_modal"
                                        data-toggle="modal"
                                        data-id = "{{ $row->id }}"
                                        class="title-info update_info">
                                        {{ $row->fname }} {{ $row->mname }} {{ $row->lname }}
                                        <br><i>
                                            <small class="text-warning">
                                                ( {{ $row->email }} )
                                            </small>
                                        </i>
                                    </a>
                                </td>
                                <td>

                                    {{ \App\Models\Facility::find($row->facility_id)->name ?? '' }}
                                </td>
                                <td>
                                    {{ $row->level }}<br />
                                </td>
                                <td>
                                    {{ $row->username }}
                                </td>
                                <td>
                                    <?php
                                        $status = ($row->login_status=='login') ? 'Login': 'Logout';
                                        $class = ($row->login_status=='login') ? 'text-success': 'text-danger';
                                    ?>
                                    <strong><span class="{{ $class }}">{{ $status }}</span></strong>
                                </td>
                                <td class="text-warning">
                                    <?php
                                        $status = ($row->login_status=='login') ? 'Login': 'Logout';
                                        $class = ($row->login_status=='login') ? 'text-success': 'text-danger';
                                    ?>
                                    @if(!is_null($row->last_login))
                                        {{ date('M d, Y h:i A',strtotime($row->last_login)) }}
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
                            <i class="fa fa-warning"></i> No IT support user found!
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('admin.modal.addUser')
@endsection

@section('js')
    @include('admin.script.users')
    <script>
        $("#container").removeClass("container");
        $("#container").addClass("container-fluid");
        @if(Session::get('manage_user'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get('manage_user'); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });
            <?php
                Session::put("manage_user", false);
            ?>
        @endif
    </script>
@endsection

