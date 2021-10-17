@extends('admincp.master')
@section('title'," Add A New Standard Ad")
@section ('subtitle',"Advertisement Management")
@section('content')
	<div class="row ">
				<div class="modal-dialog col-md-12" style="width:100% !important">
					@if(session('msg'))<div class="alert alert-success"><span class="fa fa-check"></span><strong> {{session('msg')}}</strong></div>@endif
					@if(session('msgerror'))<div class="alert alert-danger"><span class="fa fa-times"></span><strong> {{session('msgerror')}}</strong></div>@endif
       				<div class="panel panel-primary">
               			<div class="panel-heading">Add A New Standard Ads</div>
	                		<div class="panel-body">
				<form action="{{URL('admincp/add-standard-ads')}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">


						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Ad Name</label></div>
							<div class="col-md-10"><input type="text" class="form-control" name="ads_title" value=""></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Position</label></div>
							<div class="col-md-10">
								<select name="position" class="form-control">
									<option value="home" >Home</option>
									<option value="footer" >Footer</option>
									<option value="toprate" >Top Rate</option>
									<option value="mostview">Most View</option>
									<option value="video" >Video</option>
									<!-- <option value="pornstar" >PornStar</option> -->
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Chose Ad type</label></div>
							<div class="col-md-10">
								<select id="select_type" name="type" class="form-control">
									<option value="upload" selected="selected" >Upload</option>
									<option value="script_code" >Script Code</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="script_code" style="display: none">
							<div class="col-md-2"><label class="lable-control">Script Code</label></div>
							<div class="col-md-10"><textarea class="form-control" rows="5" name="script_code"></textarea></div>
						</div>
						<div class="form-group" id="upload" style="display: none">
							<div class="col-md-2"><label class="lable-control">Upload Image</label></div>
							<div class="col-md-10"><input class="form-control" type="file" name="ads_content" value="" ></div>
							<div class="clearfix" style="margin-bottom:10px;"></div>
							<div class="col-md-2"><label class="lable-control">URL Return</label></div>
							<div class="col-md-10"><input class="form-control"  type="text" name="return_url" value=""></div>
						</div>
						<div class="form-group">
							<div class="col-md-2"><label class="lable-control">Status</label></div>
								<div class="col-md-10">
									<select name="status" class="form-control">
										<option value="0">Inactive</option>
										<option value="1" selected="selected">Active</option>
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

<script type="text/javascript">
	$('#upload').fadeIn();
	$(document).on('change','#select_type',function(){

		if($('#select_type').val()=="upload"){
			$('#upload').fadeIn();
			$('#script_code').fadeOut();
			$('textarea[name=script_code]').val("");
		}else{
			$('#script_code').fadeIn();
			$('#upload').fadeOut();
			$('input[name=ads_content]').val("");
			$('input[name=return_url]').val("");
		}
	})
</script>



		<div class="spacer"></div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#submit-upload').click(function (){
			        $('#loading-upload').html('<img style="position: relative;top: 5px;"  src="{{URL("public/assets/images/loading.gif")}}"/><label>Waiting upload...</label> ').show
			    })
			})
		</script>

@endsection



