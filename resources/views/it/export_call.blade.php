<?php
function getMinutes($time){
    $time = explode(':', $time);
    return ($time[0]*60) + ($time[1]) + ($time[2]/60);
}
?>
<html lang="en">
    <body>
    <table class="table table-striped">
        <thead class="bg-gray">
        <tr>
            <th>Facility Name</th>
            <th>Contact No</th>
            <th>Client Name</th>
            <th>Transacted By</th>
            <th>Department</th>
            <th>Email Address</th>
            <th>Time Started</th>
            <th>Time Ended</th>
            <th>Time Duration</th>
            <th>Reason for Calling</th>
            <th>Walk-In</th>
        </tr>
        </thead>
        <tbody>
        @foreach($client as $row)
            <tr>
                <td>{{ \App\Facility::find($row->facility_id)->name }}</td>
                <td>{{ "contact:".$row->contact_no }}</td>
                <td>
                    <span class="text-green font_size">{{ $row->name }}</span>
                </td>
                <td>
                    <?php
                    $transacted_by = \App\User::find($row->encoded_by);
                    $transacted_by = $transacted_by->fname.' '.ucfirst($transacted_by->mname[0]).'. '.$transacted_by->lname;
                    ?>
                    <span class="text-green font_size">{{ $transacted_by }}</span>
                    @if($row->call_classification == 'new_call')<small class="text-blue">(New Call)</small>@else<small class="text-red">(Repeat Call)</small>@endif
                </td>
                <td>{{ $row->department }}</td>
                <td>{{ $row->email }}</td>
                <td>
                    <span class="text-green font_size">
                        {{ date('F d,Y',strtotime($row->time_started)) }}
                    </span>
                    <small class="text-yellow">
                        ({{ date('h:i:s A',strtotime($row->time_started)) }})
                    </small>
                </td>
                <td>
                    <span class="text-green font_size">
                        {{ date('F d,Y',strtotime($row->time_ended)) }}
                    </span>
                    <small class="text-yellow">
                        ({{ date('h:i:s A',strtotime($row->time_ended)) }})
                    </small>
                </td>
                <td>
                    <span class="font_size text-blue">
                        {{ $row->time_duration }}
                    </span><br>
                </td>
                <td>
                    <small class="text-yellow">
                        ({{ ucfirst($row->reason_calling) }})
                    </small>
                </td>
                <td>
                    <?php
                        $walkin_client = \App\Monitoring::where("code",$row->code)->where("status","walkin")->get();
                        $count = 0;
                    ?>
                    @foreach($walkin_client as $walkin)
                        <?php
                            $count++;
                        ?>
                        {{ $count }}.) {{ $walkin->notes }}<br>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
</html>