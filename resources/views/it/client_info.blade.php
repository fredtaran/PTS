<div class="row">
    <div class="col-md-12">
        <fieldset>
            <legend>
                <i class="fa fa-user-secret"></i> Client Info
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </legend>
        </fieldset>
        <h4 class="text-blue"><i class="fa fa-phone-square"></i> Call Classification</h4>
        <div>
    <span class="label label-success" style="margin-left: 5%;margin-top: -1%">
        <?php
        if($client->call_classification == 'new_call')
            echo "New Call";
        else
            echo "Repeat Call";
        ?>
    </span>
        </div><br>
        <h4 class="text-blue"><i class="fa fa-user"></i> Personal Information</h4>
        <div class="row" style="padding: 1%;margin-top: -1%;">
            <div class="col-md-4">
                <small>Time Started</small><br>
                &nbsp;&nbsp;<span class="text-yellow" >{{ date('F d, Y H:i:s',strtotime($client->time_started)) }}</span>
            </div>
            <div class="col-md-4">
                <small>Time Ended</small><br>
                &nbsp;&nbsp;<span class="text-yellow" >{{ date('F d, Y H:i:s',strtotime($client->time_ended)) }}</span>
            </div>
            <div class="col-md-4">
                <small>Time Duration</small><br>
                &nbsp;&nbsp;<span class="text-yellow" >
            {{ date('H:i:s',strtotime($client->time_duration)) }}
        </span>
            </div>
        </div>
        <div class="row" style="padding: 1%;">
            <div class="col-md-4">
                <small>Name</small><br>
                &nbsp;&nbsp;<span class="text-yellow">{{ $client->name }}</span>
            </div>
            <div class="col-md-4">
                <small>Facility Name</small><br>
                &nbsp;&nbsp;<span class="text-yellow">
            <?php
                    $facility = \App\Facility::find($client->facility_id);
                    if($facility)
                        echo $facility->name;
                    ?>
        </span>
            </div>
            <div class="col-md-4">
                <small>Department</small><br>
                &nbsp;&nbsp;<span class="text-yellow">{{ $client->department }}</span>
            </div>
        </div>
        <div class="row" style="padding: 1%">
            <div class="col-md-4">
                <small>Designation</small><br>
                &nbsp;&nbsp;<span class="text-yellow">{{ $client->designation }}</span>
            </div>
            <div class="col-md-4">
                <small>Active contact number:</small><br>
                &nbsp;&nbsp;<span class="text-yellow">{{ $client->contact_no }}</span>
            </div>
            <div class="col-md-4">
                <small>Email Address:</small><br>
                &nbsp;&nbsp;<span class="text-yellow">{{ $client->email }}</span>
            </div>
        </div>
        <div class="row" style="padding: 1%">
            <div class="col-md-4">
                <small>Reason for Calling</small><br>
                &nbsp;&nbsp;<span class="text-yellow">{{ ucfirst($client->reason_calling) }}</span>
            </div>
            <div class="col-md-4">
                <small>Type of Call:</small><br>
                &nbsp;&nbsp;<span class="text-yellow">{{ ucfirst($client->type_call) }}</span>
            </div>
            @if($client->transaction_complete == "Yes")
                <div class="col-md-4">
                    <small>Transaction Complete:</small><br>
                    &nbsp;&nbsp;<span class="text-yellow">Yes</span>
                </div>
            @elseif($client->transaction_incomplete)
                <div class="col-md-4">
                    <small>Transaction In-Complete:</small><br>
                    &nbsp;&nbsp;<span class="text-yellow">{{ $client->transaction_incomplete }}</span>
                </div>
            @endif
        </div>

        @if($client->reason_calling == "walkin" || $client->reason_calling == "issue")
            <?php $it_reason_call = \App\Monitoring::where("code",$client->code)->where("status",$client->reason_calling)->get(); ?>
            @if(count($it_reason_call) > 0)
                @if($client->reason_calling == 'walkin')
                    <h4 class="text-blue"><i class="fa fa-phone"></i> Walk-In Call History</h4>
                @else
                    <h4 class="text-red">Issue and Concern Call History</h4>
                @endif
                <div style="padding-right: 3%;padding-left: 3%;">
                    @foreach($it_reason_call as $action)
                        <?php
                        $remark_by = \App\User::find($action->remark_by);
                        ?>
                        <div class="tab-pane active" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class="time-label">
                    <span class="bg-blue">
                      {{ date('F d, Y',strtotime($action->created_at)) }}
                    </span>
                                </li>
                                <li>
                                    <i class="fa fa-phone bg-aqua"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header no-border"><a href="#">{{ $remark_by->fname }} {{ $remark_by->lname }}</a>
                                            <small class="text-warning">({{ date('H:i',strtotime($action->created_at)) }})</small><br>
                                            <small style="margin-left: 2%">
                                                <span class="text-warning">Notes:</span> {{ $action->notes }}
                                            </small><br>
                                            <small style="margin-left: 2%">
                                                <span class="text-warning">Action Taken:</span> {{ $action->remarks }}
                                            </small>
                                        </h3>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
        @elseif($client->reason_calling == 'offline')
            @if($client->reason_others)
                <div class="col-md-4">
                    <small>Reason Others</small><br>
                    &nbsp;&nbsp;<span class="text-yellow">{{ $client->reason_others }}</span>
                </div>
            @endif
            @if($client->action)
                <div class="col-md-4">
                    <small>Action Taken</small><br>
                    &nbsp;&nbsp;<span class="text-yellow">{{ $client->action }}</span>
                </div>
            @endif
            <?php
            $it_offline_reason = \App\ItOfflineReason::where("it_call_id",$client->id)->get();
            ?>
            <br><br><div class="col-md-12">
                <h4 class="text-blue"><i class="fa fa-power-off"></i> Offline Reason</h4>
                @foreach($it_offline_reason as $offline)
                    <div class="tab-pane active" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <li>
                                <i class="fa fa-power-off bg-aqua"></i>
                                <div class="timeline-item">
                                    <?php
                                    if($offline->remarks == "1")
                                        echo "Unstable Internet Connection";
                                    elseif($offline->remarks == "2")
                                        echo "No Point Person";
                                    elseif($offline->remarks == "3")
                                        echo "Facility is under maintenance";
                                    elseif($offline->remarks == "4")
                                        echo "Lack of Manpower";
                                    elseif($offline->remarks == "5")
                                        echo "No Internet Connection";
                                    elseif($offline->remarks == "6")
                                        echo "Lack of knowledge on how to use the system";
                                    elseif($offline->remarks == "7")
                                        echo "Lack of Computer Equipment";
                                    elseif($offline->remarks == "8")
                                        echo "Requesting for retraining";
                                    elseif($offline->remarks == "9")
                                        echo "Limited Doctor on duty";
                                    elseif($offline->remarks == "10")
                                        echo "No one answer, phone just ringing";
                                    elseif($offline->remarks == "11")
                                        echo "Phone no. cannot be reach";
                                    elseif($offline->remarks == "12")
                                        echo "Facility is under renovation";
                                    elseif($offline->remarks == "13")
                                        echo "Hang-up call";
                                    elseif($offline->remarks == "14")
                                        echo "No trained personnel";
                                    elseif($offline->remarks == "15")
                                        echo "No User account";
                                    elseif($offline->remarks == "16")
                                        echo "No idea about CVeHRS";
                                    elseif($offline->remarks == "17")
                                        echo "Log in only if they have referral";
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        @elseif($client->reason_calling == 'support')
            <div class="row" style="padding: 1%">
                <div class="col-md-4">
                    <small>Notes</small><br>
                    &nbsp;&nbsp;<span class="text-yellow" >{{ $client->notes }}</span>
                </div>
                <div class="col-md-4">
                    <small>Action Taken</small><br>
                    &nbsp;&nbsp;<span class="text-yellow" >{{ $client->action }}</span>
                </div>
            </div>
        @endif

        <div class="col-md-12">
            <span class="text-blue" style="font-size: 12pt;">Addendum</span><br>
            <?php $client_addendum = \App\ItAddendum::where("client_id",$client->id)->get(); ?>
            @foreach($client_addendum as $addendum)
                <small>Notes</small><br>
                &nbsp;&nbsp;<span class="text-yellow" >
                    {!! nl2br($addendum->notes) !!}
                </span><br>
            @endforeach
        </div>

        <br><br>
        <form action="{{ asset('it/client/addendum/post') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <br><div class="addendum_body"></div><br>
            <button type="button" class="btn btn-primary" onclick="addAddendum()"><i class="fa fa-plus"></i> Add Notes</button>
            <button type="submit" class="btn btn-success hide" id="addendum_button"><i class="fa fa-send"></i> Submit</button>
            <button class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </form>
    </div>
</div>
<script>
    function addAddendum(){
        $("#addendum_button").removeClass('hide');
        $(".addendum_body").append(
            "<small>Notes</small><br>\n" +
            "<textarea name=\"addendum[]\" id=\"\" cols=\"30\" rows=\"5\" class=\"form-control\" required></textarea>"
        ).hide().fadeIn();
    }
</script>