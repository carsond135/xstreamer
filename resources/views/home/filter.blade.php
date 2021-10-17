@extends('master-frontend')
@section('title', 'Home')
@section('content')
<div class="main-content">
    <div class="container">
        @if(isset($msglogin))
            {{$msglogin}}
        @endif

        <div class="titile-cate">
            <div class="visible-xs"><?=get_title_datetime()?></div>
            <span class="hidden-xs"><?=get_title_datetime()?></span>
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle list-video-filter" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{ $filter_flag }}<span class="caret"></span></a>
                    <ul class="hidden" id="video-filter">
                        <li @if($filter_flag == 'Views')class="active"@endif>
                            <a href="javascript:void(0)" data-value="/views">Views</a>
                        </li>
                        <li @if($filter_flag == 'Rating')class="active"@endif>
                            <a href="javascript:void(0)" data-value="/rating">Rating</a>
                        </li>
                        <li @if($filter_flag == 'Duration')class="active"@endif>
                            <a href="javascript:void(0)" data-value="/duration">Duration</a>
                        </li>
                        <li @if($filter_flag == 'Date')class="active"@endif>
                            <a href="javascript:void(0)" data-value="/date">Date</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="row content-image">
            <span class="hidden">{{ $item = 1 }}</span>
            @foreach($videos as $result)
                <?php $rating=GetRatingVideo($result->string_Id)?>

                @if($item == 3)
                    <div class="col-sm-12 col-xs-12 col-md-6 pull-right">
                        <div class="ads-here-right">
                            <p class="advertisement">ADVERTISEMENT</p>
                            <?php echo StandardAdHome(); ?>
                        </div>
                    </div>
                    <div class="visible-xs"><div class="clear"></div><br></div>
                @endif

                <div class="col-xs-6 col-sm-4 col-md-3 image-left">
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

                @if($item == 4)
                    <div class="clearfix"></div>
                @endif
                <span class="hidden">{{ $item++ }}</span>
            @endforeach
        </div>
        <div class="page_navigation">
            {!!$videos->render()!!}
        </div>
    </div>
</div>
@endsection