@extends('admincp.master')
@section('title',"Manage Text Ads")
@section ('subtitle',"Advertisement Management")
@section('content')
		<article class="module width_full">
			@if(session('msg-success'))<div class="alert alert-success"><span class="fa fa-check"></span><strong> {{session('msg-success')}}</strong></div>@endif
			@if(session('msg-error'))<div class="alert alert-danger"><span class="fa fa-times"></span><strong> {{session('msg-error')}}</strong></div>@endif
			<div class="add"><a href="{{URL('admincp/add-video-text-ads')}}"><i class="fa fa-plus-circle"></i> Add A New Text Ad </a></div>
		<header><h3 class="tabs_involved">Video Text Ad Manager </h3></header>
			<table class="tablesorter" cellspacing="0" cellpadding="0"> 
			<thead> 
				<tr> 
    				<th class="line_table">#</th> 
    				<th class="line_table">Title</th>
    				<th class="line_table">Url</th>
    				<th class="line_table">Status</th>
    				<th >Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php $i=1 ?>
                @foreach($textAds as $result)

				<tr> 
    				<td class="line_table">{{$i++}}</td> 
    				<td class="line_table">{{$result->ads_title}}</td>
    				<td class="line_table">{{$result->return_url}}</td>
    				<!-- <td class="line_table">{{$result->position}}</td> -->
    				<td class="line_table">
    					<?= ($result->status)? '<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>'?>
    				</td>
    				<td>
    					<a href="{{URL('admincp/edit-video-text-ads&is=')}}{{$result->ID}}"><i style="font-size: 20px ; margin: 5px" class="fa fa-pencil-square-o"></i></a>
    					<a href="{{URL('admincp/del-text-ads&is=')}}{{$result->ID}}"  onclick="return confirm('Are you sure remove Ads : {{$result->ads_title}} ?')"><i style="font-size: 20px ; margin: 5px" class="fa fa-trash-o"></i></a>
    				</td>
    				
				</tr> 
				 
				@Endforeach
			</tbody> 
			</table>
			<div id="pager" class="pager">
				<form>
					<img src="{{URL('public/assets/css/table/first.png')}}" class="first"/>
					<img src="{{URL('public/assets/css/table/prev.png')}}" class="prev"/>
					<input type="text" readonly="readonly" class="pagedisplay"/>
					<img src="{{URL('public/assets/css/table/next.png')}}" class="next"/>
					<img src="{{URL('public/assets/css/table/last.png')}}" class="last"/>
					<select class="pagesize">
						<option selected="selected"  value="5">5</option>
						<option value="10">10</option>
						<option value="20">20</option>
						<option  value="30">30</option>
					</select>
				</form>
			</div>
		</article><!-- end of content manager article -->
		
		
		
		<div class="spacer"></div>


@endsection