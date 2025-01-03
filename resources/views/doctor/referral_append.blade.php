<?php
    $date = date('M d, Y h:i A',strtotime($tracking->date_referred));
    $department = '"Not specified department"';
    $check_dept = \App\Department::find($tracking->department_id);
    if($check_dept)
    {
        $department = $check_dept->description;
    }
?>
<li>
    <i class="fa fa-ambulance bg-blue-active"></i>
    <div class="timeline-item normal-section" id="item-24086">
        <span class="time"><i class="icon fa fa-ambulance"></i> <span class="date_activity">{{ $date }}</span></span>
        <h3 class="timeline-header no-border">
            <strong class="text-bold">
                <a href="{{ asset('doctor/referred?referredCode=').$tracking->code }}" target="_blank">{{ $tracking->code }}</a>
            </strong>
            <small class="status">
                [ {{ $tracking->sex }}, {{ $tracking->age }} ]
            </small>
            was <span class="badge bg-blue">referred</span> to
            <span class="text-danger">{{ $department }}</span>
            by <span class="text-warning">{{ $tracking->referring_md }}</span> of
            <span class="facility">{{ $tracking->facility_name }}</span>
        </h3> <!-- time line for #referred #seen #redirected -->
        <div class="timeline-footer">
            <div class="form-inline">
                <div class="form-group">
                    <a class="btn btn-warning btn-xs btn-refer" href="#normalFormModal" data-toggle="modal" data-code="{{ $tracking->code }}" data-item="#item-{{ $tracking->id }}" data-status="referred" data-type="normal" data-id="{{ $tracking->id }}" data-referred_from="{{ $tracking->referred_from }}" data-backdrop="static">
                        <i class="fa fa-folder"></i> View Form
                    </a>
                </div>
                <button class="btn btn-xs btn-info btn-feedback" data-toggle="modal" data-target="#feedbackModal" data-code="{{ $tracking->code }}">
                    <i class="fa fa-comments"></i>
                    ReCo
                </button>
            </div>
        </div>
    </div>
</li>

<script>
    Lobibox.notify("success", {
        delay: false,
        title: "New Referral",
        msg: "{{ $tracking->code }} was referred by {{ $tracking->referring_md }} of {{ $tracking->facility_name }}",
        img: "{{ url('img/ro7.png') }}",
        sound: false
    });
</script>