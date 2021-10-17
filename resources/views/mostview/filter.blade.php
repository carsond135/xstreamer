<?php $items = 1; ?>
@if(count($mostview) > 0)
    <div class="row content-image">
        <span class="hidden">{{ $item = 1 }}</span>
        @foreach($mostview as $result)
            <?php $rating = GetRatingVideo($result->string_Id); ?>

            @if($item == 3)
                <div class="col-sm-12 col-xs-12 col-md-6 image-right pull-right">
                    <div class="ads-here-right">
                        <p class="advertisement">ADVERTISEMENT</p>
                        <?php echo StandardAdHome(); ?>
                    </div>
                </div>
                <div class="visible-xs"><div class="clear"></div><br></div>
            @endif

            <div class="col-xs-6 col-sm-3 image-left">
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
                    <h3><a href="{{URL('watch')}}/{{$result->string_Id.'/'.$result->post_name}}.html">{{str_limit($result->title_name,30)}} </a></h3>
                </div>
            </div>

            @if($item == 4)
                <div class="clearfix"></div>
            @endif
            <span class="hidden">{{ $item++ }}</span>
        @endforeach
    </div>

    <input type="hidden" data-date="<?=($date)? $date:'today' ?>" data-time="<?=($data_time)? $data_time: 'all' ?>" id="hiden-data-mostview-time" name="" value="">
    <div id="page_mostview_fileter" class="page_navigation">
       {!!$mostview->render()!!}
    </div>
@else
    <p style="text-indent: 15px;">There are no videos found that match this criteria.</p>
@endif

@if(!empty($country_name))
    <script type="text/javascript">
        $('#txt-country').empty().text('{{$country_name->name}}');
        $('#country').attr('data-country','{{$country_name->id}}');
    </script>
@else
    <script type="text/javascript">
        $('#txt-country').empty().text('All')
        $('#country').attr('data-country','all')
    </script>
@endif

@if(!empty($time))
    <script type="text/javascript">
        $('#txt-time').empty().text('{{$time}}');
    </script>
@else
    <script type="text/javascript">
        $('#txt-time').empty().text('All Time');
    </script>
@endif

