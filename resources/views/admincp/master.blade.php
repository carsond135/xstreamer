<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<title>@yield('title') | Your Porn Administrator Panel</title>
	
	<link href="{{URL::asset('public/upload/site/logo.png')}}" rel="icon" type="image/png" />
	<link href="{{URL::asset('public/assets/css/layout.css')}}" rel="stylesheet" type="text/css" media="screen" />
	<link href="{{URL::asset('public/assets/font-awesome-4.3.0/css/font-awesome.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('public/assets/css/uploadify.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('public/assets/css/magnific-popup.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('public/assets/font-awesome-4.3.0/css/font-awesome.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('public/assets/css/wysiwyg-color.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{URL::asset('public/assets/css/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{URL::asset('public/assets/css/uploadfile.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{URL::asset('public/assets/css/jquery.tagsinput.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{URL::asset('public/assets/css/table/style.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{URL::asset('public/assets/css/table/jquery.tablesorter.pager.css')}}" rel="stylesheet" />
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" media="screen" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="{{URL::asset('public/assets/js/wysihtml5.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/assets/js/bootstrap-wysihtml5.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/assets/js/hideshow.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/assets/js/jquery.equalHeight.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/assets/js/jquery.uploadfile.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/assets/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{URL::asset('public/assets/js/jquery.metadata.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/assets/js/jquery.tablesorter.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/assets/js/jquery.tablesorter.pager.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('public/assets/js/jquery.tagsinput.js')}}" type="text/javascript"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
	<script type="text/javascript">
		jQuery.browser = {};
		(function () {
		    jQuery.browser.msie = false;
		    jQuery.browser.version = 0;
		    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
		        jQuery.browser.msie = true;
		        jQuery.browser.version = RegExp.$1;
		    }
		});
		$(document).ready(function(){
			$(".tablesorter").tablesorter({sortList: [[2,1]]}).tablesorterPager({container: $("#pager")});
			$('.table_dashborad').tablesorter();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(function() {
		        $('.column').equalHeight();
			});

			$(".tab_content").hide();
			$("ul.tabs li:first").addClass("active").show();
			$(".tab_content:first").show();

			$("ul.tabs li").click(function() {
				$("ul.tabs li").removeClass("active");
				$(this).addClass("active"); 
				$(".tab_content").hide();
				var activeTab = $(this).find("a").attr("href");
				$(activeTab).fadeIn();
				return false;
			});
		});
    </script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.wysiwyg').wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font
			});
		})
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.email-templete').wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font
			});
		});
	</script>
</head>

<body>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="{{URL('admincp')}}">Administrator</a></h1>
			<h2 class="section_title">@yield('title')</h2><div class="btn_view_site"><a target="_New" class="fa fa-home" href="{{URL()}}"> Home</a></div>
		</hgroup>
	</header>

	<section id="secondary_bar">
		<div class="user">
			<p><?php if(\Session::has('logined')){$user=\Session::get('logined'); echo $user->username; }?></p>
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="{{URL('admincp')}}">Dashboard</a><div class="breadcrumb_divider"></div> <a class="current">@yield('subtitle')</a>@if(isset($title_pornstar))<div class="breadcrumb_divider"></div><a class="current">{{$title_pornstar}}</a>@endif @if(isset($porn_name))<div class="breadcrumb_divider"></div><a class="current">{{$porn_name}}</a>@endif<div class="breadcrumb_divider"></div><a class="current">@yield('title')</a></article>
		</div>
	</section>

	<aside id="sidebar" class="col-md-3">
		<hr/>
		<h3 class="fa fa-external-link"> Category Management</h3>
		<ul class="toggle" style="display: block !important">
			<li><a <?php if(Request::segment(2)=="categories") echo "class='current'" ?> href="{{URL('admincp/categories')}}">Video Categories Manager</a></li>
			<li><a <?php if(Request::segment(2)=="add-categories") echo "class='current'" ?> href="{{URL('admincp/add-categories')}}">Add A New Category</a></li>
		</ul>
		<h3 class="fa fa-video-camera"> Video Management</h3>
		<ul class="toggle">
			<li><a <?php if(Request::segment(2)=="video") echo "class='current'" ?> href="{{URL('admincp/video')}}">Manage Existing Videos </a></li>
			<li><a <?php if(Request::segment(2)=="add-video") echo "class='current'" ?> href="{{URL('admincp/add-video')}}">Add A New Video</a></li>
		</ul>
		<h3 class="fa fa-external-link"> Advertisement Management</h3>
		<ul class="toggle">
			<li><a href="{{URL('admincp/ads-standard')}}">Manage Standard Ads</a></li>
		</ul>
		<h3 class="fa fa-external-link"> Static Pages </h3>
		<ul class="toggle">
			<li><a  <?php if(Request::segment(2)=="static-page") echo "class='current'" ?> href="{{URL('admincp/static-page')}}">Manage Static Pages</a></li>
		</ul>
		<h3 class="fa fa-cogs"> Settings</h3>
		<ul class="toggle">
			<li><a href="{{URL('admincp/conversion-config')}}">Conversion settings</a></li>
			<li><a href="{{URL('admincp/email-templete')}}">Email Template</a></li>
			<li><a href="{{URL('admincp/email-setting')}}">Email Settings</a></li>
			<li><a href="{{URL('admincp/option')}}">META Tag, Analytics and Site Map Information</a></li>
		</ul>
		<h3 class="fa fa-user-secret"> Administrators</h3>
		<ul class="toggle">
			<li><a href="{{URL('admincp/contact')}}">Contact</a></li>
			<li><a href="{{URL('admincp/all-fqa')}}">FAQ</a></li>
			<li><a href="{{URL('admincp/header-link')}}">Header link</a></li>
			<li><a href="{{URL('admincp/change-password')}}">Change Password</a></li>
			<li><a href="{{URL('admincp/logout')}}">Logout</a></li>
		</ul>
		<footer>
			<hr/>
			<p><strong>Copyright &copy; 2015 Website Admin</strong></p>
			<p>Administrator <a href="/">xStreamer Lite V2</a></p>
			<p></p>
		</footer>
	</aside>
	<section id="main" class="col-md-9">
		@yield('content')
	</section>
	<div id="jax-loading" style="" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <center><img width="32" height="32" src="{{URL('public/assets/images/loading_apple.gif')}}"/></center>
	    </div>
	</div>
</body>
</html>