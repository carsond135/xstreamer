@extends('master-frontend')
@section('title', 'Video')
@section('content')
<div class="main-content categories_page">
    <div class="container ">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 view_cat">
                <div class="view-cat-col">
                    <h2><center>Categories</center></h2>
                    <ul>
                        @foreach($categories as $result)
                        <li><a href="{{URL('categories/')}}/{{$result->ID}}.{{$result->post_name}}.html">{{$result->title_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 right_content  image-left">
                <h2>video in {{$catname}}</h2>
                <div class="row">
                    @if(count($video_cat)>0)
                    @foreach($video_cat as $result)
                    <?php $rating=GetRatingVideo($result->string_Id);?>
                        <div class="col-xs-6 col-sm-3">
                            <div class="col">
                                <div class="col_img">
                                    <span class="hd">HD</span>
                                    <a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">
                                        <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}"  height="177" />
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
                    <div> No video in categories {{$catname}}. Video will be update soon ! </div>
                    @endif
                </div>
                <div class="page_navigation">
                {!!$video_cat->render()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection