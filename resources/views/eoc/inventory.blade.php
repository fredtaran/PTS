<?php
$user = Session::get('auth');
?>

@extends('layouts.app')

@section('content')
    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <div class="pull-right">
                    <form action="{{ asset('admin/facility') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-sm" style="margin-bottom: 10px;">
                            <input type="text" class="form-control" name="keyword" placeholder="Search inventory..." value="{{ Session::get("keyword") }}">
                            <button type="button" class="btn btn-success btn-sm btn-flat">
                                <i class="fa fa-search"></i> Search
                            </button>
                            <button type="button" value="view_all" name="view_all" class="btn btn-warning btn-sm btn-flat">
                                <i class="fa fa-eye"></i> View All
                            </button>
                        </div>
                    </form>
                </div>
                <h3>Level of Care Inventory</h3>
                <h4 class="text-green">{{ \App\Facility::find($facility_id)->name }}</h4>
                <table class="table table-hover table-bordered" style="width: 40%">
                    <tr>
                        <td >No.of {{ \App\Inventory::where("name","Patients Waiting for Admission")->where("facility_id",$facility_id)->first()->name }} :</td>
                        <td width="7%"><b class="text-red" style="font-size: 15pt;">{{ \App\Inventory::where("name","Patients Waiting for Admission")->where("facility_id",$facility_id)->first()->capacity }}</b></td>
                        <td width="7%"><button class="btn btn-sm btn-success" href="#bed_modal" data-toggle="modal" onclick="inventoryUpdate({{ \App\Inventory::where("name","Patients Waiting for Admission")->where("facility_id",$facility_id)->first()->id }})">Update</button></td>
                    </tr>
                </table>
            </div>
            <div class="box-body">
                @if(count($inventory) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr class="bg-black">
                                <th></th>
                                <th>Description</th>
                                <th>Capacity</th>
                                <th>Occupied</th>
                                <th>Available</th>
                                <th>Option</th>
                            </tr>
                            <?php $count=0; ?>
                            @foreach($inventory as $row)
                                <?php $count++; ?>
                                @if($row->name != 'Patients Waiting for Admission')
                                <tr >
                                    <td>{{ $count }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        <strong class="text-blue" id="capacity">
                                            {{ $row->capacity }}
                                        </strong>
                                    </td>
                                    <td>
                                        <strong class="text-blue" id="occupied">
                                            {{ $row->occupied }}
                                        </strong>
                                    </td>
                                    <td>
                                        {{ $row->capacity - $row->occupied }}
                                    </td>
                                    <td width="7%"><button class="btn btn-sm btn-success" href="#bed_modal" data-toggle="modal" onclick="inventoryUpdate({{ $row->id }})">Update</button></td>
                                </tr>
                                @endif
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


    <form method="POST" action="{{ asset('inventory/update/save') }}">
        <div class="modal fade" role="dialog" id="bed_modal">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content inventory_update">
                    <center>
                        <img src="{{ asset('img/loading.gif') }}" alt="">
                    </center>
                </div>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
    

@endsection

@section('js')
    <script>
        @if(Session::get('inventory_update'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully updated inventory!",
            size: 'mini',
            rounded: true
        });
        <?php Session::put("inventory_update",false); ?>
        @endif
    </script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script>
        /*$.fn.editable.defaults.mode = 'popup';
        $(document).ready(function() {
            $('#capacity').editable();
            $('#occupied').editable();
        });*/

        function inventoryUpdate(inventory_id){
            var json = {
                "inventory_id" : inventory_id,
                "_token" : "<?php echo csrf_token()?>"
            };
            var url = "<?php echo asset('inventory/update/page') ?>";
            $.post(url,json,function(result){
                $(".inventory_update").html(result);
            })
        }
    </script>
@endsection

