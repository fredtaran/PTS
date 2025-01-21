@extends('layouts.app')

@section('content')
    <style>
        .editable-empty{
            color: #ff3d3c;
        }
    </style>
    <div class="box box-success">
        <div class="box-body">
            <div class="box-header with-border">
                <h5>Bed Availability as of <i id="time"></i></h5>
            </div>

            <div class="table-responsive" style="font-size: 7pt;">
                <table class="table table-hover table-striped" border="1">
                    <thead>
                    <tr >
                        <th rowspan="4" class="bg-info" style="vertical-align: middle;border-right: black"><center>Name of Hospital</center></th>
                        <th class="bg-success" style="vertical-align: middle;border-left: black" rowspan="4"><center>Hospital Category</center></th>
                        <th style="background-color: rgb(251, 233, 218);border-top: black;" colspan="28"><center>Number of Available Beds</center></th>
                        <th style="border-top: black;" class="info" colspan="8"><center>Number of Waitlist</center></th>
                        <th class="bg-pink" style="background-color: #ffb3b8;width: 10%;vertical-align: middle;margin-left: 20px;border-top: black" rowspan="4"><center>Remarks</center></th>
                        <th class="bg-pink" style="background-color: #ffb3b8;vertical-align: middle;border-top: black;" rowspan="4"><center>Encoded By</center></th>
                    </tr>
                    <tr>
                        <th colspan="8" class="danger"><center>COVID BEDS</center></th>
                        <th class="info" colspan="2"><center>Mechanical Ventilators</center></th>
                        <th class="warning" colspan="16"><center>Non-COVID BEDS</center></th>
                        <th class="info" colspan="2"><center>Mechanical Ventilators</center></th>
                        <th class="danger" colspan="2" rowspan="2" style="vertical-align: middle"><center>COVID BEDS</center></th>
                        <th class="warning" colspan="6" rowspan="2" style="vertical-align: middle"><center>Non-COVID BEDS</center></th>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>Emergency Room (ER)</center></th>
                        <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>ICU - Intensive Care Units</center></th>
                        <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>COVID Beds</center></th>
                        <th colspan="2" class="success"><center>Isolation Beds</center></th>
                        <th class="info"><center>Used</center></th>
                        <th class="info"><center>Vacant</center></th>
                        <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>Emergency Room (ER)</center></th>
                        <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>ICU - Intensive Care Units</center></th>
                         <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>Ward</center></th>
                         <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>Private</center></th>
                         <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>Semi-Private</center></th>
                         <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>Suite</center></th>
                        <th colspan="2" style="background-color: rgb(252, 233, 219);"><center>Regular Beds</center></th>
                        <th colspan="2" class="success"><center>Isolation Beds</center></th>
                        <th class="info"><center>Used</center></th>
                        <th class="info"><center>Vacant</center></th>
                    </tr>
                    <tr>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th class="success">Vacant</th>
                        <th class="success">Occupied</th>
                        <th class="info"></th>
                        <th class="info"></th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th style="background-color: rgb(252, 233, 219);">Vacant</th>
                        <th style="background-color: rgb(252, 233, 219);">Occupied</th>
                        <th class="success">Vacant</th>
                        <th class="success">Occupied</th>
                        <th class="info"></th>
                        <th class="info"></th>
                        <th class="danger"><center>Emergency Room (ER)</center></th>
                        <th class="danger"><center>ICU - Intensive Care Units</center></th>
                        <th class="warning"><center>Emergency Room (ER)</center></th>
                        <th class="warning"><center>ICU - Intensive Care Units</center></th>
                        <th class="warning"><center>Ward</center></th>
                        <th class="warning"><center>Private</center></th>
                        <th class="warning"><center>Semi-Private</center></th>
                        <th class="warning"><center>Suite</center></th>
                    </tr>
                    </thead>
                    <tr>
                        <td><b class="text-success">{{ $facility->name }}</b></td>
                        <td><b class="text-success"><center>{{ ucfirst($facility->level) }}</center></b></td>
                        <td><a href="#" class="text_editable" id="emergency_room_covid_vacant" data-title="emergency_room_covid_vacant" style="font-size: 10pt;">{{ $facility->emergency_room_covid_vacant }}</a></td>
                        <td><a href="#" class="text_editable" id="emergency_room_covid_occupied" data-title="emergency_room_covid_occupied" style="font-size: 10pt;">{{ $facility->emergency_room_covid_occupied }}</a></td>
                        <td><a href="#" class="text_editable" id="icu_covid_vacant" data-title="icu_covid_vacant" style="font-size: 10pt;">{{ $facility->icu_covid_vacant }}</a></td>
                        <td><a href="#" class="text_editable" id="icu_covid_occupied" data-title="icu_covid_occupied" style="font-size: 10pt;">{{ $facility->icu_covid_occupied }}</a></td>
                        <td><a href="#" class="text_editable" id="beds_covid_vacant" data-title="beds_covid_vacant" style="font-size: 10pt;">{{ $facility->beds_covid_vacant }}</a></td>
                        <td><a href="#" class="text_editable" id="beds_covid_occupied" data-title="beds_covid_occupied" style="font-size: 10pt;">{{ $facility->beds_covid_occupied }}</a></td>
                        <td><a href="#" class="text_editable" id="isolation_covid_vacant" data-title="isolation_covid_vacant" style="font-size: 10pt;">{{ $facility->isolation_covid_vacant }}</a></td>
                        <td><a href="#" class="text_editable" id="isolation_covid_occupied" data-title="isolation_covid_occupied" style="font-size: 10pt;">{{ $facility->isolation_covid_occupied }}</a></td>
                        <td><a href="#" class="text_editable" id="mechanical_used_covid" data-title="mechanical_used_covid" style="font-size: 10pt;">{{ $facility->mechanical_used_covid }}</a></td>
                        <td><a href="#" class="text_editable" id="mechanical_vacant_covid" data-title="mechanical_vacant_covid" style="font-size: 10pt;">{{ $facility->mechanical_vacant_covid }}</a></td>
                        <td><a href="#" class="text_editable" id="emergency_room_non_vacant" data-title="emergency_room_non_vacant" style="font-size: 10pt;">{{ $facility->emergency_room_non_vacant }}</a></td>
                        <td><a href="#" class="text_editable" id="emergency_room_non_occupied" data-title="emergency_room_non_occupied" style="font-size: 10pt;">{{ $facility->emergency_room_non_occupied }}</a></td>
                        <td><a href="#" class="text_editable" id="icu_non_vacant" data-title="icu_non_vacant" style="font-size: 10pt;">{{ $facility->icu_non_vacant }}</a></td>
                        <td><a href="#" class="text_editable" id="icu_non_occupied" data-title="icu_non_occupied" style="font-size: 10pt;">{{ $facility->icu_non_occupied }}</a></td>
                        <td><a href="#" class="text_editable" id="ward_wait_vacant" data-title="ward_wait_vacant" style="font-size: 10pt;">{{$facility->ward_wait_vacant}}</a></td>
                        <td><a href="#" class="text_editable" id="ward_wait_occupied" data-title="ward_wait_occupied" style="font-size: 10pt;">{{$facility->ward_wait_occupied}}</a></td>
                        <td><a href="#" class="text_editable" id="private_wait_vacant" data-title="private_wait_vacant" style="font-size: 10pt;">{{$facility->private_wait_vacant}}</a></td>
                        <td><a href="#" class="text_editable" id="private_wait_occupied" data-title="private_wait_occupied" style="font-size: 10pt;">{{$facility->private_wait_occupied}}</a></td>
                        <td><a href="#" class="text_editable" id="semi_private_wait_vacant" data-title="semi_private_wait_vacant" style="font-size: 10pt;">{{$facility->semi_private_wait_vacant}}</a></td>
                        <td><a href="#" class="text_editable" id="semi_private_wait_occupied" data-title="semi_private_wait_occupied" style="font-size: 10pt;">{{$facility->semi_private_wait_occupied}}</a></td>
                        <td><a href="#" class="text_editable" id="suite_wait_vacant" data-title="suite_wait_vacant" style="font-size: 10pt;">{{$facility->suite_wait_vacant}}</a></td>
                        <td><a href="#" class="text_editable" id="suite_wait_occupied" data-title="suite_wait_occupied" style="font-size: 10pt;">{{$facility->suite_wait_occupied}}</a></td>
                        <td><a href="#" class="text_editable" id="beds_non_vacant" data-title="beds_non_vacant" style="font-size: 10pt;">{{ $facility->beds_non_vacant }}</a></td>
                        <td><a href="#" class="text_editable" id="beds_non_occupied" data-title="beds_non_occupied" style="font-size: 10pt;">{{ $facility->beds_non_occupied }}</a></td>
                        <td><a href="#" class="text_editable" id="isolation_non_vacant" data-title="isolation_non_vacant" style="font-size: 10pt;">{{ $facility->isolation_non_vacant }}</a></td>
                        <td><a href="#" class="text_editable" id="isolation_non_occupied" data-title="isolation_non_occupied" style="font-size: 10pt;">{{ $facility->isolation_non_occupied }}</a></td>
                        <td><a href="#" class="text_editable" id="mechanical_used_non" data-title="mechanical_used_non" style="font-size: 10pt;">{{ $facility->mechanical_used_non }}</a></td>
                        <td><a href="#" class="text_editable" id="mechanical_vacant_non" data-title="mechanical_vacant_non" style="font-size: 10pt;">{{ $facility->mechanical_vacant_non }}</a></td>
                        <td><a href="#" class="text_editable" id="emergency_room_covid_wait" data-title="emergency_room_covid_wait" style="font-size: 10pt;">{{ $facility->emergency_room_covid_wait }}</a></td>
                        <td><a href="#" class="text_editable" id="icu_covid_wait" data-title="icu_covid_wait" style="font-size: 10pt;">{{ $facility->icu_covid_wait }}</a></td>
                        <td><a href="#" class="text_editable" id="emergency_room_non_wait" data-title="emergency_room_non_wait" style="font-size: 10pt;">{{ $facility->emergency_room_non_wait }}</a></td>
                        <td><a href="#" class="text_editable" id="icu_non_wait" data-title="icu_non_wait" style="font-size: 10pt;">{{ $facility->icu_non_wait }}</a></td>
                        <td><a href="#" class="text_editable" id="ward_wait" data-title="ward_wait" style="font-size: 10pt;">{{$facility->ward_wait}}</a></td>
                        <td><a href="#" class="text_editable" id="private_wait" data-title="private_wait" style="font-size: 10pt;">{{$facility->private_wait}}</a></td>
                        <td><a href="#" class="text_editable" id="semi_private_wait" data-title="semi_private_wait" style="font-size: 10pt;">{{$facility->semi_private_wait}}</a></td>
                        <td><a href="#" class="text_editable" id="suite_wait" data-title="suite_wait" style="font-size: 10pt;">{{$facility->suite_wait}}</a></td>
                        <td><a href="#" class="text_editable" id="remarks" data-title="remarks" >{{ $facility->remarks }}</a></td>
                        <td>
                            <?php
                            $encoded_by = \App\BedTracker::
                            select("bed_tracker.id","users.fname","users.mname","users.lname","bed_tracker.created_at")
                                ->leftJoin("users","users.id","=","bed_tracker.encoded_by")
                                ->where("bed_tracker.facility_id","=",$facility->id)
                                ->where("users.level","!=","opcen")
                                ->orderBy("bed_tracker.id","desc")
                                ->first();
                            $created_at = $encoded_by->created_at;
                            $encoded_by = ucfirst($encoded_by->fname).' '.strtoupper($encoded_by->mname[0]).'. '.ucfirst($encoded_by->lname);
                            echo "<span id='encoded_by'>".$encoded_by."</span>";
                            ?><br>
                            @if($created_at)
                                <small class="text-blue" id="encoded_date">{{ date("F d,Y",strtotime($created_at)) }}</small><br>
                                <small class="text-yellow" id="encoded_time">({{ date('g:i a',strtotime($created_at)) }})</small>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{ asset('plugin/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
    <script>
        $("#container").removeClass("container");
        $("#container").addClass("container-fluid");

        var timeDisplay = document.getElementById("time");
        function refreshTime() {
            var dateString = new Date().toLocaleString("en-US");
            var formattedString = dateString.replace(", ", " - ");
            timeDisplay.innerHTML = formattedString;
        }
        setInterval(refreshTime, 1000);

        //turn to inline mode
        $.fn.editable.defaults.mode = 'popup';
        //editables
        $(".text_editable").each(function(){
            $('#'+this.id).editable({
                type : this.id == 'remarks' ? 'textarea' : 'text',
                name: 'username',
                title: $(this).data("title"),
                emptytext: 'empty',
                success: function(response, newValue) {
                    var url = "<?php echo asset('bed_update'); ?>";
                    var json = {
                        "_token" : "<?php echo csrf_token(); ?>",
                        "facility_id" : "<?php echo $facility->id; ?>",
                        "column" : this.id,
                        "value" : newValue
                    };
                    var title = $(this).data("title");
                    $.post(url,json,function(result){
                        $("#encoded_by").html(result.encoded_by);
                        $("#encoded_date").html(result.encoded_date);
                        $("#encoded_time").html(result.encoded_time);
                        Lobibox.notify('success', {
                            title: "",
                            msg: title+" saved!",
                            size: 'mini',
                            rounded: true,
                            sound: false
                        });
                    });
                }
            });
        });
    </script>
@endsection

