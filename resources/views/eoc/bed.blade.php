@extends('layouts.app')

@section('content')
    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <div class="pull-right">
                    <form action="{{ asset('admin/facility') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-sm" style="margin-bottom: 10px;">
                            <input type="text" class="form-control" name="keyword" placeholder="Search bed..." value="{{ Session::get("keyword") }}">
                            <button type="submit" class="btn btn-success btn-sm btn-flat">
                                <i class="fa fa-search"></i> Search
                            </button>
                            <button type="submit" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                                <i class="fa fa-eye"></i> View All
                            </button>
                            <a href="#bed_modal" data-toggle="modal" class="btn btn-info btn-sm btn-flat">
                                <i class="fa fa-hospital-o"></i> Add Bed
                            </a>
                        </div>
                    </form>
                </div>
                <h3>Manage Bed</h3>
            </div>
            <div class="box-body">
                @if(count($bed) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr class="bg-black">
                                <th></th>
                                <th>Bed Name</th>
                                <th>Temporary</th>
                                <th>Allowable No. of Patients</th>
                                <th>Actual No. of Patients</th>
                            </tr>
                            <?php $count=0; ?>
                            @foreach($bed as $row)
                                <?php $count++; ?>
                                <tr >
                                    <td>{{ $count }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ ucfirst($row->temporary) }}</td>
                                    <td>{{ $row->allowable_no }}</td>
                                    <td>{{ $row->actual_no }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <span class="text-warning">
                            <i class="fa fa-warning"></i> No data found!
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <form method="POST" action="{{ asset('eoc_region/bed/add') }}">
        <div class="modal fade" role="dialog" id="bed_modal">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body facility_body">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend><i class="fa fa-plus"></i> Add Bed</legend>
                        </fieldset>
                        <input type="hidden" name="facility_id" value="{{ $facility_id }}">
                        <div class="form-group">
                            <label>Bed name:</label>
                            <input type="text" class="form-control" autofocus name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Temporary:</label>
                            <select name="temporary" class="form-control" required>
                                <option value="">Select option</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Allowable No. of Patients:</label>
                            <input type="number" class="form-control" name="allowable" required>
                        </div>
                        <div class="form-group">
                            <label>Actual No. of Patients:</label>
                            <input type="number" class="form-control" name="actual" required>
                        </div>
                    </div><!-- /.modal-content -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
                    </div>
                </div>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>


@endsection

@section('js')
    <script>
        @if(Session::get('bed'))
            Lobibox.notify('success', {
                title: "",
                msg: "Successfully added bed!",
                size: 'mini',
                rounded: true
            });
            <?php Session::put("bed",false); ?>
        @endif
    </script>
@endsection

