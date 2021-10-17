<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-xs-12 right-header pull-right">
                <ul class="nav navbar-nav">
                    @if(\Session::has('User'))
                        <?php $user = Session::get('User');?>
                        <li><a href="#" >Hi! {{ str_limit($user->firstname." ".$user->lastname,10)}}</a></li>
                        <li><a href="{{URL('logout.html')}}">Logout</a></li>
                    @else
                        <li><a data-toggle="modal" data-target="#myModal" href="#">Login</a></li>
                        <li><a data-toggle="modal" data-target="#signup" href="#">Sign Up</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 left-header pull-left">
                <div class="row">
                    <div class="col-md-5 col-sm-6 logo">
                        <?php if(isset($config->site_logo)) { ?>
                            <a href="{{URL()}}"><img src="{{ URL($config->site_logo) }}" alt="{{$config->site_name}}" /></a>
                        <?php } else { ?>
                            <a href="{{URL()}}"><img src="{{URL('public/assets/images/logo.png')}}" alt="logo" /></a>
                        <?php } ?>
                    </div>
                    <div class="col-md-7 col-sm-6 search">
                        <form class="form-horizontal" action="{{URL('search.html')}}" method="get">
                            <div class="form-group">
                                <div class="col-sm-12 form-search">
                                    <input type="text" name="keyword" class="form-control search_placeholder" id="inputEmail3" placeholder="What do you want to fap to?" />
                                    <input type="submit" class="btn-search" value="Search" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul id="site-menu-top" class="nav navbar-nav">
                        <li><a href="{{URL()}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active page-sub-menu">
                            <a href="{{URL('video.html&action=new')}}">Videos <span class="caret_icon"></span></a>
                            <ul class="sub-menu">
                                <li><a href="{{URL('video.html&action=new')}}">Newest Videos</a></li>
                                <li><a href="{{URL('video.html&action=most-favorited')}}">Most Favorited Videos</a></li>
                                <li><a href="{{URL('video.html&action=most-commented')}}">Most Commented on Videos </a></li>
                            </ul>
                            <span class="glyphicon  glyphicon-plus display "></span>
                        </li>
                        <li class="page-sub-menu">
                            <a href="{{URL('categories.html')}}">Categories <span class="caret_icon"></span></a>
                            <ul class="sub-menu">
                                <li>
                                <?php $get_cat=get_categories()?>
                                @foreach($get_cat as $result)
                                    <div class="sub-menu-content"><a title="{{$result->title_name}}" href="{{URL('categories/')}}/{{$result->ID}}.{{$result->post_name}}.html">{{str_limit($result->title_name,11)}}</a></div>
                                @endforeach
                                </li>
                            </ul>
                            <span class="glyphicon  glyphicon-plus display "></span>
                        </li>
                        <li><a href="{{URL('top-rate.html')}}">Top Rated Videos</a></li>
                        <li><a href="{{URL('most-view.html')}}">Most Viewed Videos</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="bottom-header">
        @if(session('msg'))
            <span>{{session('msg')}}<span>
        @else
            <?=GetHeaderNews();?>
        @endif
    </div>
</header>
@include('login.loginmodal')
@include('login.signup')
@include('login.forgotpassword')