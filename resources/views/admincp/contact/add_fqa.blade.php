@extends('admincp.master')
@section('title',"Add FQA")
@section('content')
		<div class="row ">
				<div class="modal-dialog col-md-12" style="width:100% !important">
					@if($errors->has())
					@foreach ($errors->all() as $error)
					<div class="alert alert-danger"><i class="icon-remove close" data-dismiss="alert"></i><strong> {{$error}}</strong></div>
					@endforeach
					@endif 
       				<div class="panel panel-primary">
               			<div class="panel-heading">Add New FQA</div>
	                		<div class="panel-body">
				<form action="{{URL('admincp/add-fqa')}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Question</label></div>
							<div class="col-md-10"><textarea class="form-control" rows="5" name="question" >{{Input::old('question')}}</textarea></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Answer</label></div>
							<div class="col-md-10"><textarea class="form-control" rows="5" name="answer" >{{Input::old('answer')}}</textarea></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Status</label></div> 
								<div class="col-md-10">
									<select name="status" class="form-control">
										<option value="0">Inactive</option>
										<option value="1" >Active</option>
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

