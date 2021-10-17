@extends('master-frontend')
@section('title', 'Home')
@section('content')
<div class="main-content">
    <div class="container">
        @if(isset($msglogin))
            {{$msglogin}}
        @endif

        @if(count($watch_now) > 0)
        <h2>Videos Being Watched Now</h2>
        <div class="row">
            <div class="col-md-6 col-sm-8 col-xs-12 image-left">
                <div class="row">
                    @if(count($watch_now)>0)
                        <!-- Watched Now -->
                        @foreach($watch_now as $result)
                            <?php $rating = GetRatingVideo($result->string_Id); ?>
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <div class="col">
                                    <div class="col_img">
                                        <span class="hd">HD</span>
                                        <a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">
                                            <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}" height="177" />
                                        </a>
                                        <div class="position_text">
                                            <p class="icon-like"></p>
                                            <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                            <p class="time_minimute">{{sec2hms($result->duration)}}</p>
                                        </div>
                                    </div>
                                    <h3><a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">{{str_limit($result->title_name,30)}}</a></h3>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Featured -->
                        @foreach($indexnew as $resultnew)
                            <?php $rating = GetRatingVideo($resultnew->string_Id); ?>
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <div class="col">
                                    <div class="col_img">
                                        <span class="hd">HD</span>
                                        <a href="{{URL('watch')}}/{{$resultnew->string_Id.'/'.$resultnew->post_name}}.html">
                                            <img src="{{$resultnew->getImageUrl($resultnew->poster)}}" alt="{{$resultnew->title_name}}" height="177" />
                                        </a>
                                        <div class="position_text">
                                            <p class="icon-like"></p>
                                            <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                            <p class="time_minimute">{{sec2hms($resultnew->duration)}}</p>
                                        </div>
                                    </div>
                                    <h3><a href="{{URL('watch')}}/{{$resultnew->string_Id.'/'.$resultnew->post_name}}.html">{{str_limit($resultnew->title_name,30)}}</a></h3>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-4 image-right">
                <div class="ads-here-right">
                    <p class="advertisement">ADVERTISEMENT</p>
                    <?php echo  StandardAdHome(); ?>
                </div>
            </div>
        </div>
        @endif

        @if(!empty($today))
        <div class="titile-cate">
            <?=get_title_datetime()?>
        </div>
        <div class="row content-image">
            @foreach($today as $resulttoday)
                <?php $rating = GetRatingVideo($resulttoday->string_Id); ?>
                <div class="col-xs-6 col-sm-4 col-md-3 image-left">
                    <div class="col">
                        <div class="col_img">
                            <span class="hd">HD</span>
                            <a href="{{URL('watch')}}/{{$resulttoday->string_Id.'/'.$resulttoday->post_name}}.html">
                                 <img src="{{$resulttoday->getImageUrl($resulttoday->poster)}}" alt="{{$resulttoday->title_name}}" height="177" />
                            </a>
                            <div class="position_text">
                                <p class="icon-like"></p>
                                <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                <p class="time_minimute">{{sec2hms($resulttoday->duration)}}</p>
                            </div>
                        </div>
                        <h3><a href="{{URL('watch')}}/{{$resulttoday->string_Id.'/'.$resulttoday->post_name}}.html">{{str_limit($resulttoday->title_name,30)}}</a></h3>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="titile-cate">
            Video Most Views
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle list-video-filter" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Views<span class="caret"></span></a>
                    <ul id="video-filter" class="hidden">
                        <li><a class="active" href="javascript:void(0)" data-value="/views">Views</a></li>
                        <li><a href="javascript:void(0)" data-value="/rating">Rating</a></li>
                        <li><a href="javascript:void(0)" data-value="/duration">Duration</a></li>
                        <li><a href="javascript:void(0)" data-value="/date">Date</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="row content-image">
            @foreach($todayRating as $resulttoday)
                <?php $rating = GetRatingVideo($resulttoday->string_Id); ?>
                <div class="col-xs-6 col-sm-4 col-md-3 image-left">
                    <div class="col">
                        <div class="col_img">
                            <span class="hd">HD</span>
                            <a href="{{URL('watch')}}/{{$resulttoday->string_Id.'/'.$resulttoday->post_name}}.html">
                                <img src="{{$resulttoday->getImageUrl($resulttoday->poster)}}" alt="{{$resulttoday->title_name}}" height="177" />
                            </a>
                            <div class="position_text">
                                <p class="icon-like"></p>
                                <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                <p class="time_minimute">{{sec2hms($resulttoday->duration)}}</p>
                            </div>
                        </div>
                        <h3><a href="{{URL('watch')}}/{{$resulttoday->string_Id.'/'.$resulttoday->post_name}}.html">{{str_limit($resulttoday->title_name,30)}}</a></h3>
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        @if($recomment != NULL)
            @foreach($recomment as $result)
                <?php $video_categories = get_video_form_cat($result->ID) ?>
                @if(count($video_categories)>0)
                    <h2>Recommended Category For You <a style="text-decoration: none" href="{{URL('categories/')}}/{{$result->ID}}.{{$result->post_name}}.html"><span>-{{$result->title_name}}</span></a></h2>
                    <div class="row content-image">
                         @foreach($video_categories as $result)
                            <?php $rating=GetRatingVideo($result->string_Id);?>
                            <div class="col-xs-6 col-sm-4 col-md-3  image-left">
                                <div class="col">
                                    <div class="col_img">
                                        <span class="hd">HD</span>
                                        <a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">
                                            <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}" height="177" />
                                        </a>
                                        <div class="position_text">
                                            <p class="icon-like"></p>
                                            <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                            <p class="time_minimute">{{sec2hms($result->duration)}}</p>
                                        </div>
                                    </div>
                                    <h3><a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">{{str_limit($result->title_name,30)}}</a></h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        @endif
        <div class="page_navigation">
            @if(!empty($today))
                {!!$today->render()!!}
            @endif

            @if(!empty($todayRating))
                {!!$todayRating->render()!!}
            @endif
        </div>
    </div>
</div>
@endsection