<div class="reco-body">
    @if(count($data)>0)
        @foreach($data as $row)
            <div class="direct-chat-msg left">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">711 DOH CVCHD HealthLine</span>
                    <small class="direct-chat-timestamp pull-left text-yellow" style="margin-left: 3%;">{{ date('d M h:i a',strtotime($row->created_at)) }}</small>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" title="{{ $row->remark_by }}" src="{{ url('img/doh.png') }}" alt="Message User Image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    {!! nl2br($row->remarks) !!}
                </div>
                <!-- /.direct-chat-text -->
            </div>
        @endforeach
    @endif
</div>
