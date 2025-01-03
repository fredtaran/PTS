@if($reason == 'offline')
    <div style="padding-right: 3%;padding-left: 3%;">
        <table class="table">
            <tr>
                <td style="width: 50%">
                    <small class="text-green">
                        Reason
                    </small>
                    <select class="form-control select2" name="offline_reason[]" multiple="multiple">
                        <option value="1">Unstable Internet Connection</option>
                        <option value="2">No Point Person </option>
                        <option value="3">Facility is under maintenance</option>
                        <option value="4">Lack of Manpower</option>
                        <option value="5">No Internet Connection</option>
                        <option value="6">Lack of knowledge on how to use the system</option>
                        <option value="7">Lack of Computer Equipment</option>
                        <option value="8">Requesting for retraining</option>
                        <option value="9">Limited Doctor on duty</option>
                        <option value="10">No one answer, phone just ringing</option>
                        <option value="11">Phone no. cannot be reach</option>
                        <option value="12">Facility is under renovation</option>
                        <option value="13">Hang-up call</option>
                        <option value="14">No trained personnel</option>
                        <option value="15">No User account</option>
                        <option value="16">No idea about CVeHRS</option>
                        <option value="17">Log in only if they have referral</option>
                    </select>
                </td>
                <td>
                    <small class="text-green">
                        Others
                    </small>
                    <textarea name="reason_others" rows="1" class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <small class="text-green">
                        Action Taken:
                    </small>
                    <textarea name="action" id="" rows="5" class="form-control"></textarea>
                </td>
            </tr>
        </table>
    </div>
@elseif($reason == 'walkin' || $reason == 'issue')
    <?php $it_reason_call = \Illuminate\Support\Facades\Session::get('it_reason_call'); ?>
    @if(count($it_reason_call) > 0)
        @if($reason == 'walkin')
            <h3 class="text-blue"><i class="fa fa-phone"></i> Walk-In Call History</h3>
        @else
            <h3 class="text-red">Issue and Concern Call History</h3>
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
    <table class="table">
        <tbody id="walkin_action_body">
            <tr>
                <td>
                    <small class='text-green'>
                        Notes:
                    </small>
                    <textarea name='notes' id='' rows='3' class='form-control'></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <small class='text-green'>
                        Action Taken:
                    </small>
                    <textarea name='action' id='' rows='3' class='form-control'></textarea>
                </td>
            </tr>
        </tbody>
    </table>
@else
    <table class="table">
        <tr>
            <td width="10%">
                <small class="pull-right text-green">
                    Notes:
                </small>
            </td>
            <td>
                <textarea name="notes" id="" rows="5" class="form-control"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <small class="pull-right text-green">
                    Action Taken:
                </small>
            </td>
            <td>
                <textarea name="action" id="" rows="5" class="form-control"></textarea>
            </td>
        </tr>
    </table>
@endif
<script>
    $(".select2").select2({ width: '100%' });
    function addWalkinAction(){
        $("#walkin_action_body").append("<tr>\n" +
            "            <td width='10%'>\n" +
            "                <small class='pull-right text-green'>\n" +
            "                    Action Taken:\n" +
            "                </small>\n" +
            "            </td>\n" +
            "            <td>\n" +
            "                <textarea name='reason_notes' id='' rows='5' class='form-control'></textarea>\n" +
            "            </td>\n" +
            "            <td width='5%'>\n" +
            "                <button class='btn btn-sm btn-danger pull-right' type='button' onclick='removeWalkinAction($(this))' style='margin-bottom: 2%'><i class='fa fa-times'></i> Remove this action</button>\n" +
            "            </td>\n" +
            "        </tr>");
    }

    function removeWalkinAction(data){
        data.parent().parent().remove();
    }

</script>