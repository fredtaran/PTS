@extends('layouts.app')

@section('content')
    <div class="col-md-3">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><span class="label label-danger" data-toggle="tooltip" title="Remove">8 Online</span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <ul class="users-list clearfix">
                    <li>
                        <img src="{{ asset('img/ro7.png') }}" alt="User Image">
                        <a class="users-list-name" href="#">Alexander Pierce</a>
                        <span class="users-list-date">Today</span>
                    </li>
                    <li>
                        <img src="{{ asset('img/ro7.png') }}" alt="User Image">
                        <a class="users-list-name" href="#">Norman</a>
                        <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                        <img src="{{ asset('img/ro7.png') }}" alt="User Image">
                        <a class="users-list-name" href="#">Jane</a>
                        <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                        <img src="{{ asset('img/ro7.png') }}" alt="User Image">
                        <a class="users-list-name" href="#">John</a>
                        <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                        <img src="{{ asset('img/ro7.png') }}" alt="User Image">
                        <a class="users-list-name" href="#">Alexander</a>
                        <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                        <img src="{{ asset('img/ro7.png') }}" alt="User Image">
                        <a class="users-list-name" href="#">Sarah</a>
                        <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                        <img src="{{ asset('img/ro7.png') }}" alt="User Image">
                        <a class="users-list-name" href="#">Nora</a>
                        <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                        <img src="{{ asset('img/ro7.png') }}" alt="User Image">
                        <a class="users-list-name" href="#">Nadia</a>
                        <span class="users-list-date">15 Jan</span>
                    </li>
                </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Users</a>
            </div>
            <!-- /.box-footer -->
        </div>
    </div>

    <div class="col-md-9">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>System Feedback and Concern</h3>
            </div>
            <div class="box-body">
                <div class="textarea_body">
                    <textarea class="textarea comment" id="myTextArea"  placeholder="Message" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    <div class="box-footer clearfix">
                        <button type="button" class="pull-right btn btn-default" id="sendEmail" onclick="SendComment()">Send
                            <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                </div>
                <!-- Post -->
                <div class="post comment_body">
                    <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ asset('img/DOHCHDNM.png') }}" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                    </p>
                    <ul style="list-style-type: none;">
                        <li>
                            <div class="box box-info">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="{{ asset('img/DOHCHDNM.png') }}" style="border: 3px solid red" alt="user image">
                                    <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers asdjahsdjk ashdkasj hdaskj dhasjkdhasjkdhasjkdhasjkdhaskhd asdasdasdasdsadas
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="box box-info">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="{{ asset('img/DOHCHDNM.png') }}" style="border: 3px solid red" alt="user image">
                                    <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers asdjahsdjk ashdkasj hdaskj dhasjkdhasjkdhasjkdhasjkdhaskhd asdasdasdasdsadas
                                </p>
                            </div>
                        </li>
                        <li>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa fa-share margin-r-5"></i> Reply
                            </button>

                        </li>
                    </ul>
                </div>
                <!-- /.post -->
            </div>
        </div>
    </div>


@endsection
@section('css')

@endsection

@section('js')
    <script>
        console.log('code here..');
        $('.textarea').wysihtml5();
        $('.collapse').collapse();

        function SendComment(){
            var url = "<?php echo asset('feedback/comment_append'); ?>";
            var comment = $(".comment").val();
            json = {
                "_token" : "<?php echo csrf_token(); ?>",
                "comment" : comment

            };
            $.post(url,json,function(result){
                var comment_body = result.split('explode|ruseltayong|explode')[1];
                var textarea_body = result.split('explode|ruseltayong|explode')[0];
                $(".comment_body").prepend(comment_body);
                $(".textarea_body").html(textarea_body);
                $('.textarea').wysihtml5();
            });

        }
    </script>
@endsection

