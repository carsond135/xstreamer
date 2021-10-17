<div id="signup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" >
        <div class="panel panel-primary">
         		<div style="font-weight: bold;" class="panel-heading">Sign Up
             <div id="loadsignup"></div>
            </div>
              	<div class="panel-body">
                  <div id="msgsignup" class="col-md-9"></div>
                  <div class="clearfix"></div>
                  <div class="row">
                      <form name="register" role="form">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="firstname">Enter First Name</label>
                                  <div id="firstname" class="alert-error"></div> 
                                  <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" required>
                              </div>
                          </div>
                          <div class="col-md-6">  
                              <div class="form-group">
                                  <label for="lastname">Enter Last Name</label>
                                  <div id="lastname" class="alert-error"></div> 
                                  <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" required>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-md-6">  
                              <div class="form-group">
                                  <label for="username">Enter UserName</label>
                                  <div id="username" class="alert-error"></div> 
                                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                              </div>
                          </div>
                          <div class="col-md-6">  
                              <div class="form-group">
                                  <label for="passwords">Enter Password</label>
                                  <div id="password" class="alert-error"></div> 
                                  <input type="password" value="" class="form-control" id="passwords" name="passwords" placeholder="Enter Password" required>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-md-6">  
                              <div class="form-group">
                                  <label for="passwordagain">Enter Password Again</label>
                                  <div id="passwordagains" class="alert-error"></div> 
                                  <input type="password" value="" class="form-control" id="passwordagain" name="passwordagain" placeholder="Enter Password Again" required>
                              </div>
                          </div>
                          <div class="col-md-6">  
                              <div class="form-group">
                                  <label for="emails">Enter Email</label>
                                  <div id="email" class="alert-error"></div> 
                                  <input type="email" class="form-control" value="" id="emails" name="emails" placeholder="Enter email" required>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-md-6 pull-right">  
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="button"  name="signupuser" id="signupuser" value="Sign Up" class="btn btn-signup pull-right">
                            <input type="button" data-dismiss="modal" id="cancel" class="btn btn-signup pull-right" style="margin-right: 5px;" value="Cancel">
                          </div>
                      </form>
                  </div>
              </div>
          </div>
  		</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click','#signupuser',function(e) {
            $.ajax({
                url: "{{URL('signup.html')}}",
                type: "POST",
                data: {
                    'firstname': $('input[name=firstname]').val(),
                    'lastname': $('input[name=lastname]').val(),
                    'username': $('input[name=username]').val(),
                    'passwords': $('input[name=passwords]').val(),
                    'passwordagain': $('input[name=passwordagain]').val(),
                    'emails': $('input[name=emails]').val(),
                    '_token': $('input[name=_token]').val(),
                }, success:function(data) {
                    if(data == 1) {
                        $('#firstname').html('<span class="glyphicon glyphicon-remove"></span> First name must be 4-32 character').show();
                        $('input [name="fistname"]').focus();
                    }
                    if(data == 2) {
                        $('#firstname').html('<span class="glyphicon glyphicon-remove"></span> First name must be not null or spaces').show();
                        $('input [name="fistname"]').focus();
                    }
                    if(data == 3) {
                        $('#lastname').html('<span class="glyphicon glyphicon-remove"></span> Last name must be 4-32 character').show();
                        $('input[name="lastname"]').focus();
                    }
                    if(data == 4) {
                        $('#lastname').html('<span class="glyphicon glyphicon-remove"></span> Last name must be not null or spaces').show();
                        $('input[name="lastname"]').focus();
                    }
                    if(data == 5) {
                        $('#username').html('<span class="glyphicon glyphicon-remove"></span> Username already exits ').show();
                        $('input[name="username"]').focus();
                    }
                    if(data == 6) {
                        $('#password').html('<span class="glyphicon glyphicon-remove"></span> Pasword must be 8 character and more ').show();
                        $('input[name="passwords"]').focus();
                    }
                     if(data == 7) {
                        $('#password').html('<span class="glyphicon glyphicon-remove"></span> Password must be not null or spaces ').show();
                        $('input[name="passwords"]').focus();
                    }
                    if(data == 8) {
                        $('#passwordagains').html('<span class="glyphicon glyphicon-remove"></span> Confirm password must be not null or spaces ').show();
                        $('input[name="passwordagain"]').focus();
                    }
                    if(data == 9) {
                        $('#passwordagains').html('<span class="glyphicon glyphicon-remove"></span> Confirm password not match ').show();
                        $('input[name="passwordagain"]').focus();
                    }
                    if(data == 10) {
                        $('#email').html('<span class="glyphicon glyphicon-remove"></span> Email already exits ').show();
                        $('input[name="emails"]').focus();
                    }
                    if(data == 13) {
                        $('#email').html('<span class="glyphicon glyphicon-remove"></span> Email must be not null or spaces ').show();
                        $('input[name="emails"]').focus();
                    }
                    if(data == 14) {
                        $('#email').html('<span class="glyphicon glyphicon-remove"></span>Invalid email format').show();
                        $('input[name="emails"]').focus();
                    }
                    if(data == 11) {
                        $('#username').html('<span class="glyphicon glyphicon-remove"></span> Username must be not null or spaces ').show();
                        $('input[name="username"]').focus();
                    }
                    if(data == 12) {
                        $('#username').html('<span class="glyphicon glyphicon-remove"></span> Username must be 8-32 character ').show();
                        $('input[name="username"]').focus();
                    }
                    if(data == 0) {
                        $('#signup').hide();
                        $('.modal-backdrop').css('display', 'none');
                        $('#msg-popup').modal('show');
                    }
                }
            });
        });
    });
</script>                                      