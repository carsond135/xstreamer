@extends('admincp.master')
@section('title',"Manage Video Ads")
@section ('subtitle',"Advertisement Management")
@section('content')
		<article class="module width_full">
			@if(session('msg'))<div class="alert alert-success"><span class="fa fa-check"></span><strong> {{session('msg')}}</strong></div>@endif
			@if(session('msgerror'))<div class="alert alert-danger"><span class="fa fa-times"></span><strong> {{session('msgerror')}}</strong></div>@endif
			<div class="add"><a href="{{URL('admincp/in-player-media-ads')}}"><i class="fa fa-plus-circle"></i> Add a New Video Ad</a></div>
		<header><h3 class="tabs_involved">Video Text Ad</h3></header>
			<table class="tablesorter" cellspacing="0" cellpadding="0"> 
			<thead> 
				<tr> 
    				<th class="line_table">#</th> 
    				<th class="line_table">Name</th> 
    				<th class="line_table">Description</th>
    				<th class="line_table">URL</th>
    				<th class="line_table">Date Added </th>
    				<th >Action</th>
				</tr> 
			</thead> 
			<tbody> 
				<?php $i=1 ?>
                @foreach($videoAds as $result)

				<tr> 
    				<td class="line_table">{{$i++}}</td> 
    				<td class="line_table">{{$result->title}}</td>
    				<td class="line_table">{{$result->descr}}</td>
    				<td class="line_table">{{$result->adv_url}}</td>
    				<td class="line_table">{{$result->created_at}}</td>
    				<td>
    					<a href="{{URL('admincp/edit_in-player-media-ads')}}/{{$result->id}}"><i style="font-size: 20px ; margin: 5px" class="fa fa-pencil-square-o"></i></a>
    					<a href="{{URL('admincp/delete_in-player-media-ads')}}/{{$result->id}}"  onclick="return confirm('Are you sure remove Ads : {{$result->title}} ?')"><i style="font-size: 20px ; margin: 5px" class="fa fa-trash-o"></i></a>
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