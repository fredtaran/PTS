<table>
    <thead style="background-color: red">
    <tr>
        <td>Name of Facility</td>
        <td>Total Incoming  Referrals</td>
        <td>Total Accepted Referrals</td>
        <td>Total Viewed Only Referrals</td>
        <td>Common Sources(Facility)</td>
        <td>Common Referring Doctor HCW/MD (Top 10)</td>
        <td>Average Referral Acceptance Turnaround time</td>
        <td>Average Referral Arrival Turnaround Time</td>
        <td>Diagnoses (Top 10)</td>
        <td>Reasons (Top 10)</td>
        <td>Number of Horizontal referrals</td>
        <td>Number of Vertical Referrals</td>
        <td>Common Methods of Transportation</td>
        <td>Department</td>
        <td>Remarks</td>
    </tr>
    </thead>
    <tbody>
    @foreach($export as $row)
        <tr>
            <td>{{ $row->name }}</td>
            <td>{{ $row->count_incoming }}</td>
            <td>{{ Session::get('accepted_incoming')[$row->id] }}</td>
            <td>{{ Session::get('seenzoned_incoming')[$row->id] }}</td>
            <td>{{ Session::get('common_source_incoming')[$row->id] }}</td>
            <td>{{ Session::get('referring_doctor_incoming')[$row->id] }}</td>
            <td>{{ Session::get('turnaround_time_accept_incoming')[$row->id] }}</td>
            <td>{{ Session::get('turnaround_time_arrived_incoming')[$row->id] }}</td>
            <td>{{ Session::get('diagnosis_ref_incoming')[$row->id] }}</td>
            <td>{{ Session::get('reason_ref_incoming')[$row->id] }}</td>
            <td>{{ "Under development this column" }}</td>
            <td>{{ "Under development this column" }}</td>
            <td><{{ Session::get('transport_ref_incoming')[$row->id] }}/td>
            <td>{{ Session::get('department_ref_incoming')[$row->id] }}</td>
            <td>{{ Session::get('issue_ref_incoming')[$row->id] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>