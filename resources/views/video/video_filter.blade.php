<div class="row">
    @if(count($video)>0)
        @foreach($video as $result)
        <?php $rating=GetRatingVideo($result->string_Id);?>
        <div class="col-xs-6 col-sm-6 col-md-4">
            <div class="col">
                <div class="col_img">
                    <span class="hd">HD</span>
                    <a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">
                    <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}" height="177" />
                    <div class="position_text">
                        <p class="icon-like"></p>
                        <p class="percent">{{floor($rating['percent_like'])}}%</p>
                        <p class="time_minimute">{{sec2hms($result->duration)}}</p>
                    </div>
                    </a>
                </div>
                <h3><a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">{{str_limit($result->title_name, 25)}}</a></h3>
            </div>
        </div>
        @endforeach
    @else
        <span>There are no videos available yet for filter.To upload one <a class="click-here" href="{{URL('member-proflie.html?action=upload')}}">Click here</a></span>
    @endif
</div>
<div id="result-video-filter-paginate" class="page_navigation">
    {!!$video->render()!!}
</div>