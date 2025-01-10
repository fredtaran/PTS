<!-- Message. Default to the left -->
<?php
    $user = Auth::user();
    $session = 0;
?>
<div class="reco-body">
    @if(count($data)>0)
        @foreach($data as $row)
            <?php
                $pull = 'right';
                $position = 'left';
                if($session == 0){
                    \Illuminate\Support\Facades\Session::put('last_scroll_id', $row->id);
                    $session = 1;
                }
                if($user->id == $row->sender){
                    $pull = 'left';
                    $position = 'right';
                }
            ?>
            <div class="direct-chat-msg {{ $position }}">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-{{ $position }}">{{ ucwords(mb_strtolower($row->fname)) }} {{ ucwords(mb_strtolower($row->lname)) }}</span>
                    <span class="direct-chat-timestamp pull-{{ $pull }}">{{ date('d M h:i a',strtotime($row->date)) }}</span>
                </div>
                <!-- /.direct-chat-info -->
                <?php
                    $icon = 'receiver.png';
                    if($user->id == $row->sender)
                        $icon = 'sender.png';
                ?>
                <img class="direct-chat-img" title="{{ $row->facility }}" src="{{ url('img/'.$icon) }}" alt="Message User Image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    {!! nl2br($row->message) !!}
                </div>
                <!-- /.direct-chat-text -->
            </div>
        @endforeach
    @endif
</div>
