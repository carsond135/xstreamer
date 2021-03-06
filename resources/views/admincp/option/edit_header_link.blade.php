@extends('admincp.master')
@section('title',"Header News")
@section('content')
			<div class="row ">
				<div class="modal-dialog col-md-12" style="width:100% !important">
					@if(session('msg'))<div class="alert alert-success">{{session('msg')}}</div>@endif
     				 @if(session('msgerror'))<div class="alert alert-danger">{{session('msgerror')}}</div>@endif
       				<div class="panel panel-primary">
               			<div class="panel-heading">Add Header link </div>
	                		<div class="panel-body">
				<form action="{{URL('admincp/edit-header-link')}}/{{$edit_header->id}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				
				
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Title Name</label></div>
							<div class="col-md-10"><input class="form-control" type="text" name="title_name" value="{{$edit_header->title_name}}"></div>
						</div>

						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Description</label></div>
							<div class="col-md-10"><input type="text" class="form-control" name="content" maxlength="150" rows="5" value="{{$edit_header->content}}" placeholder=""></div>
						</div>
						
						<div class="form-group"><!-- to make two field float next to one another, adjust values accordingly -->
							<div class="col-md-2"><label class="lable-control">Link</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="link" value="{{$edit_header->link}}" ></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Status</label></div> 
								<div class="col-md-10">
									<select name="status" class="form-control">
										<option value="0" <?=($edit_header->status==0)? 'selected="selected"':"" ?>  >Hidden</option>
										<option value="1" <?=($edit_header->status==1)? 'selected="selected"':"" ?> >Active</option>
									</select>
								</div>
						</div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" value="Publish" class="btn btn-info pull-right">Save</button>
					
			
			</form>
		
		           </div>
           </div>
    </div>
</div>
		
		<div class="spacer"></div>

		

@endsection
