@extends('admincp.master')
@section('title',"META Tag, Analytics and Site Map Information")
@section ('subtitle',"Settings")
@section('content')
<div class="row ">
		<div class="modal-dialog col-md-12" style="width:100% !important">
		    @if(session('msg'))<h4 class="alert alert-success">{{ session('msg') }}</h4>@endif
			@if(session('msgerro'))<div class="alert alert-danger">{{session('msgerro')}}</div>@endif
       		<div class="panel panel-primary">
               	<div class="panel-heading">META Tag, Analytics and Site Map Information</div>
	                <div class="panel-body">
				<form action="{{URL('admincp/option')}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				
			
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Site Title </label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_name" value="{{$option->site_name}}"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Site Logo </label></div>
							<div class="col-md-10">
								<input type="file" class="form-control" name="site_logo" value="">
								<?php 
								if($option->site_logo!=NULL){?>
								<div style="background: #ddd; padding: 5px;">
									<img src="{{URL()}}/{{$option->site_logo}}" style="height: 50px">
								</div>
								
								<?php }?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">META Description</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_description" value="{{$option->site_keyword}}"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">META KeyWord</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_keyword" value="{{$option->site_keyword}}"></div>
						</div>
						<!-- <div class="form-group">
							<div class="col-md-2"><label class="lable-control">Site Address</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_address" value="{{$option->site_address}}"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Site phone</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_phone" value="{{$option->site_phone}}"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Site Email</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_email" value="{{$option->site_email}}"></div>
						</div> -->
						<!-- <div class="form-group">
							<div class="col-md-2"><label class="lable-control">Facebook Social</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_fb" value="{{$option->site_fb}}"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">twitter Social</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_tw" value="{{$option->site_tw}}"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Linkin Social</label></div>
							<div class="col-md-10"><input  class="form-control" type="text" name="site_linkin" value="{{$option->site_linkin}}"></div>
						</div> -->
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Site Copyright</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="site_copyright" value="{{$option->site_copyright}}"></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Site Text Footer</label></div>
							<div class="col-md-10">
								<textarea name="site_text_footer" class="form-control wysiwyg" rows="10">{{$option->site_text_footer}}</textarea>
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="col-md-2"><label class="lable-control">Google Analytic</label></div>
							<div class="col-md-10">
								<textarea name="site_ga" class="form-control" rows="5">{{$option->site_ga}}</textarea>
							</div>
						</div> -->

						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Upload SiteMap</label></div>
							<div class="col-md-10">
								<input type="file" class="form-control" name="site_map" value="">
							</div>
						</div>
				
						<div class="form-group">
								<input type="hidden" name="id" value="{{$option->ID}}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<center><button type="submit" value="Publish" class="btn btn-info">Save</button></center>
						</div>

			</form>
		</article><!-- end of post new article -->
		
		
		
		<div class="spacer"></div>
		

@endsection