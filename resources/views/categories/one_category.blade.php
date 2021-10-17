@extends('master-frontend')
@section('title', 'Categories')
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

            <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 right_content image-left">
                <div class="row">
                    <div class="col-md-12 titile-cate">
                        <div class="visible-xs">{{$onecategoriesdetail->title_name}} Videos<p></p></div>
                        <span class="hidden-xs">{{$onecategoriesdetail->title_name}} Videos</span>
                        <ul>
                            <li class="dropdown">
                                <a href="#" id="set-time-cat" class="dropdown-toggle list-duration-filter" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" data-time="all" >
                                <?=isset($filter_time_lg) ? $filter_time_lg.'<span class="caret"></span>' : ' All Durations<span class="caret"></span>'; ?>
                                </a>
                                <ul id="chose-time-cat" class="hidden">
                                    <li class="time" ><a role="all" data-name="{{$onecategoriesdetail->post_name}}" data-categories="{{$onecategoriesdetail->ID}}" full-text="All Durations" href="javascript:void(0);">All Durations</a></li>
                                    <li class="time" ><a role="1-3" data-name="{{$onecategoriesdetail->post_name}}" data-categories="{{$onecategoriesdetail->ID}}" full-text="Short videos (1-3min)" href="javascript:void(0);">Short videos (1-3min)</a></li>
                                    <li class="time" ><a role="10+" data-name="{{$onecategoriesdetail->post_name}}" data-categories="{{$onecategoriesdetail->ID}}" full-text="Long videos (+10min)" href="javascript:void(0);">Long videos (+10min)</a></li>
                                </ul>
                            </li>
                        </ul>
                        
                        <ul>
                            <li class="dropdown">
                                <a href="#" class="hidden-xs dropdown-toggle list-date-filter" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?=isset($filter_title_lg)?''.$filter_title_lg.'<span class="caret">':' Newest<span class="caret">'?></span></a>
                                <a href="#" class="visible-xs dropdown-toggle list-date-filter" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?=isset($filter_title_xs)?''.$filter_title_xs.'<span class="caret">':' Newest<span class="caret">'?></a>
                                <ul id="chose-date-cat" class="hidden">
                                    <li data-action="new-video" data-name="{{$onecategoriesdetail->post_name}}" data-categories="{{$onecategoriesdetail->ID}}" class="categories-sort"><a href="javascript:void(0)"><i class="fa fa-arrow-up"></i> Newest</a></li>
                                    
                                    <li data-action="most-favorited" data-name="{{$onecategoriesdetail->post_name}}" data-categories="{{$onecategoriesdetail->ID}}" class="categories-sort"><a href="javascript:void(0)"><i class="fa fa-thumbs-o-up"></i> Most Favorited</a></li>
                                    
                                    <li data-action="most-rated" data-name="{{$onecategoriesdetail->post_name}}" data-categories="{{$onecategoriesdetail->ID}}" class="categories-sort"><a href="javascript:void(0)"><i class="fa fa-star"></i> Top Rated</a></li>
                                    
                                    <li data-action="most-viewed" data-name="{{$onecategoriesdetail->post_name}}" data-categories="{{$onecategoriesdetail->ID}}" class="categories-sort"><a href="javascript:void(0)"><i class="fa fa-line-chart"></i> Most Viewed</a></li>
                                    
                                    <li data-action="most-commented" data-name="{{$onecategoriesdetail->post_name}}" data-categories="{{$onecategoriesdetail->ID}}" class="categories-sort"><a href="javascript:void(0)"><i class="fa fa-comments-o"></i> Most Commented</a></li>
                                </ul>
                            </li>
                        </ul>
                        <input type="hidden" id="hidden-action" data-time="<?= isset($hidden_time)? $hidden_time :'all' ?>" data-action="<?= isset($hidden_action)? $hidden_action :'new-video' ?>">
                        <div class="clear"></div>
                    </div>
                    <div>
                        <div id="categories-loading">
                            @if(empty($videoin))
                                <span>
                                    There are no videos available yet for this category. To upload one 
                                    <a class="click-here" href="'.URL('member-proflie.html?action=upload').'">Click here</a>
                                </span>
                            @else
                                @foreach($videoin as $result)
                                    <?php $rating=GetRatingVideo($result->string_Id) ?>
                                    <div class="col-xs-6 col-md-3" style="margin-bottom: 10px;">   
                                        <div class="col">
                                            <div class="col_img">
                                                <span class="hd">HD</span>
                                                <a href="{{URL('watch')}}/{{$result->string_Id."/".$result->post_name}}.html">
                                                <?php if ($result->poster==NULL) { ?>
                                                <img src="{{URL('public/assets/images/no-image.jpg')}}" alt="{{$result->title_name}}" width="210" height="145" />
                                                <?php  }else{?>
                                                <img src="{{$result->poster}}" alt="{{$result->title_name}}" width="210" height="145" />
                                                <?php } ?>
                                                <div class="position_text">
                                                    <p class="icon-like"></p>
                                                    <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                                    <p class="time_minimute">{{sec2hms($result->duration)}}</p>
                                                </div>
                                            </div>
                                            <h3><a href="{{URL('watch')}}/{{$result->string_Id."/".$result->post_name}}.html">{{str_limit($result->title_name,20)}}</a></h3>
                                        </div>
                                    </div>
                                @endforeach   
                            @endif
                            <div class="clearfix"></div>
                            
                            @if(isset($videoin))
                                <div class="page_navigation">
                                    <ul>
                                        @if($videoin->currentPage() !=1)
                                        <li><a href="{{str_replace('/?','?',$videoin->url($videoin->currentPage()-1))}}" > << Prev</a></li>
                                        @endif

                                        @if($videoin->lastPage()>1)
                                            @for($i=1;$i<=$videoin->lastPage();$i=$i+1)
                                            <li ><a class="{{($videoin->currentPage()==$i) ? 'activepage' : '' }}" href="{{str_replace('/?','?',$videoin->url($i))}}">{{$i}}</a></li>
                                            @endfor
                                        @endif

                                        @if($videoin->currentPage() < $videoin->lastPage())
                                            <li><a href="{{str_replace('/?','?',$videoin->url($videoin->currentPage()+1))}}">Next >></a></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>                    
                </div>
            </div>    
        </div>       
    </div>
</div>
@endsection