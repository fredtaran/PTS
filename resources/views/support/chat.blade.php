<?php
$user = Session::get('auth');
$searchKeyword = Session::get('searchKeyword');
$keyword = '';
if($searchKeyword){
    $keyword = $searchKeyword['keyword'];
}
?>
@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px;
        }
        .form-group {
            margin-bottom: 10px;
        }
    </style>
    <div class="col-md-9">
        <div class="box box-success direct-chat direct-chat-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <span class="feedback_code">IT Support: Group Chat</span>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages" style="height:400px" id="it-group-chat">
                    Loading...
                </div>
                <!--/.direct-chat-messages-->
                <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <form action="{{ url('support/chat') }}" method="post" id="feedbackForm">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" name="message" id="message" required placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-flat">Send</button>
                      </span>
                    </div>
                </form>
            </div>
            <!-- /.box-footer-->
        </div>
    </div>
    <div class="col-md-3">
        @include('support.sidebar.quick')
    </div>
@endsection
@section('js')
<script>
    var objDiv = document.getElementById('it-group-chat');
    setTimeout(function () {
        objDiv.scrollTop = objDiv.scrollHeight;
    },500);

    $("#it-group-chat").html("Loading...");
    $("#it-group-chat").load("{{ url('support/chat/messages') }}");

    $('#feedbackForm').submit(function (e) {
        e.preventDefault();
        var msg = $("#message").val()
        $.ajax({
            url: "{{ url('support/chat') }}",
            type: 'post',
            data: {
                _token : "{{ csrf_token() }}",
                message: msg,
                code : 'it-group-chat'
            },
            success: function(data) {
                feedbackRef.push({
                    id: data,
                    code: 'it-group-chat',
                    msg: msg,
                    user_id: "{{ $user->id }}"
                });
                feedbackRef.on('child_added',function(data){
                    setTimeout(function(){
                        feedbackRef.child(data.key).remove();
                    },200);
                });

                var objDiv = document.getElementById('it-group-chat');
                objDiv.scrollTop = objDiv.scrollHeight;
                $('#message').val('').focus();
            }
        });
    });

    $('.direct-chat-messages').scroll(function() {
        var current_top_element = $('.direct-chat-messages').children().first();
        var previous_height = 0;


        var pos = $('.direct-chat-messages').scrollTop();
        var objDiv = document.getElementById('it-group-chat');


        if (pos == 0) {
            $.ajax({
                url: "{{ url('support/chat/messages/load') }}",
                type: "get",
                success: function (data) {
                    if(data!=0){
                        $("#it-group-chat").prepend(data);
                        current_top_element.prevAll().each(function() {
                            previous_height += $(this).outerHeight();
                        });

                        objDiv.scrollTop = previous_height;
                    }
                }
            })
        }
    });

    feedbackRef.on('child_added',function(snapshot){
        var data = snapshot.val();

        $("#it-group-chat").append(data.content);
        $.ajax({
            url: "{{ url('support/chat/messages/reply/') }}/"+data.id,
            type: 'get',
            success: function(content) {
                $("#it-group-chat").append(content);
                var objDiv = document.getElementById('it-group-chat');
                objDiv.scrollTop = objDiv.scrollHeight;
            }
        });
    });
</script>
@endsection

