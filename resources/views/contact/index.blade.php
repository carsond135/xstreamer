@extends('master-frontend')
@section('title', 'Contact Us')
@section('content')

<div class="main-content">
    <div class="container">
        @if(isset($msglogin))
        	{{$msglogin}}
        @endif
                 
        <div class="row">
        	<div id="col-md-12">
			<h2>Contact Us</h2>
			
			<form style="padding: 5px; margin-top: 10px;" method="post" action="{{URL('contact')}}" class="form-horizontal" accept-charset="utf-8" enctype="multipart/form-data" >
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						@if(session('message'))
							<div class="alert alert-success">
								<span class="fa fa-check"></span><strong> {{session('message')}}</strong>
							</div>
						@endif
						
						@if(isset($validator))
						    @foreach ($validator->all() as $error)
						    	<div class="alert alert-danger">
						    		<span class="fa fa-exclamation"></span><strong> {{$error}}</strong>
						    	</div>
						    @endforeach
						@endif

						@if(session('captcha'))
							<div class="alert alert-danger">
								<span class="fa fa-exclamation"></span><strong> {{session('captcha')}}</strong>
							</div>
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<label>Email:</label>
						<input type="email" class="form-control" name="email_contact" value="" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<label>Account Name:</label>
						<input type="text" class="form-control" name="account_contact" value="" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<label>Name:</label>
						<input type="text" name="name_contact" class="form-control" rows="10" placeholder="" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<label>What can we help you with ?</label>
						<select name="type_contact"  class="form-control" id="type">
							<option>Choose from one of the below options</option>
							<option value="bug">Bug</option>
							<option value="feedback">General Inquiries</option>
							<option value="verification">User photo verification</option>
							<option value="amateur">Amateur program</option>
							<option value="media">Press/Media inquiry</option>
							<option value="content">Content Removal Request</option>
							<option value="copyright">Copyright Issue</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<label>Message:</label>
						<textarea name="message_contact" class="form-control" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<div style="padding-left:15px" class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<center>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="submit"  class="btn btn-signup" value="Send Message">
						</center>
					</div>
				</div>
			</form>
        	</div>
        </div>   
    </div>
</div>
@endsection