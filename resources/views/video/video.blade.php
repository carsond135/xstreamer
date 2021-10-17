@extends('master-frontend')
@section('title', 'Video')
@section('content')
<div class="main-content categories_page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 view_cat">
                <div class="view-cat-col">
                    <h2><center>Categories</center></h2>
                    <ul>
                        @foreach($categories as $result)
                        <li><a href="{{URL('categories/')}}/{{$result->ID}}.{{$result->post_name}}.html">{{$result->title_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 right_content image-left">
                <div class="titile-cate">
                    <div class="visible-xs">{{ $title }}<p></p></div>
                    <span class="hidden-xs">{{ $title }}</span>
                    <ul class="hidden-xs">
                        <li class="dropdown">
                            <a href="#" id="set-time-video" data-action="{{$action}}"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-time="all" ><i id="txt-time-video">All Durations</i><span class="caret"></span></a>
                            <ul id="chose-time-video" data-action="{{$action}}" class="dropdown-menu" style="border-radius:0px">
                                <li class="time hidden-xs" ><a role="all" full-text="All Duration" href="javascript:void(0);">All Durations</a></li>
                                <li class="time hidden-xs" ><a role="1-3" full-text="Short videos (1-3m)" href="javascript:void(0);">Short videos (1-3min)</a></li>
                                <li class="time hidden-xs" ><a role="3-10" full-text="Medium videos(3-10m)" href="javascript:void(0);">Medium videos (3-10min)</a></li>
                                <li class="time hidden-xs" ><a role="10+" full-text="Long videos (+10m)" href="javascript:void(0);">Long videos (+10min)</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="visible-xs" style="max-width:120px !important;">
                        <li class="dropdown">
                            <a href="#" id="set-time-video" data-action="{{$action}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-time="all" ><i id="txt-time-video">All</i><span class="caret"></span></a>
                            <ul id="chose-time-video" data-action="{{$action}}" class="dropdown-menu" style="min-width:120px !important; width:120px; border-radius:0px">
                                <li class="time visible-xs" ><a role="all" full-text="All" href="javascript:void(0);">All</a></li>
                                <li class="time visible-xs" ><a role="1-3" full-text="Short(1-3min)" href="javascript:void(0);">Short (1-3min)</a></li>
                                <li class="time visible-xs" ><a role="3-10" full-text="Medium(3-10min)" href="javascript:void(0);">Medium (3-10min)</a></li>
                                <li class="time visible-xs" ><a role="10+" full-text="Long(+10min)" href="javascript:void(0);">Long (+10min)</a></li>
                            </ul>
                        </li>
                    </ul>
                    @if($action=="new")
                    <input id="date-sort-video" data-date="all" type="hidden" name="" value="">
                    @else
                    <ul class="hidden-xs">
                        <li class="dropdown">
                            <a href="#" id="date-sort-video" data-action="{{$action}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-date="all" ><i id="txt-date-video">All Time</i><span class="caret"></span></a>
                            <ul id="chose-date-video" data-action="{{$action}}" class="dropdown-menu" style="border-radius:0px">
                                <li class="date-sort hidden-xs" ><a role="all" full-text="All Time" href="javascript:void(0);">All Time</a></li>
                                <li class="date-sort hidden-xs" ><a role="today" full-text="Rate Today" href="javascript:void(0);">Today</a></li>
                                <li class="date-sort hidden-xs" ><a role="week" full-text="Rated This Week" href="javascript:void(0);">This Week</a></li>
                                <li class="date-sort hidden-xs" ><a role="month" full-text="Rated This Month" href="javascript:void(0);">This Month</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="visible-xs" style="max-width:120px !important;">
                        <li class="dropdown">
                            <a href="#" id="date-sort-video" data-action="{{$action}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-date="all" ><i id="txt-date-video">All</i><span class="caret"></span></a>
                            <ul id="chose-date-video" data-action="{{$action}}" class="dropdown-menu" style="min-width:120px !important; width:120px; border-radius:0px">
                                <li class="date-sort hidden-xs" ><a role="all" full-text="All date" href="javascript:void(0);">All Date</a></li>
                                <li class="date-sort visible-xs" ><a role="today" full-text="Today" href="javascript:void(0);">Today</a></li>
                                <li class="date-sort visible-xs" ><a role="week" full-text="Week" href="javascript:void(0);">Week</a></li>
                                <li class="date-sort visible-xs" ><a role="month" full-text="Month" href="javascript:void(0);">Month</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                    <div class="clear"></div>
                </div>
                <div id="result-video-filter-page">
                    <div class="row">
                        @foreach($video as $result)
                        <?php $rating=GetRatingVideo($result->string_Id);?>
                        <div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="col">
                                <div class="col_img">
                                    <span class="hd">HD</span>
                                    <a href="{{URL('watch')}}/{{$result->string_Id."/".$result->post_name}}.html">
                                       <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}"  height="177" />
                                       <div class="position_text">
                                        <p class="icon-like"></p>
                                        <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                        <p class="time_minimute">{{sec2hms($result->duration)}}</p>
                                    </div>
                                </div>
                                <h3><a  href="{{URL('watch')}}/{{$result->string_Id."/".$result->post_name}}.html">{{str_limit($result->title_name,25)}}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- PAGE -->
                    <div  class="page_navigation">
                        {!!$video->render()!!}
                    </div>
                </div>
                <!-- END PAGE -->

            </div>
        </div>
    </div>
</div>
@endsection