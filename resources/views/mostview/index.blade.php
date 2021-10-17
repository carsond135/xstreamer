@extends('master-frontend')
@section('title', 'Most Viewed Videos')
@section('content')
<div class="main-content categories_page">
    <div class="container top-rate">
        <div class="col-md-12 titile-cate" style="background:#2c2d2f">
            <div class="visible-xs">Most Viewed Videos<p></p></div>
            <span class="hidden-xs">Most Viewed Videos</span>
            <!-- duration -->
            <ul style="width:200px" class="hidden-xs">
                <li class="dropdown">
                    <a href="#" id="set-view-time" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-time="all" ><i id="txt-time-view">All Durations</i><span class="caret"></span></a>
                    <ul id="chose-time-view" class="dropdown-menu">
                        <li class="time-view hidden-xs" ><a role="all" full-text="All Duration" href="javascript:void(0);">All Durations</a></li>
                        <li class="time-view hidden-xs" ><a role="1-3" full-text="Short videos (1-3min)" href="javascript:void(0);">Short videos (1-3min)</a></li>
                        <li class="time-view hidden-xs" ><a role="3-10" full-text="Medium videos (3-10min)" href="javascript:void(0);">Medium videos (3-10min)</a></li>
                        <li class="time-view hidden-xs" ><a role="10+" full-text="Long videos (+10min)" href="javascript:void(0);">Long videos (+10min)</a></li>

                    </ul>
                </li>
            </ul>
            <ul class="visible-xs" style="max-width:110px !important;">
                <li class="dropdown">
                    <a id="set-view-time" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-time="all" ><i id="txt-time-view">All</i><span class="caret"></span></a>
                    <ul id="chose-time-view" class="dropdown-menu" style="min-width:110px !important; width:110px ">
                        <li class="time-view visible-xs" ><a role="all" full-text="All" href="javascript:void(0);">All</a></li>
                        <li class="time-view visible-xs" ><a role="1-3" full-text="1-3min" href="javascript:void(0);">Short(1-3min)</a></li>
                        <li class="time-view visible-xs" ><a role="3-10" full-text="3-10min" href="javascript:void(0);">Medium(3-10min)</a></li>
                        <li class="time-view visible-xs" ><a role="10+" full-text="+10min" href="javascript:void(0);">Long(+10min)</a></li>
                    </ul>
                </li>
            </ul>
            <!--end duration -->
            <!--Date -->
            <ul class="hidden-xs">
                <li class="dropdown">
                    <a href="#" id="date-sort-view" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-date="all" ><i id="txt-date-view">All Time</i><span class="caret"></span></a>
                    <ul id="chose-date-view" class="dropdown-menu">
                        <li class="date-sort-view hidden-xs" ><a role="all" full-text="All Time" href="javascript:void(0);">All Time</a></li>
                        <li class="date-sort-view hidden-xs" ><a role="today" full-text="Viewed Today" href="javascript:void(0);">Viewed Today</a></li>
                        <li class="date-sort-view hidden-xs" ><a role="week" full-text="Viewed This Week" href="javascript:void(0);">Viewed This Week</a></li>
                        <li class="date-sort-view hidden-xs" ><a role="month" full-text="Viewed This Month" href="javascript:void(0);">Viewed This Month</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="visible-xs"  style="max-width:110px !important;">
                <li class="dropdown">
                    <a href="#" id="date-sort-view" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-date="all" ><i id="txt-date-view">All</i><span class="caret"></span></a>
                    <ul id="chose-date-view" class="dropdown-menu" style="min-width:110px !important; width:110px ">
                        <li class="date-sort-view hidden-xs" ><a role="all" full-text="All" href="javascript:void(0);">All</a></li>
                        <li class="date-sort-view visible-xs" ><a role="today" full-text="Today" href="javascript:void(0);">Today</a></li>
                        <li class="date-sort-view visible-xs" ><a role="week" full-text="Week" href="javascript:void(0);">Week</a></li>
                        <li class="date-sort-view visible-xs" ><a role="month" full-text="Month" href="javascript:void(0);">Month</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end Date -->
            <div class="clear"></div>
        </div>
        <div id="most-view-fillter">
            <div class="row content-image" >
                <?php $items=1;?>
                @foreach($mostview as $result)
                <?php $rating=GetRatingVideo($result->string_Id);?>
                <div class="col-xs-6 col-sm-3 image-left">
                    <div class="col">
                        <div class="col_img">
                            <span class="hd">HD</span>
                            <a href="{{URL('watch')}}/{{$result->string_Id."/".$result->post_name}}.html">
                                <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}" width="258" height="177" />
                            </a>
                            <div class="position_text">
                                <p class="icon-like"></p>
                                <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                <p class="time_minimute">{{sec2hms($result->duration)}}</p>
                            </div>
                        </div>
                        <h3><a href="{{URL('watch')}}/{{$result->string_Id."/".$result->post_name}}.html">{{str_limit($result->title_name,30)}} </a></h3>
                    </div>
                </div>
                <?php if($items==2) {?>
                <div class="col-sm-6 image-right pull-right hidden-xs">
                    <div class="ads-here-right">
                        <p class="advertisement">ADVERTISEMENT</p>
                        <?=StandardAdMostView()?>
                    </div>
                </div>
                <div class="clearfix visible-xs"></div>
                <div class="col-sm-6 image-right visible-xs">
                    <div class="ads-here-right">
                        <p class="advertisement">ADVERTISEMENT</p>
                        <?=StandardAdMostView()?>
                    </div>
                </div>
                <div class="clearfix visible-xs"></div>
                <?php }?>
                <?php if($items==4) {?><div class="clearfix"></div><?php }?>
                <?php $items++;?>
                @endforeach
            </div>
            <div id="page_mostview" class="page_navigation">
                {!!$mostview->render()!!}
            </div>
        </div>
    </div>
</div>
@endsection