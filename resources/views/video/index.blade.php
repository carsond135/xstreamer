@extends('master-frontend')
@section('title', $viewvideo->title_name)
@section('content')
<?php
require $_SERVER['DOCUMENT_ROOT'].'/adult/src/Cloudinary.php';
require $_SERVER['DOCUMENT_ROOT'].'/adult/src/Uploader.php';
require $_SERVER['DOCUMENT_ROOT'].'/adult/src/Api.php';
\Cloudinary::config(array(
    "cloud_name" => "longtest",
    "api_key" => "855937926747893",
    "api_secret" => "fcX2vAHf1sxr2PNhuQZrYiEZvrw"
));
$v_setting = GetVideoConfig();
$get_ads_video = GetPlayerAds();
if($viewvideo->website=="www.pornhub.com"  or $viewvideo->website=="www.xvideos.com" or $viewvideo->website=="www.youporn.com" or $viewvideo->website=="www.4tube.com" or $viewvideo->website=="lubetube.com" or $viewvideo->website=="xhamster.com"){
    $reset_data=ResetURLVideo($viewvideo->video_url,$viewvideo->website);
    $video_url=$reset_data['link'];
}
?>
<script src="{{URL::asset('public/assets/js/jquery.timeago.js')}}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function (){
    $("abbr.timeago").timeago();
    $("span.timeago").timeago();
});
</script>
<div class="main-content">
    <div class="container">
        <h2>You're watching : {{ $viewvideo->title_name}}</h2>
        <div class="row">
            <div class="col-sm-9 box-video">
                <script type="text/javascript" src="{{URL('public/assets/js/jwplayer.js')}}"></script>
                <script type="text/javascript">jwplayer.key="6rm7LKq8lGG9cLQNtZGQgXG29NtTNwSPgusQMA==";</script>
                <div id="video-player"></div>
                <script type='text/javascript'>
                    var player= jwplayer('video-player');
                    player.setup({
                        width:'100%',
                        height:'350px',
                        aspectratio: '16:9',
                        image: '<?php  echo $viewvideo->poster?>',
                        <?php if($viewvideo->website=="www.pornhub.com" or $viewvideo->website=="www.xvideos.com" or $viewvideo->website=="www.youporn.com" or $viewvideo->website=="www.4tube.com" or $viewvideo->website=="lubetube.com" or $viewvideo->website=="xhamster.com"){?>
                        sources: [{
                            file: "<?=$video_url?>",
                            label: "SD",
                            "default": "true",
                            type:'mp4'
                        },{
                            file: "<?=$video_url?>",
                            label: "HD",
                            type:'mp4'
                          }]
                        <?php }else{?>
                        sources: [{
                            file: "<?= ($viewvideo->video_sd!=NULL)? $viewvideo->video_sd : $viewvideo->video_src ?>",
                            label: "SD",
                            "default": "true",
                            type:'mp4'
                          },{
                            file: "<?=$viewvideo->video_src ?>",
                            label: "HD",
                            type:'mp4'
                          }]
                        <?php }?>
                    });
                </script>
                <style type="text/css">
                    #video-player { outline: 0px }
                </style>

                <div class="clearfix"></div>
                <div class="vote-box col-xs-7 col-sm-2 col-md-2">
                    <div class="dislikes <?=($percent_like['dislike']!=0)? '':'not-voted' ?> ">
                        <div id="video_rate" class="likes" style="width:{{$percent_like['percent_like']}}%;"></div>
                    </div>
                    <div id="vote_msg" class="vote-msg">
                        <div class="pull-left">
                            <i class="glyphicon glyphicon-thumbs-up"></i> <span id="video_likes" class="text-white">{{$percent_like['like']}}</span>
                        </div>
                        <div class="pull-right">
                            <i class="glyphicon glyphicon-thumbs-down"></i> <span id="video_dislikes" class="text-white">{{$percent_like['dislike']}}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="pull-right visible-xs">
                    <div class="pull-left m-t-15">
                        <a href="#" class="btn btn-signup" style="padding: 8px 12px;" id="vote_like_{{$viewvideo->string_Id}}"><i class="glyphicon glyphicon-thumbs-up"></i></a>
                        <a href="#" class="btn btn-signup" style="padding: 8px 12px;" id="vote_dislike_{{$viewvideo->string_Id}}"><i class="glyphicon glyphicon-thumbs-down"></i></a>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>
                <div class="pull-left m-l-5 hidden-xs">
                    <div class="pull-left m-t-15">
                        <a href="#" class="btn btn-signup" style="padding: 8px 12px;" id="vote_like_{{$viewvideo->string_Id}}">
                            <i class="glyphicon glyphicon-thumbs-up"></i>
                        </a>
                        <a href="#" class="btn btn-signup" style="padding: 8px 12px;" id="vote_dislike_{{$viewvideo->string_Id}}"><i class="glyphicon glyphicon-thumbs-down"></i></a>
                    </div>
                </div>

                <div class="pull-right m-t-15">
                @if(\Session::has('User'))
                    <?php if($v_setting->is_embed==1){?>
                    <div id="embed_video" class="pull-right m-r-5">
                        <a href="#embed_video" class="btn btn-default">
                            <i class="glyphicon glyphicon-link"></i>
                            <span class="hidden-xs">Embed</span>
                        </a>
                    </div>
                    <?php }?>

                    <?php if($v_setting->is_favorite==1){?>
                    <div id="favorite" class="pull-right m-r-5">
                        <a href="javascript:void(0);" class="btn btn-default">
                            <i class="glyphicon glyphicon-star-empty"></i>
                            <span id="change_favorited" class="hidden-xs"><?=$check_favorite?></span>
                        </a>
                    </div>
                    <?php }?>
                    <div class="clearfix"></div>
                @else
                    <?php if($v_setting->is_embed==1){?>
                    <div  class="pull-right m-r-5">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#subscribe" class="btn btn-default">
                            <i class="glyphicon glyphicon-link"></i>
                            <span class="hidden-xs">Embed</span>
                        </a>
                    </div>
                    <?php }?>

                    <?php if($v_setting->is_favorite==1){?>
                    <div  class="pull-right m-r-5">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#subscribe" class="btn btn-default">
                            <i class="glyphicon glyphicon-star-empty"></i>
                            <span class="hidden-xs"><?=$check_favorite?></span>
                        </a>
                    </div>
                    <?php }?>

                    <div class="clearfix"></div>
                @endif
                </div>
                <div class="clearfix"></div>

                <div id="response_message" style="display: none;"></div>
                <div id="embed_video_box" class="m-t-15" style="display: none;">
                    <a href="#close_embed" id="close_embed" class="close">×</a>
                    <div class="separator">Embed Video</div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="video_embed_code" class="col-lg-3 control-label">Embed Code</label>
                            <div class="col-lg-9">
                                <textarea name="video_embed_code" rows="6" id="video_embed_code" class="form-control">
                                  <embed width="530" height="292" quality="high" wmode="transparent" name="main" id="main" allowfullscreen="true" allowscriptaccess="always" src="<?=$viewvideo->video_src?>" type="application/x-shockwave-flash" />
                                  </textarea>
                              </div>
                          </div>
                          <div id="custom_size" class="form-group">
                            <label for="custom_width" class="col-lg-3 control-label">Custom Size</label>
                            <div class="col-lg-9">
                                <div class="pull-left">
                                    <input id="custom_width" data-string="{{$viewvideo->string_Id}}" data-poster="{{$viewvideo->poster}}" data-src="{{$viewvideo->video_src}}" type="text" class="form-control" value="" placeholder="Width" style="width: 100px!important;">
                                </div>
                                <div class="pull-left m-l-5 m-r-5" style="line-height: 38px;">
                                    ×
                                </div>
                                <div class="pull-left m-r-15">
                                    <input id="custom_height" data-string="{{$viewvideo->string_Id}}" data-poster="{{$viewvideo->poster}}" data-src="{{$viewvideo->video_src}}" type="text" class="form-control" value="" placeholder="Height" style="width: 100px!important;">
                                </div>
                                <div class="pull-left" style="line-height: 38px;">
                                    (Min: 320 × 180)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="share_video_box" class="m-t-15" style="display: none;">
                    <a href="#close_share" id="close_share" class="close">×</a>
                    <div class="separator">Message Private</div>
                    <div id="share_video_response" style="display: none;"></div>
                    <div id="share_video_form">
                        <form class="form-horizontal" name="share_video_form" >
                            <div class="form-group">
                                <label for="share_from" class="col-lg-3 control-label">Your email</label>
                                <div class="col-lg-9">
                                    <input name="msg-email" type="text" class="form-control" value="" id="share_from" placeholder="Your Email">
                                    <div id="share_from_error" class="text-danger m-t-5" style="display: none;"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="share_message" class="col-lg-3 control-label">Message (Optional)</label>
                                <div class="col-lg-9">
                                    <textarea name="msg-content" class="form-control" rows="3" id="share_message" placeholder="Message (Optional)"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-9 col-lg-offset-3">
                                    <input type="hidden" name="string_id" value="{{$viewvideo->string_Id}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input name="submit_share" type="button" value="Send messages" id="send-msg" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="pull-right big-views text-white hidden-xs">
                    <span class="timeago text-white" title="<?php echo date(''.$viewvideo->created_at.'') ?>"></span>,
                    <span class="text-white">{{$viewvideo->total_view}}</span> views
                </div>

                <div class="pull-right big-views-xs text-white visible-xs">
                    <span class="timeago text-white" title="<?php echo date(''.$viewvideo->created_at.'') ?>"></span>,
                    <span class="text-white">{{$viewvideo->total_view}}</span> views
                </div>

                <?php if($author_post!=NULL){?>
                <div class="clearfix"></div>
                <div class="m-t-10 overflow-hidden">Added by:
                    <a class="tag" href="<?=$author_link?>">{{$author_post->firstname}} {{$author_post->lastname}}</a>
                </div>
                <?php }?>

                <?php if($channel_name!=NULL){?>
                <div class="clearfix "></div>
                <div class="m-t-10 overflow-hidden">Channel:
                    <a class="tag" href="{{URL('channel')}}/{{$channel_name->ID}}/{{$channel_name->post_name}}">{{$channel_name->title_name}}</a>
                </div>
                <?php }?>

                <?php if($pornstar_name!=NULL){?>
                <div class="clearfix "></div>
                <div class="m-t-10 overflow-hidden">Pornstar:
                    <a class="tag" href="{{URL('pornstars')}}/{{$pornstar_name->ID}}/{{$pornstar_name->post_name}}">{{$pornstar_name->title_name}}</a>
                </div>
                <?php }?>

                <?php if($viewvideo->categories_Id!=NULL) {?>
                <div class="clearfix"></div>
                <div class="m-t-10 overflow-hidden">Category:
                    <?=get_categories_list_link($viewvideo->categories_Id);?>
                </div>
                <?php } ?>

                <div class="clearfix"></div>
                <div class="m-t-10 overflow-hidden">Tags:
                    <?php foreach ($tag as $result) {?>
                    <a class="tag" href="{{URL('search.html?keyword=')}}{{$result}}">{{$result}}</a>
                    <?php } ?>
                </div>
                <div class="m-t-10 m-b-15">
                    <div class="addthis_sharing_toolbox" data-url="{{URL('watch')}}/{{$viewvideo->string_Id}}/{{$viewvideo->post_name}}.html" data-img="{{$viewvideo->poster}}" data-title="{{$viewvideo->title_name}}"></div>
                </div>
                <div class="clearfix"></div>
                <div class="m-t-10 m-b-15 text-white">{{$viewvideo->description}}</div>
            </div>
            <div class="col-sm-3 ">
                <div class="ads-here-right">
                    <p class="advertisement">ADVERTISEMENT</p>
                    <?=StandardAdVideo()?>
                </div>
                <div class="separator m-t-15 p-0"></div>
                <div class="ads-here-right">
                    <p class="advertisement">ADVERTISEMENT</p>
                    <?=StandardAdVideo()?>
                </div>
            </div>
            <div class="clearfix"></div>

            <?php if(Session::has('User')){ ?>
                <div class="col-md-9">
                    <div class="comment">
                        <h2 id="countComment">{{$countcomment}} Comments</h2>
                        <form id="frm-comment" name="frm-comment"  accept-charset="utf-8">
                            <div id="comment-msg"></div>
                            <div class="input-group">
                                <input name="comment-text" maxlength="150"  id="comment-text" type="text" value="" class="form-control" placeholder="">
                                <span class="input-group-btn">
                                    <input type="hidden" name="id" value="{{$viewvideo->string_Id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button id="send-comment" class="btn btn-signup" type="button">Add Comment</button>
                                </span>
                            </div>
                        </form>

                    <span  align="right" class="pull-right pading border_b width-100"><i>Max length:</i> <i id="show-text-length">150</i></span>
                    <div class="clearfix"></div>
                    <div id="result-comment" class="result-comment">
                        <ol  id="update" class="timeline">

                            @if(isset($getcomment))

                            {{dumpComments($getcomment)}}

                            @include('video.loadmore')
                            @else
                            No comment
                            @endif
                        </ol>
                        <div id="flash" align="left"  ></div>
                        <div id="commentAction">
                            @if($countcomment>0)
                            @if($countcomment >4)
                            <div align="center"><input id="loadmore"  type="button" style="width:100%;" class="btn btn-load" name="load-more" value="Load More Comments"></div>
                            @else
                            <div align="center"><input id="loadmore"  type="button" style="display: none;width: 100%" class="btn btn-load" name="load-more" value="Load More Comments"></div>
                            @endif
                            <div align="center"><input id="loadback"  type="button" style="width:100%;" class="btn btn-load" name="loadback" value="Load back"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <?php }else {?>
            <div class="col-md-9">
                <h2>Please Login To Comment</h2>
            </div>
            <?php } ?>
            </div>
            <div class="clearfix" style="min-height: 5px;"></div>
            <h2>Related Videos  <span></span></h2>

            <div class="row">
                @foreach($related as $result)
                <?php $rating=GetRatingVideo($result->string_Id);?>
                <div class="col-sm-6 col-sm-3 image-left">
                    <div class="col">
                        <div class="col_img">
                            <span class="hd">HD</span>
                            <a href="{{URL('watch')}}/{{$result->string_Id."/".$result->post_name}}.html">
                            <img src="{{$result->getImageUrl($result->poster)}}" alt="{{$result->title_name}}" style="max-width: 100% !important" height="177" />
                            <div class="position_text">
                                <p class="icon-like"></p>
                                <p class="percent">{{floor($rating['percent_like'])}}%</p>
                                <p class="time_minimute">{{sec2hms($result->duration)}}</p>
                            </div>
                        </div>
                        <h3><a href="{{URL('watch')}}/{{$result->string_Id."/".$result->post_name}}.html">{{str_limit($result->title_name,30)}}</a></h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="subscribe" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="panel panel-primary">
                        <div class="panel-heading">warning!:</div>
                        <div class="panel-body">
                           <p id="messages">Please login or signup</p>
                       </div>
                   </div>
               </div>
           </div>
        </div>

        <div id="modal-msg-box" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="panel panel-primary">
                    <div class="panel-heading">Send messages</div>
                    <div class="panel-body">
                        <div id="msg-all-center"></div>
                        <form >
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="emails">Your Email: </label>
                                    <div id="email-msg-alert" class="alert-error"></div>
                                    <input type="email" class="form-control" value="" id="emails" name="msg-email" placeholder="Your email here !" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lastname">message content: </label>
                                    <div id="content-msg-alert" class="alert-error"></div>
                                    <textarea class="form-control" rows="5" name="msg-content"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6 pull-right">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="button" name="send-msg"  id="send-msg" value="Send" class="btn btn-signup pull-right">
                                <input type="button" data-dismiss="modal" id="cancel" class="btn btn-signup pull-right" style="margin-right: 5px;" value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal_show_subscribe" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="panel panel-primary">
                    <div class="panel-heading">Subscribe {{$viewvideo->title_name}}</div>
                    <div class="panel-body">
                        <p id="modal_content_subscribe"></p>
                    </div>
                    <div class="panel-footer">
                        <div class="input-group" style="width: 100%;">
                            <input type="button" data-dismiss="modal" class="btn btn-signup pull-right" style="margin-right: 5px;" value="Close">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_show_favorite" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="panel panel-primary">
                <div class="panel-heading">Favorite</div>
                <div class="panel-body">
                    <p id="modal_content_favorite"></p>
                </div>
                <div class="panel-footer">
                    <div class="input-group" style="width: 100%;">
                        <input type="button" data-dismiss="modal" class="btn btn-signup pull-right" style="margin-right: 5px;" value="Close">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $(document).on('click','#send-comment',function (e) {
        e.preventDefault();
        var comment = $("#comment-text").val();

        if(comment == '') {
            $('#comment-msg').html('<div class="alert alert-danger"><span  class="glyphicon glyphicon-remove"></span><strong> Invalid Comment cannot be blank</strong></div>').fadeIn().delay(10000).fadeOut();
            $("#comment-text").focus();
        } else {
            $("#flash").show();
            $("#flash").fadeIn(400).html('<img src="{{URL("public/assets/images/result_loading.gif")}}" align="absmiddle">&nbsp;<span class="loading">Loading Comment...</span>');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content');
                }
            });
            $.ajax({
                url: "{{URL('comment.html')}}",
                type: "POST",
                data:{
                    'comment_text':$('input[name=comment-text]').val(),
                    '_token':$('input[name=_token]').val(),
                    'id':$('input[name=id]').val()
                },
                success:function(data) {
                    reloadComment();
                    $("ol#update li").fadeIn("slow");
                    document.getElementById('comment-text').value='';
                    $("#comment-text").focus();
                    $("#flash").hide();
                }
            });
        }
    });

    var page = 1;
    var currentPage = 1;
    $('#testload').hide();
    $('#loadback').hide();
    $(document).on('click','#loadmore', function(){
        currentPage = page;
        page=page+1
        getpagecomment(page);
    });

    function reloadComment() {
        $.ajax({
            url:"{{URL()}}/loadmore/{{$viewvideo->string_Id}}.html?page=1",
            success: function (data) {
                var commentObject = $.parseJSON(data.commentObject);
                $("ol#update").empty().append(data.html);
                if(commentObject.total > 4) {
                    if(!$("#loadmore").length) {
                        $("#commentAction").append(' <div align="center"><input id="loadmore"  type="button" style="width:100%;" class="btn btn-load" name="load-more" value="Load More Comment"></div>');
                    }
                    $('#loadmore').show();
                }
                $("#countComment").html(commentObject.total + ' comments');
            }
        });
        $('#loadback').hide();
    }

    function getpagecomment(page) {
        $.ajax({
            url: "{{URL()}}/loadmore/{{$viewvideo->string_Id}}.html?page=" + page,
            success: function (data) {
                var commentObject = $.parseJSON(data.commentObject);
                if(currentPage == commentObject.last_page) {
                    $("#loadmore").hide();
                } else {
                    $("ol#update").empty().append(data.html);
                }
            },
            beforeSend: function () {
                $('#flash').html("<img src='{{URL('public/assets/images/result_loading.gif')}}'/>").show();
            },
            complete: function () {
                $('testload').fadeIn("slow");
                $('#flash').html("<img src='{{URL('public/assets/images/result_loading.gif')}}'/>").hide();
            }
        });
    }

    $('#testload').hide();
    $(document).on('click','#loadback', function() {
        page--;
        getbackpagecomment(page);
        if(page==1) {
            $('#loadmore').show();
            $('#loadback').hide();
        }
    });
    function getbackpagecomment(page){
        $.ajax({
            url:"{{URL()}}/loadmore/{{$viewvideo->string_Id}}.html?page=" + page,
            success: function (data) {
                $("ol#update").empty().append(data.html);
            },
            beforeSend: function () {
                $('#flash').html("<img src='{{URL('public/assets/images/result_loading.gif')}}'/>").show();
            },
            complete: function () {
                $('testload').fadeIn("slow");
                $('#flash').html("<img src='{{URL('public/assets/images/result_loading.gif')}}'/>").hide();
            }
        });
    }
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.codo-player-container').append('<div class="ads"></div>');
    $(document).on('click','#download a',function(e) {
        e.preventDefault();
        window.open('{{URL()}}/{{$viewvideo->post_name}}.{{$viewvideo->string_Id}}/download.html');
    });

    $(document).on('click','#subscribe a',function(e) {
        e.preventDefault();
        $.ajax({
            url:"{{URL()}}/{{$viewvideo->post_name}}.{{$viewvideo->string_Id}}/subscribe.html",
            success:function(data) {
                if(data == "Channel not found !") {
                    $('#modal_content_subscribe').empty().append(data);
                    $('#modal_show_subscribe').modal('show');
                } else {
                    $('#modal_content_subscribe').empty().append(data);
                    $('#modal_show_subscribe').modal('show');
                    $('#change_subscribed').empty().text('Subscribed')
                }
            }
        });
    });

    $(document).on('click','#favorite a',function(e) {
        e.preventDefault();
        $.ajax({
            url:"{{URL()}}/{{$viewvideo->post_name}}.{{$viewvideo->string_Id}}/favorite.html",
            success:function(data) {
                if(data) {
                    $('#modal_content_favorite').empty().append(data);
                    $('#modal_show_favorite').modal('show');
                    $('#change_favorited').empty().text('Favorited')
                }
            }
        });
    });
});
</script>

<script type="text/javascript">
var firstLoad = true;
$(window).load(function() {
    var length=$('#comment-text').attr('maxlength');
    $('#comment-text').keyup(function() {
        var current=$(this).val();
        var count_length=length - current.length;
        $('#show-text-length').text(count_length);
    });
});
function showlogin() {
    $('#myModal').modal('show');
}
$(document).on('click','#close-ads-text',function(){
    $('#adult-player-01 .ads').fadeOut();
});
</script>
@endsection