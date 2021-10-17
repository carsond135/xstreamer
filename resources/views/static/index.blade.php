@extends('master-frontend')
@section('title', $static->titlename)
@section('content')
<div class="main-content">
	<div class="container top-rate ">
		<div class="titile-cate">
			<h2>{{$static->titlename}}</h2>
		</div>          
		<div class="row content-image" style="text-align: justify">
			<?=$static->content_page?>
		</div>                
	</div>
</div>
@endsection