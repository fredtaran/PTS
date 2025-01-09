<?php
$dateNow = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DOH CHD X – Pregnancy Tracker System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    @vite('resources/assets/css/bootstrap.min.css')
    <!-- Font Awesome -->
    @vite('resources/assets/css/font-awesome.min.css')
    @vite('resources/assets/css/AdminLTE.min.css')
    <link rel="icon" href="{{ asset('img/DOHCHDNM.png') }}">
  </head>
  <body class="hold-transition login-page">
   <div class="login-box">
        <center>
           <span> <img src="{{ asset('img/logo.png') }}" style="width: 25%"/>
            <img src="{{ asset('img/DOHCHDNM.png') }}" style="width: 25%"/>
            <img src="{{ asset('img/bgp.png') }}" style="width: 30%"/><br>
            <label style="font-size: 9pt;">DOH CHD - NORTHERN MINDANAO</label><br>
            <label style="font-size: 9pt;">Pregnancy Tracking System</label></span>
        </center>
          <form role="form" method="POST" action="{{ asset('login') }}" class="form-submit" >
              {{ csrf_field() }}
              <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                  <div class="form-group has-feedback {{ Session::has('error') ? ' has-error' : '' }}">
                    <input id="username" autocomplete="off" type="text" placeholder="Login ID" autofocus class="form-control" name="username" value="{{ Session::get('username') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="help-block">
                        @if(Session::has('error'))
                            <strong>{{ Session::get('error') }}</strong>
                        @endif
                    </span>
                  </div>
                  <div class="form-group has-feedback ">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                    <div class="row">
                        <!-- <div class="col-xs-7">
                            <div class="form-group">

                            </div>
                            <a target="_blank" href="http://bit.ly/ereferralregister"> Click me to Register </a>
                        </div> -->
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat btn-submit">
                                <i class="fa fa-lock"></i>&nbsp;&nbsp;Sign In
                            </button>
                            
                        </div><!-- /.col -->
                       
                    </div>
                </div><!-- /.login-box-body -->
                <div style="text-align: center;">
              </div>
          </form>
          
         
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <!-- @vite('resources/assets/js/jquery.min.js') -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Bootstrap 3.3.5 -->
    @vite('resources/assets/js/bootstrap.min.js')
    
    <script>
        $('.btn-submit').on('click',function(){
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Validating...');
        });

    </script>
  </body>
</html>
