@extends('admincp.master')
@section('title',"Standard Ads Management")
@section ('subtitle',"Advertisement Management")
@section('content')


@if(session('msg-success'))
	<div class="alert alert-success">
		<span class="fa fa-check"></span>
		<strong> {{session('msg-success')}}</strong>
	</div>
@endif
@if(session('msg-error'))
	<div class="alert alert-danger"><span class="fa fa-times"></span>
		<strong> {{session('msg-error')}}</strong>
	</div>
@endif
<article class="module width_full">
	<div class="add"><a href="{{URL('admincp/add-standard-ads')}}"><i class="fa fa-plus-circle"></i> Add A New Standard Ads</a></div>
	<header><h3 class="tabs_involved">Current Standard Ads</h3></header>
	<table class="tablesorter" cellspacing="0" cellpadding="0"> 
	<thead> 
		<tr> 
			<th class="line_table" style="min-width: 100px;">Ad Title</th>
			<th class="line_table" style="max-width: 183px;">View source</th>
			<th class="line_table">Type</th>
			<th class="line_table">Ad URL</th>
			<th class="line_table" style="width: 100px">Position</th>
			<th style="width: 100px" >Action</th>
		</tr> 
	</thead> 
	<tbody> 
		<?php $i=1 ?>
        @foreach($standard as $result)
		<tr> 
			<td class="line_table">{{$result->ads_title}}</td>
			<td class="line_table" >
				@if($result->type=="upload")
				<img src="{{$result->ads_content}}" width="183" height="134">
				@else
				<code>{{$result->script_code}}</code>
				@endif
			</td>
			<td class="line_table" style="text-transform:uppercase">{{$result->type}}</td>
			<td class="line_table">{{$result->return_url}}</td>
			<td class="line_table" style="text-transform: uppercase">{{$result->position}}</td>
			<td>
				<a href="{{URL('admincp/edit-standard-ads&is=')}}{{$result->ID}}"><i style="font-size: 20px ; margin: 5px" class="fa fa-pencil-square-o"></i></a>
				<a href="{{URL('admincp/del-standard-ads&is=')}}{{$result->ID}}"  onclick="return confirm('Are you sure remove Ads : {{$result->ads_title}} ?')"><i style="font-size: 20px ; margin: 5px" class="fa fa-trash-o"></i></a>
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
				<option value="30">30</option>
			</select>
		</form>
	</div>
</article>
<div class="spacer"></div>
@endsection