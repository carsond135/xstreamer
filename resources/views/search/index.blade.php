@extends('master-frontend')
@section('title', 'Search Result')
@section('content')
<div class="main-content">
    <div class="container top-rate">
        <div class="row categories_page">
            <input type="hidden" id="keyword" value="{{$keyword}}">
            <div class="col-md-4">
                <div class="view-cat-col titile-cate" style="border: none; font-size: 15px">
                    Sort By
                    <ul style="position: relative; top:-3px;width: 140px;">
                        <li id="close-sort" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i id="txt-sort-by">Relevance</i><span class="caret"></span></a>
                            <ul id="sort_by" class="dropdown-menu" style="width:140px; min-width: 140px;">
                                <li><a data-sort="relevance" full-text="Relevance" class="active" href="javascript:void(0)">Relevance</a></li>
                                <li><a data-sort="uploaddate" full-text="Upload date" href="#">Upload date</a></li>
                                <li><a data-sort="mostviewed" full-text="Most viewed" href="#">Most viewed</a></li>
                                <li><a data-sort="rating" full-text="Rating" href="#">Rating</a></li>
                            </ul>
                        </li>
                    </ul>
                    <input type="hidden" id="sort_by_default" value="relevance">
                </div>
            </div>
            <div class="col-md-4">
                <div class="view-cat-col titile-cate" style="border: none;font-size: 15px">
                    Date Added
                    <ul style="position: relative; top:-3px; width: 140px;">
                        <li id="close-date" class="dropdown">
                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i id="txt-date-sort">Anytime</i><span class="caret"></span></a>
                            <ul id="sort_date" class="dropdown-menu" style="width:140px; min-width: 140px;">
                                <li><a data-sort-date="all" full-text="Anytime" class="active" href="#">Anytime</a></li>
                                <li><a data-sort-date="today" full-text="Today" href="#">Today</a></li>
                                <li><a data-sort-date="week" full-text="This week" href="#">This week</a></li>
                                <li><a data-sort-date="month" full-text="This Month" href="#">This Month</a></li>
                            </ul>
                        </li>
                    </ul>
                    <input type="hidden" id="sort_date_default" value="all">
                </div>
            </div>
            <div class="col-md-4">
                <div class="view-cat-col  titile-cate" style="border: none;font-size: 15px">
                    Length of Video
                    <ul class="hidden-xs" style="position: relative; top:-3px; width: 195px;">
                        <li id="close-duration" class="dropdown">
                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i id="txt-duration-sort">All</i><span class="caret"></span></a>
                            <ul id="sort_time" class="dropdown-menu" style="width:195px; min-width: 195px;">
                                <li><a data-sort-time="all" full-text="All" class="active" href="#">All</a></li>
                                <li><a data-sort-time="1-3" full-text="Short videos (1-3min)" href="#">Short videos (1-3min)</a></li>
                                <li><a data-sort-time="3-10" full-text="Medium videos (3-10min)" href="#">Medium videos (3-10min)</a></li>
                                <li><a data-sort-time="10+" full-text="Long videos (+10min)" href="#">Long videos (+10min)</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="visible-xs" style="position: relative; top:-3px; width: 140px;">
                        <li id="close-duration" class="dropdown">
                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i id="txt-duration-sort">All</i><span class="caret"></span></a>
                            <ul id="sort_time" class="dropdown-menu" style="width:140px; min-width: 140px;">
                                <li><a data-sort-time="all" full-text="All" class="active" href="#">All</a></li>
                                <li><a data-sort-time="1-3" full-text="Short (1-3min)" href="#">Short (1-3min)</a></li>
                                <li><a data-sort-time="3-10" full-text="Medium (3-10min)" href="#">Medium (3-10min)</a></li>
                                <li><a data-sort-time="10+" full-text="Long (+10min)" href="#">Long (+10min)</a></li>
                            </ul>
                        </li>
                    </ul>
                    <input type="hidden" id="sort_time_default" value="all">
                </div>
            </div>
        </div>
        <div class="titile-cate" style="margin-bottom: 0">
            <h2>"{{$keyword}}" Search - <i id="c-result">{{count($video)}}</i> Results</h2>
        </div>
        <div id="ajax-result-content">
            <div class="row content-image">
                @foreach($video as $result)
                    <?php $rating=GetRatingVideo($result->string_Id);?>
                    <div class="col-xs-6 col-sm-4 col-md-3 image-left">
                        <div class="col">
                            <div class="col_img">
                                <span class="hd">HD</span>
                                <a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">
                                    <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}" width="258" height="177" />
                                </a>
                                <div class="position_text">
                                    <p class="icon-like"></p>
                                    <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                    <p class="time_minimute">{{sec2hms($result->duration)}}</p>
                                </div>
                            </div>
                            <h3><a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">{{str_limit($result->title_name,25)}}</a></h3>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="page_navigation">
                {!!$video->render()!!}
            </div>
        </div>
    </div>
</div>
@endsection