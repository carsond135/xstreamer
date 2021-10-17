@if(count($video)>0)
    <div class="row content-image">
    @foreach($video as $result)
        <?php $rating = GetRatingVideo($result->string_Id); ?>
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
                <h3><a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">{{str_limit($result->title_name,30)}}</a></h3>
            </div>
        </div>
    @endforeach
    </div>
    <div id="search-filter-page" class="page_navigation">
        {!!$video->render()!!}
    </div>
@else
    No videos found that fit this criteria.
@endif
<script type="text/javascript">
    $(document).ready(function() {
        $('#c-result').empty().text('{{$count_video}}')
    })
</script>