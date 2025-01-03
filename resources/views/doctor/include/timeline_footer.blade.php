<div class="timeline-footer">
    <div class="form-inline">
        <?php $user = Auth::user(); ?>
        @if( ($row->status == 'referred' || $row->status == 'seen' || $row->status == 'redirected' || $row->status == 'transferred') && $user->department_id == $row->department_id )
            <div class="form-group">
                <a class="btn btn-warning btn-xs btn-refer" href="{{ $modal }}"
                   data-toggle="modal"
                   data-code="{{ $row->code }}"
                   data-item="#item-{{ $row->id }}"
                   data-status="{{ $row->status }}"
                   data-type="{{ $row->type }}"
                   data-id="{{ $row->id }}"
                   data-referred_from="{{ $row->referred_from }}"
                   data-backdrop="static">
                    <i class="fa fa-folder"></i> View Form
                </a>
            </div>
        @endif

        @if($seen > 0)
            <div class="form-group">
                <a href="#seenModal" data-toggle="modal"
                   data-id="{{ $row->id }}"
                   class="btn btn-success btn-xs btn-seen"><i class="fa fa-user-md"></i> Seen
                    @if($seen > 0)
                        <small class="badge bg-green-active">{{ $seen }}</small>
                    @endif
                </a>
            </div>
        @endif

        @if($caller_md > 0)
            <div class="form-group">
                <a href="#callerModal" data-toggle="modal"
                   data-id="{{ $row->id }}"
                   class="btn btn-primary btn-xs btn-caller"><i class="fa fa-phone"></i> Caller
                    @if($caller_md > 0)
                        <small class="badge bg-blue-active">{{ $caller_md }}</small>
                    @endif
                </a>
            </div>
        @endif

        @if($redirected > 0)
            <div class="form-group">
                <a href="#" data-toggle="modal"
                   data-id="{{ $row->id }}"
                   class="btn btn-danger btn-xs btn-caller"><i class="fa fa-chevron-circle-right"></i> Redirected
                    @if($redirected > 0)
                        <small class="badge bg-red-active">{{ $redirected }}</small>
                    @endif
                </a>
            </div>
        @endif

        <button class="btn btn-xs btn-info btn-feedback" data-toggle="modal"
                data-target="#feedbackModal"
                data-code="{{ $row->code }}">
            <i class="fa fa-comments"></i>
            ReCo
            @if($feedback > 0)
                <span class="badge bg-blue">{{ $feedback }}</span>
            @endif
        </button>

        <?php $doh_remarks = \App\Models\Monitoring::where("code", "=", $row->code)->count(); ?>
        @if($doh_remarks > 0)
            <button class="btn btn-xs btn btn-doh" data-toggle="modal" style="background-color: #dd7556;color: white"
                    data-target="#feedbackDOH"
                    data-code="{{ $row->code }}">
                <span class="badge bg-green">{{ $doh_remarks }}</span>
            </button>
        @endif

        <?php $issue_and_concern = \App\Models\Issue::where("tracking_id", "=", $row->id)->count(); ?>
        @if($issue_and_concern > 0)
            <button class="btn btn-xs btn-danger btn-issue-incoming" data-toggle="modal"
                    data-target="#IssueAndConcern"
                    data-code="{{ $row->code }}"
                    data-referred_from="{{ $row->referred_from }}"
                    data-tracking_id="{{ $row->id }}">
                <i class="fa fa fa-exclamation-triangle"></i> Issue and Concern
                <span class="badge bg-red">{{ $issue_and_concern }}</span>
            </button>
        @endif
    </div>
</div>