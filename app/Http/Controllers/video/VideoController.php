<?php

namespace App\Http\Controllers\video;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogModel;
use App\Models\CategoriesModel;
use App\Models\ChannelModel;
use App\Models\ConversionModel;
use App\Models\MemberModel;
use App\Models\MemberVideoModel;
use App\Models\OptionModel;
use App\Models\VideoAdsModel;
use App\Models\VideoModel;
use App\Models\VideoCommentModel;
use App\Models\VideoCatModel;
use App\Models\VideoTextAdsModel;
use App\Models\PornStarModel;
use App\Models\RatingModel;
use App\Models\StaticPageModel;
use App\Models\SubsriptionModel;
use App\Models\WatchNowModel;
use App\Services\Modules\Modules;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

/**
* CLass is Video controller
*
* @author UIT_DEV
*/
class VideoController extends Controller
{
    /**
    * Get data video detail page
    * 
    * @param video Id
    * @param video name
    * @return view index of video detail
    */
    public function getIndex($string_Id, $name) {
        $detailview = VideoModel::where('String_Id', '=', $string_Id)->first();

        $check_watch = WatchNowModel::where('video_id', '=', $string_Id)->first();
        $video_id = $string_Id;
        $time = time();

        if($check_watch != NULL) {
            $update = WatchNowModel::where('video_id', '=', $string_Id)->update(array('time'=>$time));
        } else {
            $add_watch = new WatchNowModel();
            $add_watch->video_id = $video_id;
            $add_watch->time = $time;
            $add_watch->save();
        }

        if($detailview->status == 1) {
            return view('video.index')->with('viewvideo', $detailview)
                ->with('categories', $this->getCategories())
                ->with('related', $this->getVideoRelated($detailview->ID, $detailview->categories_Id))
                ->with('recomment', $this->getVideoRecomment($detailview->ID))
                ->with('share', 'HELLO')
                ->with('getcomment', $this->getComment($string_Id))
                ->with('countcomment', $this->getCountComment($string_Id))
                ->with('videoads', $this->getAds())
                ->with('percent_like', $this->getLikePercent($string_Id))
                ->with('ads_video', NULL)
                ->with('tag', $this->getTag($string_Id))
                ->with('author_post', $this->getAuthorUploadVideo($string_Id))
                ->with('user_subscribe', $this->checkSubscribe($detailview->channel_Id))
                ->with('author_link', $this->getLinkMember($string_Id))
                ->with('channel_name', $this->getChannelName($detailview->channel_Id))
                ->with('pornstar_name', $this->getPornstarName($detailview->pornstar_Id))
                ->with('check_favorite', $this->checkFavorited($string_Id));
        }

        if($detailview->status == 3) {
            return redirect('member-proflie.html')
                ->with('msg','Message: Video has been blocked by Administrator. Please contact  Administrator to unblock this video !');
        }

        if($detailview->status == 0) {
            return redirect('member-proflie.html')
                ->with('msg','Message: Your video must be check by Administrator. Please wait or contact  Administrator ! ');
        }
    }

    /**
    * Get list video related
    * 
    * @param video Id
    * @param category Id
    * @return list video related
    */
    public function getVideoRelated($video_id, $categories_id) {
        $related = VideoModel::where('status', '=', 1)
            ->where('ID', '<>', $video_id)
            ->take(4)
            ->orderByRaw("RAND()")
            ->get();

        return $related;
    }

    /** 
    * Get list video recomment
    * 
    * @param video Id
    * @return list video recomment
    */
    public function getVideoRecomment($video_id) {
        $recomment = VideoModel::select('video.*', 'categories.ID', 'categories.recomment')
            ->where('video.status', '=', 1)
            ->where('categories.status', '=', 1)
            ->where('video.ID', '<>', $video_id)
            ->join('categories', 'video.categories_Id', '=', 'categories.ID')
            ->take(4)
            ->orderByRaw('RAND()')
            ->get();

        return $recomment;
    }

    /**
    * Get list comment of video
    * 
    * @param video Id
    * @return list comments
    */
    public function getComment($string_Id) {
        if (\Session::has('User')) {
            $user = \Session::get('user');
            $getcomment = VideoCommentModel::select('video_comment.*', 'members.firstname', 'members.lastname', 'members.avatar', 'members.user_id')
                ->where('video_Id', '=', $string_Id)
                ->where('comment_parent', 0)
                ->join('members', 'video_comment.member_Id', '=', 'members.user_id')
                ->orderby('video_comment.ID', 'DESC')
                ->paginate(4);

            return $getcomment;
        } else {
            return 'Login to see more comment';
        }
    }

    /**
    * Get number comment of video
    * 
    * @param video Id
    * @return number count comments
    */
    public function getCountComment($string_Id) {
        $countcomment = VideoCommentModel::where('video_id', '=', $string_Id)->count();
        return $countcomment;
    }

    /**
    * Get ads function
    *
    * @return list ads
    */
    public function getAds() {
        $Ads = VideoTextAdsModel::where('status', '=', 1)->get();
        $array = array();
        for ($i = 0; $i < count($Ads); $i++) {
            array_push($array, array(
                'point' => $Ads[$i]->cuepoint,
                'content' => $Ads[$i]->ads_content,
                'adsurl' => $Ads[$i]->return_url,
                'timedelay' => $Ads[$i]->delay_time,
                'position' => $Ads[$i]->position,
                'ads_title' => $Ads[$i]->ads_title
            ));
        }

        return $array;
    }

    /**
    * Get like percent of video
    *
    * @param video Id
    * @return number percent like
    */
    public function getLikePercent($string_id) {
        return RatingModel::get_percent($string_id);
    }

    /**
    * Get list tags of video
    *
    * @param video Id
    * @return list tags
    */
    public function getTag($string_id) {
        $get_tag = VideoModel::where('string_Id', '=', $string_id)->first();
        if($get_tag != NULL){
            $tag_array = explode(',', $get_tag->tag);
            return $tag_array;
        }
    }

    /**
    * Get info author upload video
    *
    * @param video Id
    * @return info author
    */
    public function getAuthorUploadVideo($string_id) {
        $check_author = VideoModel::where('string_Id', '=', $string_id)->first();
        if($check_author != NULL) {
            if($check_author->user_id != NULL) {
                $get_author= VideoModel::select('video.string_Id','video.user_id','members.firstname','members.lastname','members.avatar')
                    ->where('video.string_Id','=',$string_id)
                    ->join('members','members.user_id','=','video.user_id')
                    ->first();
                return $get_author;
            }
        }
    }

    /**
    * Function check user has subscribe
    *
    * @param user Id
    * @return status subscribe
    */
    public function checkSubscribe($id) {
        if(\Session::has('User')) {
            $user = \Session::get('User');
            $user_id = $user->user_id;
            $checkchannel = ChanneSubscriberModel::where('channel_Id', '=', $id)->first();
            if(count($checkchannel)) {
                $users = explode(',', $checkchannel->member_Id);
                if (in_array($user_id, $users)) {
                    return 'Subscribed';
                } else {
                    return 'Subscribe';
                }
            } else {
                return 'Subscribe';
            }
        } else {
            return 'Subscribe';
        }
    }

    /**
    * Get link member
    *
    * @param video Id
    * @return link member
    */
    public function getLinkMember($string_id) {
        if(\Session::has('User')) {
            $user = \Session::get('User');
            $check_author = VideoModel::select('video.string_Id','video.user_id','members.firstname','members.lastname','members.avatar')
                    ->where('video.string_Id', '=', $string_id)
                    ->join('members', 'members.user_id', '=', 'video.user_id')
                    ->first();

            if($check_author != NULL) {
                if($check_author->user_id != NULL) {
                    if($check_author->user_id == $user->user_id) {
                        $link = URL('member-profile.html');
                        return $link;
                    } else {
                        $link = URL('profile/'.$check_author->user_id.'/'.str_slug($check_author->firstname.' '.$check_author->lastname).'.html');
                        return $link;
                    }
                }
            }
        }
    }

    /**
    * Get channel name of video
    *
    * @param channel Id
    * @return channel
    */
    public function getChannelName($channel_id) {
        $channel = ChannelModel::where('ID', '=', $channel_id)->first();
        if($channel != NULL) {
            return $channel;
        } else {
            return NULL;
        }
    }

    /**
    * Get pornstar name of video
    *
    * @param pornstar Id
    * @return pornstar
    */
    public function getPornstarName($pornstar_id) {
        $pornstar = PornStarModel::where('ID', '=', $pornstar_id)->first();
        if($pornstar != NULL) {
            return $pornstar;
        } else {
            return NULL;
        }
    }

    /**
    * Function check user favorited video
    * 
    * @param video Id
    * @return status favorited
    */
    public function checkFavorited($string_id) {
        if(\Session::has('User')) {
                $user = \Session::get('User');
                $member_video = MemberVideoModel::where('member_Id', '=', $user->id)->first();
                if($member_video != NULL) {
                    $video_list= explode(',', $member_video->video_Id);
                    if(in_array($string_id, $video_list)){
                        return "Favorited";
                    } else {
                        return "Add to My Favorite Videos";
                    }
                } else {
                    return "Add to My Favorite Videos";
                }
        } else {
            return "Add to My Favorite Videos";
        }
    }

	/**
    * Get video by action and category
    * 
    * @param action get
    * @param category Id
    * @return call method by action
    */
    public function getVideoByAction($action=NULL, $catId=NULL) {
        if($action != NULL) {
            switch ($action) {
                case 'all':
                    return $this->getAllVideos();
                    break;
                case 'cat':
                    return $this->getVideoByCategory($catId);
                    break;
                case 'new':
                    return $this->getVideoNew($action);
                    break;
                case 'most-favorited':
                    return $this->getVideoMostFavorite($action);
                    break;
                case 'most-commented':
                    return $this->getVideoMostCommented($action);
                    break;
                default:
                    return $this->getVideoByCategory($catId);
                	break;
            }
        } else {
            return redirect('/');
        }
    }

    /**
    * Get all videos
    * 
    * @return list all videos
    */
    public function getAllVideos() {
        $video = VideoModel::where('status', '=', 1)->paginate(12);
        return view('video.video')
            ->with('video', $video)
            ->with('categories', $this->getCategories())
            ->with('title', 'All Videos');
    }

    /**
    * Get list video by category
    * 
    * @param category Id
    * @return view video category detail
    */
    public function getVideoByCategory($catId) {
        $checkCatId = CategoriesModel::find($catId);
        if($checkCatId != NULL) {
            $video_cat = VideoModel::select('video.*', 'categories.title_name as cat_name')
                ->where('video.categories_Id', '=', $catId)
                ->join('categories','categories.ID', '=', 'video.categories_Id')
                ->paginate(12);

            return view('video.video_cat')
            	->with('video_cat', $video_cat)
            	->with('categories', $this->getCategories())
            	->with('catname', $checkCatId->title_name);
        } else {
            return redirect('video.html&action=all')
            	->with('action', 'all')
            	->with('msg','Category not found. Please try another category');
        }
    }

    /**
    * Get list video new
    *
    * @return list video new
    */
    public function getVideoNew($action) {
        $video = VideoModel::where('status', '=', 1)
            ->orderBy('created_at','DESC')
            ->paginate(12);

        return view('video.video')
            ->with('video', $video)
            ->with('categories', $this->getCategories())
            ->with('title', 'Newest Videos')
            ->with('action', $action);
    }

    /**
    * Get list categories.
    *
    * @return list categories.
    */
    public function getCategories() {
        $categories = CategoriesModel::where('status', '=', '1')
            ->orderby('title_name','ASC')
            ->get();

        return $categories;
    }

    /**
    * Get video most favorite
    *
    * @param action get
    * @return list videos
    */
    public function  getVideoMostFavorite($action) {
        $get_favorite = MemberVideoModel::where('status', '=', 1)->get();
        $list_temp = array();
        for ($i = 0; $i < count($get_favorite); $i++) {
            if(!in_array($get_favorite[$i]->video_Id,$list_temp)) {
                array_push($list_temp,$get_favorite[$i]->video_Id);
            }
        }
        $new_array = implode(',', $list_temp);
        $array = explode(',', $new_array);
        $listvideo_temp = array_unique($array);
        $new_list = implode(',', $listvideo_temp);

        $video = VideoModel::where('status', '=', 1)
            ->whereIn('string_Id', $listvideo_temp)
            ->Orderby('title_name', 'DESC')
            ->paginate(12);

        return view('video.video')
            ->with('video', $video)
            ->with('categories', $this->getCategories())
            ->with('title', 'Most Favorited Videos')
            ->with('action', $action);
    }

    /**
    * Get video most commented
    * 
    * @param action get
    * @return view videos most commented
    */
    public function getVideoMostCommented($action) {
        $get_comment = VideoCommentModel::Groupby('video_Id')->get();
        $list_comment_array = array();
        for($i = 0; $i < count($get_comment); $i++) {
            array_push($list_comment_array,$get_comment[$i]->video_Id);
        }
        $video = VideoModel::where('status', '=', 1)
            ->whereIn('string_Id', $list_comment_array)
            ->orderBy('title_name', 'DESC')
            ->paginate(12);

        return view('video.video')
            ->with('video', $video)
            ->with('categories', $this->getCategories())
            ->with('title', 'Most Commented On Videos')
            ->with('action', $action);
    }

    /**
    * Get video by action filter
    *
    * @param action get
    * @param date get
    * @param time duration get
    * @return list video by filter
    */
    public function getActionFilter($action, $date, $time) {
        if(\Request::ajax()) {
           switch ($action) {
                case 'new':
                    return $this->getFilterNewestVideo($action, $date, $time);
                    break;
                case 'most-favorited':
                    return $this->getFilterFavoritedVideo($action, $date, $time);
                    break;
                case 'most-commented':
                    return $this->getFilterCommentedVideo($action, $date, $time);
                    break;
            }
        } else {
            return redirect('video.html&action='.$action.'');
        }
    }

    /**
    * Get video filter by newest
    *
    * @param action get
    * @param date get
    * @param time get
    * @return list video by filter
    */
    public function getFilterNewestVideo($action, $date, $time) {
        $compare = "=";
        if ($time == 'all') {
            $fist = 0;
            $end = 7200;
            $time ="";
            $time_name = "All Duration";
        }
        if ($time == "1-3") {
            $fist = 1;
            $end = 180;
            $time = "1-3";
            $time_name = "videos (1-3min)";
        }
        if ($time == "3-10") {
            $fist = 181;
            $end = 600;
            $time = "3-10";
            $time_name = "videos (3-10min)";
        }
        if ($time == "10+") {
            $fist = 601;
            $end = 7200;
            $time = "10+";
            $time_name = "videos (10+min)";
        }
        if($date != "today") {
            if($date == "week") {
                $lastweek = date_create('Sunday last week');
                $thisweek = date_create('Sunday this week');
                $video = VideoModel::whereRaw("updated_at BETWEEN '".get_object_vars($lastweek)['date']."' and '".get_object_vars($thisweek)['date']."'  and duration BETWEEN ".$fist." and ".$end."")
                    ->orderBy('created_at', 'DESC')
                    ->paginate(20);
            }
            if($date == "month") {
                $video = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
                    ->where(DB::raw('MONTH(updated_at)'), '=', date('n'))
                    ->orderby('created_at', 'DESC')
                    ->paginate(20);
            }
            if($date == "all") {
                $video = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
                ->where('status', '=', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
            }
         } else {
            $video = VideoModel::whereBetween('duration',array($fist,$end))
                ->where('created_at', 'like', ''.date('Y-m-d').'%' )
                ->orderby('created_at','DESC')
                ->groupBy('ID')
                ->paginate(20);
        }

        if($video) {
            return view('video.video_filter')
                ->with('video', $video)
                ->with('date', $date)
                ->with('time', $time_name)
                ->with('data_time', $time);
        }
    }

    /**
    * Get video filter by favorited
    *
    * @param action get
    * @param date get
    * @param time get
    * @return list video by filter
    */
    public function getFilterFavoritedVideo($action, $date, $time) {
        $get_favorite = MemberVideoModel::get();
        $list_temp = array();
        for ($i = 0; $i < count($get_favorite); $i++) {
            if(!in_array($get_favorite[$i]->video_Id,$list_temp)) {
                array_push($list_temp,$get_favorite[$i]->video_Id);
            }
        }
        $new_array = implode(',', $list_temp);
        $array = explode(',', $new_array);
        $listvideo_temp = array_unique($array);
        $new_list = implode(',', $listvideo_temp);

        $compare = "=";
        if ($time == 'all') {
            $fist = 0;
            $end = 7200;
            $time = "";
            $time_name = "All Duration";
        }
        if ($time == "1-3") {
            $fist = 1;
            $end = 180;
            $time = "1-3";
            $time_name = "videos (1-3min)";
        }
        if ($time == "3-10") {
            $fist = 181;
            $end = 600;
            $time = "3-10";
            $time_name = "videos (3-10min)";
        }
        if ($time == "10+") {
            $fist = 601;
            $end = 7200;
            $time = "10+";
            $time_name = "videos (10+min)";
        }
        if($date != "today") {
            if($date == "week") {
                $lastweek = date_create('Sunday last week');
                $thisweek = date_create('Sunday this week');
                $video = VideoModel::whereRaw("updated_at BETWEEN '".get_object_vars($lastweek)['date']."' and '".get_object_vars($thisweek)['date']."'  and duration BETWEEN ".$fist." and ".$end."")
                    ->where('status', '=', 1)
                    ->whereIn('string_Id', $listvideo_temp)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(20);
            }
            if($date == "month") {
                $video = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
                    ->where(DB::raw('MONTH(updated_at)'), '=', date('n'))
                    ->where('status', '=', 1)
                    ->whereIn('string_Id', $listvideo_temp)
                    ->orderby('created_at', 'DESC')
                    ->paginate(20);
            }
            if($date == "all") {
                $video = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
                ->where('status', '=', 1)
                ->whereIn('string_Id', $listvideo_temp)
                ->orderby('created_at', 'DESC')
                ->paginate(20);
            }
         } else {
            $video = VideoModel::whereBetween('duration',array($fist,$end))
                ->whereIn('string_Id', $listvideo_temp)
                ->where('created_at', 'like', ''.date('Y-m-d').'%' )
                ->where('status', '=', 1)
                ->orderBy('created_at', 'DESC')
                ->groupBy('ID')
                ->paginate(20);
        }


        if($video){
            return view('video.video_filter')
                ->with('video', $video)
                ->with('date', $date)
                ->with('time', $time_name)
                ->with('data_time', $time);
        }
    }

    /**
    * Get video filter by commented
    *
    * @param action get
    * @param date get
    * @param time get
    * @return list video by filter
    */
    public function getFilterCommentedVideo($action, $date, $time) {
        $get_comment = VideoCommentModel::Groupby('video_Id')->get();
        $list_comment_array = array();
        for($i = 0; $i < count($get_comment); $i++) {
            array_push($list_comment_array,$get_comment[$i]->video_Id);
        }
        $compare = "=";
        if ($time == 'all') {
            $fist = 0;
            $end = 7200;
            $time = "";
            $time_name = "All Duration";
        }
        if ($time == "1-3") {
            $fist = 1;
            $end = 180;
            $time = "1-3";
            $time_name = "videos (1-3min)";
        }
        if ($time == "3-10") {
            $fist = 181;
            $end = 600;
            $time = "3-10";
            $time_name = "videos (3-10min)";
        }
        if ($time == "10+") {
            $fist = 601;
            $end = 7200;
            $time = "10+";
            $time_name = "videos (10+min)";
        }
        if($date != "today") {
            if($date == "week") {
                $lastweek = date_create('Sunday last week');
                $thisweek = date_create('Sunday this week');
                $video = VideoModel::whereRaw("updated_at BETWEEN '".get_object_vars($lastweek)['date']."' and '".get_object_vars($thisweek)['date']."'  and duration BETWEEN ".$fist." and ".$end."")
                    ->whereIn('string_Id', $list_comment_array)
                    ->where('status', '=', 1)
                    ->orderby('created_at', 'DESC')
                    ->paginate(20);
            }
            if($date == "month") {
                $video = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
                    ->where(DB::raw('MONTH(updated_at)'), '=', date('n'))
                    ->whereIn('string_Id', $list_comment_array)
                    ->where('status', '=', 1)
                    ->orderby('created_at', 'DESC')
                    ->paginate(20);
            }
            if($date == "all") {
                $video = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
                    ->whereIn('string_Id', $list_comment_array)
                    ->where('status', '=', 1)
                    ->where('status', '=', '1')
                    ->orderby('created_at', 'DESC')
                    ->paginate(20);
            }
         } else {
            $video = VideoModel::whereBetween('duration', array($fist, $end))
                ->where('created_at', 'like', ''.date('Y-m-d').'%' )
                ->whereIn('string_Id', $list_comment_array)
                ->where('status', '=', 1)
                ->orderby('created_at', 'DESC')
                ->groupBy('ID')
                ->paginate(20);
        }
        if($video) {
            return view('video.video_filter')
                ->with('video', $video)
                ->with('date', $date)
                ->with('time', $time_name)
                ->with('data_time', $time);
        }
    }

    /**
    * Get search result
    *
    * @param keyword to search
    * @return list video result search
    */
    public function getSearchVideo(Request $str) {
        if($str->keyword != NULL && $str->keyword != "") {
            $keyword = $str->keyword;
            $getvideo = VideoModel::where(function($query) use ($keyword) {
                    $query->where(function($query) use ($keyword) {
                    $query->where('post_name', 'LIKE', '%' . str_slug($keyword) . '%');
                    $query->Orwhere('tag', 'LIKE', '%' .$keyword. '%');
                    });
                })
                ->orderby('title_name','DESC')
                ->paginate(20);

            $getvideo->appends(array('keyword'=>$str->keyword));
            return view('search.index')
                ->with('video', $getvideo)
                ->with('keyword', $str->keyword)
                ->with('categories', $this->getCategories());
        } else {
            return redirect('/');
        }
    }

    /**
    * Get search result and filter
    * 
    * @param keyword to search
    * @param sort by column
    * @param filter by date
    * @param filter by time duration
    * @return list videos result search
    */
    public function getSearchFilter($keyword, $sort, $date, $time) {
        if(\Request::ajax()) {
            $fist = 0;
            $end = 7200;
            $des = 'DESC';
            if($sort == 'relevance') {
                $order = "title_name";
            }
            if($sort == 'uploaddate') {
                $order = "created_at";
            }
            if($sort == 'rating') {
                $order = 'rating';
            }
            if($sort == "mostviewed"){
                $order = 'total_view';
            }

            if($time == 'all') {
                $fist = 0;
                $end = 7200;
                $time = "";
                $time_name = "";
            }
            if($time== "1-3") {
                $fist = 1;
                $end = 180;
                $time = "1-3";
                $time_name = "videos (1-3min)";
            }
            if($time == "3-10") {
                $fist = 181;
                $end = 600;
                $time = "3-10";
                $time_name = "videos (3-10min)";
            }
            if($time == "10+") {
                $fist = 601;
                $end = 7200;
                $time = "10+";
                $time_name = "videos (10+min)";
            }

            if($date == "week") {
                $lastweek = date_create('Sunday last week');
                $thisweek = date_create('Sunday this week');
                $search_result = VideoModel::whereRaw("updated_at BETWEEN '".get_object_vars($lastweek)['date']."' and '".get_object_vars($thisweek)['date']."'  and duration BETWEEN ".$fist." and ".$end." and  (post_name LIKE '%". str_slug($keyword) . "%' or tag LIKE '%". str_slug($keyword) . "%')")
                    ->where('status', '=', 1)
                    ->orderby($order, $des)
                    ->paginate(20);

            }
            if($date == "month") {
                $search_result = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end." and  (post_name LIKE '%". str_slug($keyword) . "%' or tag LIKE '%". str_slug($keyword) . "%')")->where(DB::raw('MONTH(updated_at)'), '=', date('n'))
                        ->where('status', '=', 1)
                        ->orderby($order, $des)
                        ->paginate(20);
            }
            if($date == "today") {
                $search_result = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end." and  (post_name LIKE '%". str_slug($keyword) . "%' or tag LIKE '%". str_slug($keyword) . "%') and created_at LIKE '%".date('Y-m-d')."%' ")
                ->where('status', '=', '1')
                ->orderby($order, $des)
                ->paginate(20);
            }
            else {
                $search_result = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end." and  (post_name LIKE '%". str_slug($keyword) . "%' or tag LIKE '%". str_slug($keyword) . "%')")
                ->where('status', '=', 1)
                ->orderby($order, $des)
                ->paginate(20);
            }

            if($search_result) {
                $count = count($search_result);
                return view('search.filter')->with('video', $search_result)->with('count_video', $count);
            }
        } else {
            return redirect('search.html?keyword=' . $keyword);
        }
    }

    /**
    * Get static page by Id
    *
    * @param static Id
    * @return view static
    */
    public function showStaticPage($id) {
        if($id != NULL) {
            $checkid = StaticPageModel::find($id);
            if($checkid != NULL) {
                return view('static.index')->with('static', $checkid)->with('categories', $this->getCategories());
            } else {
                return redirect('/')->with('msg', 'Page not found !');
            }
        } else {
            return redirect('/')->with('msg', 'Page not found !');
        }
    }
}