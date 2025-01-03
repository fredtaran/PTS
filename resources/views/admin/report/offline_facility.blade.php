@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px !important;
        }
    </style>

    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <div class="pull-right">
                    <form action="{{ asset('offline/facility') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-sm">
                            <input type="text" class="form-control" name="day_date" value="{{ date('m/d/Y',strtotime($day_date)) }}" placeholder="Filter your date here..." id="onboard_picker">
                            <button type="submit" class="btn-sm btn-info btn-flat"><i class="fa fa-search"></i> Filter</button>
                        </div>
                    </form>
                </div>
                @if(Auth::user()->level == 'admin')
                <h3>
                    Call Center IT support<br>
                    <?php
                    $call_center = \App\User::where('level','admin')->get();
                    ?>
                    @foreach($call_center as $row)
                        <?php
                        $it_name = $row->fname.' '.$row->mname.' '.$row->lname;
                        $date_now = date('Y-m-d');
                        $call_count = \App\OfflineFacilityRemark::where("remark_by",$row->id)->count();
                        ?>
                        <span class="badge bg-blue"> {{ $call_count }}</span> <span style="font-size: 8pt;">{{ $it_name }}</span>
                    @endforeach
                </h3>
                @else
                <h3>Offline Facility</h3>
                @endif
            </div>

            <div class="box-body">
                @if(count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-fixed-header">
                            <thead class='header'>
                                <tr class="bg-black">
                                    <th></th>
                                    <th>Facility Name</th>
                                    <th>Chief Hospital</th>
                                    <th>Contact No</th>
                                    <th>Hospital Type</th>
                                    <th width="30%">Remarks</th>
                                </tr>
                            </thead>

                            <?php
                            $count = 0;
                            $facility_onboard[1] = 0;
                            $facility_total[1] = 0;
                            $facility_onboard[2] = 0;
                            $facility_total[2] = 0;
                            $province = [];
                            ?>
                            @foreach($data as $row)
                            <?php
                            $count++;

                            if($row->status == 'onboard')
                                $facility_onboard[$row->province_id]++;

                            $facility_total[$row->province_id]++;
                            ?>
                            @if(!isset($province[$row->province]))
                                <?php $province[$row->province] = true; ?>
                                <tr>
                                    <td colspan="5">
                                        <strong class="text-green">{{ $row->province }}</strong>
                                    </td>
                                </tr>
                            @endif
                            <tr class="@if($row->status == 'onboard'){{ 'bg-yellow' }}@endif">
                                <td>{{ $count }}</td>
                                <td class="@if($row->transaction == 'no_transaction' && $row->status == 'onboard'){{ 'bg-red' }}@endif">{{ $row->name }}</td>
                                <td>{{ $row->chief_hospital }}</td>
                                <td width="10%">{{ $row->contact }}</td>
                                <td>
                                    <span class="
                                        <?php
                                            if($row->hospital_type == 'government'){
                                                echo 'badge bg-green';
                                            }
                                            elseif($row->hospital_type == 'private'){
                                                echo 'badge bg-blue';
                                            }
                                            elseif($row->hospital_type == 'RHU'){
                                                echo 'badge bg-yellow';
                                            }
                                            ?>
                                    ">{{ ucfirst($row->hospital_type) }}</span>
                                </td>
                                <td>
                                    <?php
                                        $offline_facility_remark = \App\Models\OfflineFacilityRemark::where("facility_id", $row->facility_id)->where("created_at", "like", "%$day_date%")->get();
                                    ?>
                                    @if(count($offline_facility_remark) > 0)
                                        @foreach($offline_facility_remark as $offline_remark)
                                            <?php
                                            $remark_by = \App\User::find($offline_remark->remark_by);
                                            $remark_by = $remark_by->fname.' '.$remark_by->mname.' '.$remark_by->lname;
                                            ?>
                                            <h3 >{{ $remark_by }}</h3>
                                            <div style="margin-left: 10px;">
                                                <span class="text-green">{!! $offline_remark->remarks !!}</span>
                                                <br>
                                                <small class="text-yellow"><i>({{ date("F j, Y, g:i a",strtotime($offline_remark->created_at)) }})</i></small>
                                            </div>
                                        @endforeach
                                        @if(Session::get('auth')->level == 'admin')
                                            <button class="btn btn-xs btn-info" href="#add_offline_remark" data-toggle="modal" onclick="addRemark(
                                            '{{ $row->facility_id }}'
                                            )"><i class="fa fa-sticky-note"></i> Add more remark</button>
                                        @endif
                                    @else
                                        @if(Auth::user()->level == 'admin')
                                            <button class="btn btn-xs btn-primary" href="#add_offline_remark" data-toggle="modal" onclick="addRemark(
                                            '{{ $row->facility_id }}'
                                            )"><i class="fa fa-sticky-note"></i> Add remark</button>
                                        @endif
                                    @endif
                                </td>
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

    <div class="modal fade" role="dialog" id="add_offline_remark">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body offline_remark">

                </div><!-- /.modal-content -->
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section('css')

@endsection

@section('js')
    <script language='javascript' type='text/javascript'>
        $(document).ready(function() {
            // $('.table-fixed-header').fixedHeader();
        });
    </script>

    <script>
        $("#container").removeClass("container");
        $("#container").addClass("container-fluid");

        @if(Session::get('add_offline_remark'))
            Lobibox.notify('success', {
                title: "",
                msg: "Successfully added offline remarks",
                size: 'mini',
                rounded: true
            });
            <?php Session::put("add_offline_remark", false); ?>
        @endif

        //Date range picker
        $('#onboard_picker').daterangepicker({
            "singleDatePicker": true
        });
        function addRemark(facility_id) {
            $(".offline_remark").html(loading);
            var json = {
                "_token" : "<?php echo csrf_token(); ?>",
                "facility_id" : facility_id
            };
            console.log(json);
            var url = "<?php echo asset('offline/facility/remark') ?>";
            $.post(url, json, function(result) {
                setTimeout(function(){
                    $(".offline_remark").html(result);
                }, 500);
            })
        }
    </script>
@endsection

