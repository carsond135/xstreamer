<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogModel;
use App\Models\CategoriesModel;
use App\Models\ChannelModel;
use App\Models\VideoCat;
use App\Models\VideoModel;
use App\Models\WatchNowModel;
use App\Services\Modules\Modules;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

/**
* Class is Home controller
*
* @author UIT_DEV
*/
class HomeController extends Controller
{
	/**
	* Get data for home page
	* 
	* @return data to home view
	*/
	public function getIndex() {
		$indexnew = VideoModel::where('status', '=', 1)->where('featured', '=', 1)
			->OrderBy('created_at', 'DESC')
			->take(4)
			->get();

		$get_watch_now = VideoModel::select('video.*', 'watch_now.video_id')
			->join('watch_now', 'watch_now.video_id', '=', 'video.string_Id')
			->take(4)
			->OrderbyRaw('RAND()')
			->get();

		$today = "";
    	$todoRating = '';

    	$today_post = VideoModel:: where('status', '=', 1)
			->where('created_at', 'like', ''.date('Y-m-d').'%')
			->groupBy('post_name')
			->groupBy('duration')
			->orderby('created_at', 'DESC')
			->paginate(20);

    	$today_rating = VideoModel:: where('status', '=', 1)
			->orderby('total_view', 'DESC')
			->paginate(20);

	    if(count($today_post) > 0) {
			$today=$today_post;
			if($today->currentPage() >= 2) {
				return redirect('rating-video/?page='.$today->currentPage().'');
			}
	    }

	    if(count($today_rating) > 0) {
			$todoRating=$today_rating;
			if($todoRating->currentPage() >= 2) {
				return redirect('views/?page='.$todoRating->currentPage().'');
			}
	    }

	    $categoris = CategoriesModel::where('status', '=', 1)
			->orderby('title_name','asc')
			->get();

	    return view('home.index')->with('indexnew', $indexnew)
			->with('watch_now', $get_watch_now)
			->with('categories', $categoris)
			->with('today', $today)
			->with('todayRating', $todoRating)
			->with('recomment', $this->getRecommentVideo());
	}

	/**
	* Get recomment video
	* 
	* @return list videos
	*/
	public function getRecommentVideo() {
		$recomment = CategoriesModel::select('categories.*', 'video_cat.video_id', 'video_cat.cat_id')
			->where('categories.recomment', '=', 1)
			->join('video_cat', 'video_cat.cat_id', '=', 'categories.ID')
			->take(4)
			->OrderbyRaw("RAND()")
			->groupBy('categories.ID')
			->get();

		return $recomment;
	}

	/**
	* Get all categories
	*
	* @return list categories
	*/
	public function getCategories() {
		$categoris = CategoriesModel::where('status', '=', 1)
			->orderby('title_name', 'ASC')
			->get();

		return $categoris;
	}

	/**
	* Get video order by views
	*
	* @return list video
	*/
	public function getOrderViews() {
		$videos = VideoModel::where('status', '=', 1)
			->orderby('total_view', 'DESC')
			->paginate(20);

		return view('home.filter')
			->with('videos', $videos)
			->with('filter_flag', 'Views')
			->with('categories', $this->getCategories());
	}

	/**
	* Get video order by rating
	*
	* @return list video
	*/
	public function getOrderRating() {
		$videos = VideoModel::where('status', '=', 1)
			->orderby('rating', 'DESC')
			->paginate(20);

		return view('home.filter')
			->with('videos', $videos)
			->with('filter_flag', 'Rating')
			->with('categories', $this->getCategories());
	}
	
	/**
	* Get video order by duration
	* 
	* @return list video
	*/
	public function getOrderDuration() {
		$videos = VideoModel::where('status', '=', 1)
			->orderby('duration', 'DESC')
			->paginate(20);

		return view('home.filter')
			->with('videos', $videos)
			->with('filter_flag', 'Duration')
			->with('categories', $this->getCategories());
	}

	/**
	* Get video order by date
	* 
	* @return list video
	*/
	public function getOrderDate() {
		$videos = VideoModel::where('status', '=', 1)
			->orderby('created_at', 'DESC')
			->paginate(20);

		return view('home.filter')
			->with('videos', $videos)
			->with('filter_flag', 'Date')
			->with('categories', $this->getCategories());
	}
}