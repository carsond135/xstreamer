@extends('master-frontend')
@section('title', 'Site map')
@section('content')
<div class="main-content">
    <div class="container">
        @if(isset($msglogin))
        	{{$msglogin}}
        @endif
                 
        <div class="row">
        	<div id="col-md-12">
			<h2>xStreamer Sitemap</h2>   
        		<div class="bonsai sitemap">
        			<ul class="section">
        				<li class="folder alpha open">
							<a href="#"  style="text-transform: uppercase;">Video</a>
							<ul class="section">
								<li class=" alpha">
									<a href="{{URL('video.html&action=new')}}">Newest Videos</a>
								</li>
								<li class=" alpha">
									<a href="{{URL('video.html&action=top-rated')}}">Top Rated Videos</a>
								</li>
								<li class=" alpha">
									<a href="{{URL('video.html&action=most-view')}}">Most Viewed</a>
								</li>
								<li class=" alpha">
									<a href="{{URL('video.html&action=most-favorited')}}">Most Favorited Videos</a>
								</li>
								<li class=" alpha">
									<a href="{{URL('video.html&action=most-commented')}}">Most Commented on Videos </a>
								</li>
							</ul>
						</li>
						<li class="folder alpha open">
							<a href="#"  style="text-transform: uppercase;">Categories</a>
							<ul class="section">
								@foreach($categories as $result)
								<li class="folder alpha">
									<a href="{{URL('categories/')}}/{{$result->ID}}.{{$result->post_name}}.html">{{$result->title_name}}</a>
									<ul class="section">
									   <li data-action="new-video" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="hidden-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-arrow-up"></i> Newest Videos</a></li>
		                               <li data-action="new-video" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="visible-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-arrow-up"></i> Newest</a></li>
		                               <li data-action="most-favorited" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="hidden-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-thumbs-o-up"></i> Most favoriated</a></li>
		                               <li data-action="most-favorited" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="visible-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-thumbs-o-up"></i> Favoriated</a></li>
		                               <li data-action="most-rated" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="hidden-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-star"></i> Top rated videos</a></li>
		                               <li data-action="most-rated" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="visible-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-star"></i> Rated</a></li>
		                               <li data-action="most-viewed" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="hidden-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-line-chart"></i> Most viewed videos</a></li>
		                               <li data-action="most-viewed" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="visible-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-line-chart"></i> Viewed</a></li>
		                               <li data-action="most-commented" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="hidden-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-comments-o"></i> Most commented</a></li>
		                               <li data-action="most-commented" data-name="{{$result->post_name}}" data-categories="{{$result->ID}}" class="visible-xs categories-sort"><a href="javascript:void(0)"><i class="fa fa-comments-o"></i> Commented</a></li>
									</ul>
								</li>
								@endforeach
							</ul>
						</li>
						<li class="alpha open">
							<a href="{{URL('premium-hd.html')}}"  style="text-transform: uppercase;">Premium HD</a>
							<ul class="section"></ul>
						</li>
						<li class="alpha open">
							<a href="{{URL('top-rate.html')}}"  style="text-transform: uppercase;">Top Rated Videos</a>
							<ul class="section"></ul>
						</li>
						<li class="alpha open">
							<a href="{{URL('most-view.html')}}"  style="text-transform: uppercase;">Most Viewed</a>
							<ul class="section"></ul>
						</li>
						<li class="folder alpha open">
							<a href=""  style="text-transform: uppercase;">Channel</a>
							<ul class="section">
								<li class="folder alpha open">
									<a href="#">All Channel</a>
									<ul class="section">
									@foreach($channel as $result)
										<li><a href="{{URL('channel')}}/{{$result->ID}}/{{$result->post_name}}">{{$result->title_name}}</a></li>
									@endforeach
									</ul>
								</li>
								<li >
									<a href="{{URL('channel-recently.html')}}">Recently Updated</a>
								</li>
								<li >
									<a href="{{URL('channel-subscriber.html')}}">Most Subscribed</a>
								</li>
								<li >
									<a href="{{URL('channel-popular.html')}}">Most Popular</a>
								</li>
							</ul>
						</li>
						<li class="alpha open">
							<a href="{{URL('porn-stars.html')}}"  style="text-transform: uppercase;">Pornstar</a>
							<ul class="section"></ul>
						</li>
        			</ul>
        		</div>
        	</div>
        </div>   
    </div>
</div>
@endsection