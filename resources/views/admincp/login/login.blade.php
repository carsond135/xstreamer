<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="utf-8">
    <title>Administrator Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- The styles -->
    

    <link href="{{URL('public/assets/css/charisma-app.css')}}" rel="stylesheet">
    <link href="{{URL('public/assets/bower_components/fullcalendar/dist/fullcalendar.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/bower_components/fullcalendar/dist/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
    <link href="{{URL('public/assets/bower_components/chosen/chosen.min.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/bower_components/colorbox/example3/colorbox.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/bower_components/responsive-tables/responsive-tables.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/css/charisma-app.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/css/noty_theme_default.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/css/elfinder.min.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/css/elfinder.theme.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/css/jquery.iphone.toggle.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/css/uploadify.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/css/animate.min.css')}}" rel='stylesheet'>
    <link href="{{URL('public/assets/css/bootstrap-cerulean.min.css')}}" rel="stylesheet">

</head>

<body>
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Welcome to Administrator Login Your Porn</h2>
        </div>
    </div>

    <div class="row">
        <div class="well col-md-5 center login-box">
            @if(isset($login_error))
            <div class="alert alert-info">{{$login_error}}</div>   
            @else
            <div class="alert alert-info">Please login with your Username and Password.</div>
            @endif
            <form class="form-horizontal" action="{{URL('admincp/login')}}" method="post" >
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Input your username here !">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="************">
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
            </form>
            <!-- forgot password -->
            <form align="center">
                <div align="center">
                    <div class="clearfix" style="height: 10px;"></div>
                    <div class="form-group">
                        <div id="msg-forgot"></div>
                    </div>
                    <div  class="input-group">
                        <label class="label-control" id="check-password"><input type="checkbox" name="forgot_check" value=""> Remember Password</label>
                    </div>
                    <div class="form-group">
                        <div class="input-group" id="show-forgot-password" style="display: none;">
                            <input type="email" class="form-control" id="email-forgot" name="email-forgot" placeholder="input email forgot password">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <span class="input-group-addon btn-primary" id="get-pass" style="color: #fff;cursor: pointer">Send</span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- emd forgot password -->
        </div>
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- external javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="{{URL::asset('public/assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- library for cookie management -->
<script src="{{URL::asset('public/assets/js/jquery.cookie.js')}}"></script>
<!-- calender plugin -->
<script src="{{URL::asset('public/assets/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{URL::asset('public/assets/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<!-- data table plugin -->
<script src="{{URL::asset('public/assets/js/jquery.dataTables.min.js')}}"></script>

<!-- select or dropdown enhancer -->
<script src="{{URL::asset('public/assets/bower_components/chosen/chosen.jquery.min.js')}}"></script>
<!-- plugin for gallery image view -->
<script src="{{URL::asset('public/assets/bower_components/colorbox/jquery.colorbox-min.js')}}"></script>
<!-- notification plugin -->
<script src="{{URL::asset('public/assets/js/jquery.noty.js')}}"></script>
<!-- library for making tables responsive -->
<script src="{{URL::asset('public/assets/bower_components/responsive-tables/responsive-tables.js')}}"></script>
<!-- tour plugin -->
<script src="{{URL::asset('public/assets/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js')}}"></script>
<!-- star rating plugin -->
<script src="{{URL::asset('public/assets/js/jquery.raty.min.js')}}"></script>
<!-- for iOS style toggle switch -->
<script src="{{URL::asset('public/assets/js/jquery.iphone.toggle.js')}}"></script>
<!-- autogrowing textarea plugin -->
<script src="{{URL::asset('public/assets/js/jquery.autogrow-textarea.js')}}"></script>
<!-- multiple file upload plugin -->
<script src="{{URL::asset('public/assets/js/jquery.uploadify-3.1.min.js')}}"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="{{URL::asset('public/assets/js/jquery.history.js')}}"></script>
<!-- application script for Charisma demo -->
<script src="{{URL::asset('public/assets/js/charisma.js')}}"></script>

<script type="text/javascript">
    $(document).on("click","#check-password",function (e){
        $('#show-forgot-password').fadeIn();
    })

    $(document).on('click','#get-pass',function (){
        $.ajax({
            url:"admin-rest-password",
            type:"POST",
            data:{
                'email_forgot':$('#email-forgot').val(),
                '_token':$('input[name=_token]').val()
            },success:function(data){
                if(data==1){
                    $('#msg-forgot').html("<div class='alert alert-success'> Send successfully. Please check your email !</div>").fadeIn().delay(10000).fadeOut();
                    $('#show-forgot-password').fadeOut();
                }
                if(data==2){
                    $('#msg-forgot').html("<div class='alert alert-success'> Your email not exits !</div>").fadeIn().delay(10000).fadeOut();
                }
            }   
        })
    })
</script>

</body>
</html>
