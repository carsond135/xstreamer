@extends('admincp.master')
@section('title',"Edit An Existing Video Ad")
@section ('subtitle',"Advertisement Management")
@section('content')
<div class="row ">
		<div class="modal-dialog col-md-12" style="width:100% !important">
		    @if(session('msg'))<h4 class="alert alert-success">{{ session('msg') }}</h4>@endif
			@if(session('msgerro'))<div class="alert alert-danger">{{session('msgerro')}}</div>@endif
       		<div class="panel panel-primary">
               	<div class="panel-heading">Edit An Existing Video Ad</div>
	                <div class="panel-body">
				<form action="{{URL('admincp/edit_in-player-media-ads')}}/{{$editvideoads->id}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				
			
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Ad Name</label></div>
							<div class="col-md-10"><input class="form-control" type="text" name="title" value="{{$editvideoads->title}}" placeholder=""></div>
						</div>
						

						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Description</label></div>
							<div class="col-md-10"><input class="form-control" type="text" name="descr" value="{{$editvideoads->descr}}" placeholder=""></div>
						</div>

						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Ad URL</label></div>
							<div class="col-md-10"><input class="form-control" type="text" name="adv_url" value="{{$editvideoads->adv_url}}" placeholder=""></div>
						</div>

						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Upload Media File</label></div>
							<div class="col-md-10"><input  class="form-control" type="file" name="media" ><small>(*.mp4)</small></div>
						</div>

						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Status</label></div>
							<div class="col-md-10">
								<select class="form-control" name="status">
									<option value="1" <?=($editvideoads->status==1)? 'selected="selected"' :''  ?> >Active</option>
									<option value="0" <?=($editvideoads->status==0)? 'selected="selected"': '' ?> >Inactive</option>
								</select>
							</div>
						</div>
						<div class="form-group">
								<input type="hidden" name="id" value="{{$editvideoads->id}}">
								<input type="hidden" name="string" value="{{$editvideoads->string_id}}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<center><button type="submit" value="Publish" class="btn btn-info">Save</button></center>
						</div>

			</form>
		</article><!-- end of post new article -->
		
		
		
		<div class="spacer"></div>
		

@endsection
