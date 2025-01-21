@extends('layouts.app')

@section('content')
    <div class="box box-success">
        <div class="box-body">
            <div class="box-header with-border">
                <h3>
                    All Incident
                    <form action="{{ asset('doctor/report/incidentIndex') }}" method="POST" class="form-inline pull-right" style="margin-right: 30%">
                        {{ csrf_field() }}
                        <div class="form-group-sm">
                            <input type="text" class="form-control active" name="date_range" value="{{ date("m/d/Y",strtotime($date_start)).' - '.date("m/d/Y",strtotime($date_end)) }}" placeholder="Filter your daterange here..." id="consolidate_date_range" autocomplete="off">
                            <button type="submit" class="btn-sm btn-info btn-flat" onclick="loadPage();"><i class="fa fa-search"></i> Filter</button>
                        </div>
                    </form>
                </h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-responsive">
                    <tr>
                        <th></th>
                        <th>Patient Code</th>
                        <th>Encoded By</th>
                        <th>Referred From</th>
                        <th>Referred To</th>
                        <th>Date Accepted</th>
                        <th>Reason</th>
                        <th>Incident type</th>
                    </tr>
                    @foreach($data as $row)
                        <tr>
                            <td width="5%" style="vertical-align:top">
                            <a href="{{ asset('doctor/referred?referredCode=').$row->patient_code }}" id="inci_view" class="btn btn-sm btn-success" target="_blank">
                                    <i class="fa fa-stethoscope"></i> Track
                                </a>
                            </td>
                            <?php $user = Session::get('auth');?>
                            @if($row->from_id == $user->facility_id)
                            <td class=""> {{ $row->patient_code }}</td>
                            @else
                             <td class="">
                                  <a href="#incident" class="inc"
                                        data-id = "{{$row->id}}"
                                        data-referred_from = "{{$row->from_id}}"
                                       data-toggle="modal"
                                       data-code="{{ $row->patient_code }}">
                                       {{ $row->patient_code }}
                                    </a>
                          
                            </td>
                            @endif
                            <td width="23%;">
                            {{$row->encoded_by_name}}
                            </td>
                            <td width="23%;">
                            {{$row->referred_from}}
                            </td>
                            <td width="23%;">
                            {{$row->referred_to}}
                            </td>
                            <td width="23%;">
                            {{$row->created_at}}
                            </td>
                            <td width="13%">
                            {{$row->reason}}
                            </td>
                            <td>
                            {{$row->inci_type}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="add_remark">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body monitoring_remark">

                </div><!-- /.modal-content -->
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection
@include('modal.accept')

@section('js')
    <script>
 @if(Session::get('incidentadd'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("incidentadd_message"); ?>",
            size: 'mini',
            rounded: true,
            sound: false
        });
    <?php
        Session::put("incidentadd",false);
        Session::put("incidentadd_message",false)
    ?>
@endif

 $(".inc").click(function() {
   var  code = $(this).data('code');
    var id = $(this).data('id');
    var referred_from = $(this).data('referred_from');

    var json;
            json = {
                 "referred_from" : referred_from,
                    "inci_id" : id,
                    "_token" : "<?php echo csrf_token()?>"
                     };
            var url = "<?php echo asset('admin/incident/body') ?>";
         $.post(url,json,function(result){
            $('input#patient_code').val(code);
            $(".inci_body").html(result);
             })
    });
        //Date range picker
        $('#consolidate_date_range').daterangepicker();

        @if(Session::get('add_remark'))
        Lobibox.notify('success', {
            title: "",
            msg: "Successfully added ramark!",
            size: 'mini',
            rounded: true,
            sound: false
        });
        <?php Session::put("add_remark",false); ?>
        @endif

        function addRemark(activity_id,code,referring_facility,referred_to){
            $(".monitoring_remark").html(loading);
            var json = {
                "_token" : "<?php echo csrf_token()?>",
                "activity_id" : activity_id,
                "code" : code,
                "referring_facility" : referring_facility,
                "referred_to" : referred_to
            };
            console.log(json);
            var url = "<?php echo asset('monitoring/remark') ?>";
            $.post(url,json,function(result){
                setTimeout(function(){
                    $(".monitoring_remark").html(result);
                },500);
            })
        }
    </script>
@endsection

