<div class="modal fade" role="dialog" id="feedbackModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="box box-success direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span class="feedback_code"></span>
                    </h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool reloadMessage">
                            <i class="fa fa-refresh"></i></button>
                        <button type="button" data-dismiss="modal" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        Loading...
                    </div>
                    <!--/.direct-chat-messages-->
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <form action="{{ url('doctor/feedback') }}" method="post" id="feedbackForm">
                        {{ csrf_field() }}
                        <input type="hidden" id="current_code" name="code" />
                        <div class="input-group">
                            <textarea name="message" id="message" rows="2" required placeholder="Type Message ..." class="form-control"></textarea>
                            <span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-lg">Send</button>
                      </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" role="dialog" id="feedbackDOH">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="box box-success direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span class="feedback_monitoring_code"></span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div id="doh_monitoring" style="padding: 10px;">

                    </div>
                </div>
            </div>
            <!--/.direct-chat -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" role="dialog" id="IssueAndConcern">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="box box-danger direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span class="issue_concern_code"></span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div id="issue_and_concern_body" style="padding: 10px;">

                    </div>
                </div>

                <div class="box-footer issue_footer">
                    <form action="" method="post" id="sendIssue">
                        {{ csrf_field() }}
                        <input type="hidden" id="issue_tracking_id" />
                        <div class="input-group">
                            <textarea id="issue_message" rows="3" required placeholder="Type a message for your issue and concern regarding your referral.." class="form-control"></textarea>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-footer-->
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->