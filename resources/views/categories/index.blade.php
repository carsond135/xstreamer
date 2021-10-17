@extends('master-frontend')
@section('title', 'Categories')
@section('content')
<div class="main-content categories_page">
    <div class="container pornstars_page ">
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

            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10 right_content">
            @if(count($all_categories)>0)
                <div class="titile-cate">
                    Categories
                </div>
                <div class="row">
                    @foreach($all_categories as $result)
                        <div class="col-20 image-left">
                            <div class="col">
                                <div class="col_img">
                                    <a href="{{URL('categories')}}/{{$result->ID}}.{{$result->post_name}}.html">
                                        <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}" width="277" height="150" />
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{URL('categories')}}/{{$result->ID}}.{{$result->post_name}}.html">{{str_limit($result->title_name,17)}}</a>
                                    <span>{{count_video_in_cat($result->ID)}}</span>
                                </h3>
                            </div>
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                    <!-- recomended -->
                    @if(count($recomment_categories)>0)
                        <h2>Recommended Category For You</h2>
                        <div class="row">
                            @foreach($recomment_categories as $result)
                                <div class="col-20 image-left">
                                    <div class="col">
                                        <div class="col_img">
                                             <a href="{{URL('categories')}}/{{$result->ID}}.{{$result->post_name}}.html">
                                                <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}" width="277" height="150" />
                                            </a>
                                        </div>
                                        <h3>
                                            <a href="{{URL('categories')}}/{{$result->ID}}.{{$result->post_name}}.html">{{$result->title_name}}</a>
                                            <span>{{count_video_in_cat($result->ID)}}</span>
                                        </h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <!-- end recommended -->
                    <div class="page_navigation">
                        {!!$all_categories->render()!!}
                    </div>
                </div>
            @endif
            </div>
         </div>
    </div>
</div>
@endsection