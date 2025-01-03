<div class="direct-chat-msg right">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-right">{{ $name }}</span>
        <span class="direct-chat-timestamp pull-left">{{ date('d M h:i a') }}</span>
    </div>
    <img class="direct-chat-img" title="" src="{{ url('img/sender.png') }}" alt="Message User Image"><!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        {{ $message }}
    </div>
</div>