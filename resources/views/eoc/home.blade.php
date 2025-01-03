@extends('layouts.app')

@section('content')
    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>Facility List</h3>
            </div>
            <div class="box-body">
                @if(count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr class="bg-black">
                                <th></th>
                                <th>Facility Name</th>
                                <th>Level</th>
                                <th>Hospital Type</th>
                                <th>Option</th>
                            </tr>
                            <?php
                            $count = 0;
                            $province = [];
                            ?>
                            @foreach($data as $row)
                                <?php $count++; ?>
                                @if(!isset($province[$row->province]))
                                    <?php $province[$row->province] = true; ?>
                                    <tr>
                                        <td colspan="6"><strong class="text-green">{{ $row->province.' Province' }}</strong></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td><span class="badge bg-purple">{{ $row->level }}</span></td>
                                    <td><span class="{{ $row->hospital_type == 'government' ? 'badge bg-blue' : 'badge bg-blue' }}">{{ ucfirst($row->hospital_type) }}</span></td>
                                    <td width="12%"><button href="#select_inventory" onclick="InventoryLink({{ $row->id }});" data-toggle="modal" class="btn-xs btn-success"><i class="fa fa-plus"></i> Add Inventory</button></td>
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


    <div class="modal fade" role="dialog" id="select_inventory">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <label style="font-size: 15pt">Select Inventory</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <table class="table table-hover table-striped">
                        <tr>
                            <td><a href="#" class="bed_link"><label class="text-blue" ><i class="fa fa-stethoscope"></i> Bed</label></a></td>
                            <td><a href=""><label class="text-green"><i class="fa fa-stethoscope"></i> Room</label></a></td>
                        </tr>
                        <tr>
                            <td><label class="text-yellow"><i class="fa fa-stethoscope"></i> Laboratory</label></td>
                            <td><label class="text-red"><i class="fa fa-stethoscope"></i> X-ray</label></td>
                        </tr>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection

@section('js')
    <script>
        function InventoryLink(facility_id){
            $(".bed_link").attr("href","<?php echo asset('eoc_region/bed').'/'; ?>"+facility_id);
        }
    </script>
@endsection

