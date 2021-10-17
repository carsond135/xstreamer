<div id="forgot" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" >
           <div class="panel panel-primary">
           		<div class="panel-heading">Forgot password</div>
                  	<div class="panel-body">
                              <form name="forgotpassword" role="form">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="firstname">Input your email</label>
                                          <div id="email-error" class="alert-error"></div> 
                                          <div id="msg-success"></div> 
                                              <input type="email" class="form-control" name="emailforgot" id="email" placeholder="Enter your email" required>
                                      </div>
                                  </div>
                                  <div class="clearfix"></div>
                                    <div class="col-md-12">  
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <input type="button"   id="send-mail-forgot-password" value="Send mail" class="btn btn-signup pull-right">
                                      <input type="button" data-dismiss="modal" id="Close" class="btn btn-signup pull-right" style="margin-right: 5px;" value="Close">
                                      
                                  </div>

                              </form>
                  </div>
			</div>
  		</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','#send-mail-forgot-password',function(e){
      $.ajax({
        url:"forgot-password.html",
        type:"POST",
        data:{
         'email':$('input[name=emailforgot]').val(),
         
         '_token':$('input[name=_token]').val(),

        },success:function(data){
          if(data==1){
            $('#msg-success').empty().html('<div class="alert fade in alert-success" ><i class="fa fa-times" data-dismiss="alert"></i> New password has been sent to your email</div>').show();
          }
          if(data==0){
            $('#email-error').empty().html('Email is invalid. Please try again!')
          }
        }
      });
    });
  });
</script>
                                            