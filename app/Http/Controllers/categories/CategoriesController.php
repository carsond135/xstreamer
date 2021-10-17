<?php

namespace App\Http\Controllers\categories;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogModel;
use App\Models\CategoriesModel;
use App\Models\ChannelModel;
use App\Models\CountriesModel;
use App\Models\MemberVideoModel;
use App\Models\VideoCatModel;
use App\Models\VideoCommentModel;
use App\Models\VideoModel;
use App\Services\Modules\Modules;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

/**
* Class is Category controller
* 
* @author UIT_DEV
*/
class CategoriesController extends Controller
{
	/**
	* Get categories index
	*
	* @return view index category page
	*/
	public function getIndex() {
		$categories = CategoriesModel::where('status', '=', 1)
			->orderby('created_at', 'desc')
			->get();

		$recomment_categories = CategoriesModel::where('recomment', '=', 1)
			->where('status', '=', 1)
			->take(12)
			->OrderbyRaw('RAND()')
			->get();

		if($categories) {
			return view('categories.index')
		    	->with('categories', $categories)
				->with('recomment_categories', $recomment_categories)
				->with('all_categories', $this->getAllCategories())
				->with('channel_popular', $this->getChannelPopular())
				->with('country_category', $this->getCountryCategory())
				->with('country', $this->getCountry());
		}
	}

	/**
	* Get all categories
	*
	* @return list categories
	*/
	public function getAllCategories() {
		$recomment_categories = CategoriesModel::where('status', '=', 1)->paginate(20);
		return $recomment_categories;
	}

	/**
	* Get channel popular
	*
	* @return channel popular
	*/
	public function getChannelPopular() {
		$channelpopular = ChannelModel::take(10)->orderBy('total_view','DESC')->OrderbyRaw('RAND()')->get();
	    return $channelpopular;
	}

	/**
	* Get country category
	*
	* @return categories
	*/
	public function getCountryCategory() {
		$country_category = CategoriesModel::select('categories.*','countries.name','countries.id','countries.alpha_2')
			->join('countries', 'countries.id', '=', 'categories.contries_id')
			->OrderbyRaw('RAND()')
			->groupby('countries.id')
			->take(54)
			->get();
		
		return $country_category;
	}

	/**
	* Get country
	*
	* @return list country
	*/
	public function getCountry() {
		$country = CountriesModel::get();
		return $country;
	}

	/**
	* Get Category detail by Id
	*
	* @param category Id
	* @return view category detail
	*/
	public function getCategory($id) {
		$categories = CategoriesModel::where('status', '=', '1')
			->orderby('title_name', 'ASC')
			->get();

		$onecategoriesdetail = CategoriesModel::where('ID', '=', $id)->first();
		$videoin = CategoriesModel::video_cat($id);
		
		if(count($videoin) > 0) {							
		    return view('categories.one_category')
		    	->with('categories', $categories)
				->with('videoin', $videoin)
				->with('channel_popular', $this->getChannelPopular())
				->with('country_category', $this->getCountryCategory())
				->with('onecategoriesdetail', $onecategoriesdetail);
		} else {
			return view('categories.one_category')
				->with('categories', $categories)
				->with('onecategoriesdetail', $onecategoriesdetail)
				->with('channel_popular', $this->getChannelPopular())
				->with('country_category', $this->getCountryCategory());
		}
	}

	/**
	* Get category filter
	*
	* @param category Id
	* @param category name
	* @param action get
	* @param time get
	* @return list video of category filter
	*/
	public function getCategoryFilter($id, $name, $action, $time) {
		switch ($action) {
		case 'new-video':
			return $this->categoryFilterNew($id, $action, $time);
			break;
		case 'most-favorited':
			return $this->categoryFilterFavorited($id, $action, $time);
			break;
		case 'most-rated':
			return $this->categoryFilterRated($id, $action, $time);
			break;
		case 'most-viewed':
			return $this->categoryFilterViewed($id, $action, $time);
			break;
		case 'most-commented':
			return $this->categoryFilterCommented($id, $action, $time);
			break;
		default:
			return $this->getCategory($id);
			break;
		}
	}

	/**
	* Get video of category filter new
	*
	* @param category Id
	* @param action get
	* @param time get
	* @return list video by filter
	*/
	public function categoryFilterNew($id, $action, $time) {
		if ($time == 'all') {
			$fist = 0;
			$end = 7200;
			$time ="";
			$time_name_lg = "All Durations";
			$time_name_xs= "All";
		}
		if ($time== "1-3") {
			$fist = 1;
			$end = 180;
			$time ="1-3";
			$time_name_lg = "Short videos (1-3min)";
			$time_name_xs= "Short(1-3min)";
		}
		if ($time== "3-10") {
			$fist = 181;
			$end = 600;
			$time ="3-10";
			$time_name_lg = "Medium videos (3-10min)";
			$time_name_xs= "Medium(3-10min)";
		}
		if ($time== "10+") {
			$fist = 601;
			$end = 7200;
			$time ="10+";
			$time_name_lg = "Long videos (+10min)";
			$time_name_xs= "Long(+10min)";
		}
		$categories = CategoriesModel::where('status', '=', 1)
			->orderby('title_name','asc')
			->get();

		$onecategoriesdetail = CategoriesModel::where('ID', '=', $id)->first();
		$videoin = CategoriesModel::video_cat_order_new($id,$fist,$end);
		
		if(count($videoin) > 0) {
			return view('categories.one_category')
		    	->with('categories', $categories)
				->with('videoin', $videoin)
				->with('filter_title_lg', 'Newest')
				->with('filter_title_xs', 'Newest')
				->with('filter_time_lg', $time_name_lg)
				->with('filter_time_xs', $time_name_xs)
				->with('channel_popular', $this->getChannelPopular())
				->with('country_category', $this->getCountryCategory())
				->with('onecategoriesdetail', $onecategoriesdetail);
		} else {
			 return view('categories.one_category')
			 	->with('categories', $categories)
				->with('onecategoriesdetail', $onecategoriesdetail)
				->with('channel_popular', $this->getChannelPopular())
	   			->with('filter_title_lg', 'Newest')
			    ->with('filter_title_xs', 'Newest')
			    ->with('filter_time_lg', $time_name_lg)
			    ->with('filter_time_xs', $time_name_xs)
	   			->with('country_category', $this->getCountryCategory());
		}
	}

	/**
	* Get video of category filter by most favorited
	* 
	* @param cateogry Id
	* @param action get
	* @param time get
	* @return list video by filter
	*/
	public function categoryFilterFavorited($id, $action, $time) {
		if ($time == 'all') {
			$fist = 0;
			$end = 7200;
			$time ="";
			$time_name_lg = "All Durations";
			$time_name_xs= "All";
		}
		if ($time== "1-3") {
			$fist = 1;
			$end = 180;
			$time ="1-3";
			$time_name_lg = "Short videos (1-3min)";
			$time_name_xs= "Short(1-3min)";
		}
		if ($time== "3-10") {
			$fist = 181;
			$end = 600;
			$time ="3-10";
			$time_name_lg = "Medium videos (3-10min)";
			$time_name_xs= "Medium(3-10min)";
		}
		if ($time== "10+") {
			$fist = 601;
			$end = 7200;
			$time ="10+";
			$time_name_lg = "Long videos (+10min)";
			$time_name_xs= "Long(+10min)";
		}
		$categories = CategoriesModel::where('status', '=', 1)
			->orderby('title_name', 'ASC')
			->get();

		$onecategoriesdetail = CategoriesModel::where('ID', '=', $id)->first();
		
		$get_favorite = MemberVideoModel::get();
        $list_temp = array();
        for($i = 0; $i < count($get_favorite); $i++) { 
            if(!in_array($get_favorite[$i]->video_Id, $list_temp)) {
                array_push($list_temp,$get_favorite[$i]->video_Id);
            }
        }
        $new_array = implode(',', $list_temp);
        $array = explode(',', $new_array);
        $listvideo_temp = array_unique($array);
        $new_list = implode(',', $listvideo_temp);

        $video_id = array();
        $get_video_id = VideoCatModel::where('cat_id', '=', $id)->get();
	    for($i = 0; $i < count($get_video_id); $i++) { 
	        array_push($video_id, $get_video_id[$i]->video_id);
	    }
      		
		$videoin = VideoModel::where('status', '=', 1)
			->whereRaw("duration BETWEEN ".$fist." and ".$end."")
			->whereIn('string_Id',$video_id)
			->whereIn('string_Id',$listvideo_temp)
			->paginate(20);
		
		if(count($videoin) > 0) {							
		    return view('categories.one_category')
		    	->with('categories', $categories)
				->with('videoin', $videoin)
				->with('channel_popular', $this->getChannelPopular())
				->with('country_category', $this->getCountryCategory())
				->with('filter_title_lg', 'Most favorited videos')
				->with('filter_title_xs', 'Favorited')
				->with('filter_time_lg', $time_name_lg)
				->with('filter_time_xs', $time_name_xs)
				->with('onecategoriesdetail', $onecategoriesdetail)
				->with('hidden_action', $action);
		} else {
			 return view('categories.one_category')
			 	->with('categories', $categories)
				->with('onecategoriesdetail', $onecategoriesdetail)
				->with('channel_popular', $this->getChannelPopular())
	   			->with('filter_title_lg', 'Most favorited videos')
	   			->with('filter_title_xs', 'Favorited')
	   			->with('filter_time_lg', $time_name_lg)
	            ->with('filter_time_xs', $time_name_xs)
	   			->with('country_category', $this->getCountryCategory())
	   			->with('hidden_action', $action);
		}
	}

	/**
	* Get video of category filter by top rated
	*
	* @param category Id
	* @param action get
	* @param time get
	* @return list video by filter
	*/
	public function categoryFilterRated($id,$action,$time){
		if ($time == 'all') {
			$fist = 0;
			$end = 7200;
			$time ="";
			$time_name_lg = "All Durations";
			$time_name_xs= "All";
		}
		if ($time== "1-3") {
			$fist = 1;
			$end = 180;
			$time ="1-3";
			$time_name_lg = "Short videos (1-3min)";
			$time_name_xs= "Short(1-3min)";
		}
		if ($time== "3-10") {
			$fist = 181;
			$end = 600;
			$time ="3-10";
			$time_name_lg = "Medium videos (3-10min)";
			$time_name_xs= "Medium(3-10min)";
		}
		if ($time== "10+") {
			$fist = 601;
			$end = 7200;
			$time ="10+";
			$time_name_lg = "Long videos (+10min)";
			$time_name_xs= "Long(+10min)";
		}
		$categories = CategoriesModel::where('status', '=', 1)
			->orderby('title_name','ASC')
			->get();

		$onecategoriesdetail = CategoriesModel::where('ID', '=', $id)->first();
		$videoin = CategoriesModel::video_cat_order_rate($id, $fist, $end);
		if(count($videoin) > 0) {
			return view('categories.one_category')
				->with('categories', $categories)
				->with('videoin', $videoin)
				->with('channel_popular', $this->getChannelPopular())
				->with('country_category', $this->getCountryCategory())
				->with('filter_title_lg', 'Top rated videos')
				->with('filter_title_xs', 'Rated')
				->with('filter_time_lg', $time_name_lg)
				->with('filter_time_xs', $time_name_xs)
				->with('hidden_action', $action)
				->with('onecategoriesdetail', $onecategoriesdetail);
		} else {
			return view('categories.one_category')
				->with('categories', $categories)
				->with('onecategoriesdetail', $onecategoriesdetail)
				->with('channel_popular', $this->getChannelPopular())
				->with('filter_title_lg', 'Top rated videos')
	   			->with('filter_title_xs', 'Rated')
	   			->with('filter_time_lg', $time_name_lg)
	            ->with('filter_time_xs', $time_name_xs)
	   			->with('hidden_action', $action)
	   			->with('country_category',$this->getCountryCategory());
		}
	}

	/**
	* Get video of category filter by most viewed
	*
	* @param category Id
	* @param action get
	* @param time get
	* @return list video by filter
	*/
	public function categoryFilterViewed($id, $action, $time) {
		if ($time == 'all') {
			$fist = 0;
			$end = 7200;
			$time ="";
			$time_name_lg = "All Durations";
			$time_name_xs= "All";
		}
		if ($time== "1-3") {
			$fist = 1;
			$end = 180;
			$time ="1-3";
			$time_name_lg = "Short videos (1-3min)";
			$time_name_xs= "Short(1-3min)";
		}
		if ($time== "3-10") {
			$fist = 181;
			$end = 600;
			$time ="3-10";
			$time_name_lg = "Medium videos (3-10min)";
			$time_name_xs= "Medium(3-10min)";
		}
		if ($time== "10+") {
			$fist = 601;
			$end = 7200;
			$time ="10+";
			$time_name_lg = "Long videos (+10min)";
			$time_name_xs= "Long(+10min)";
		}
		$categories = CategoriesModel::where('status', '=', 1)
			->orderby('title_name','ASC')
			->get();

		$onecategoriesdetail = CategoriesModel::where('ID', '=', $id)->first();

        $videoList = VideoModel::where('status', '=', 1)->get();
		$cat_video_id = get_cat_video_id($id, $videoList);
		$videoin = CategoriesModel::video_cat_order_viewed($id, $fist, $end);
		
		if(count($videoin) > 0) {
			return view('categories.one_category')
				->with('categories', $categories)
				->with('videoin', $videoin)
				->with('channel_popular', $this->getChannelPopular())
				->with('filter_title_lg', 'Most Viewed videos')
				->with('filter_title_xs', 'Viewed')
				->with('filter_time_lg', $time_name_lg)
				->with('filter_time_xs', $time_name_xs)
				->with('hidden_action', $action)
				->with('country_category', $this->getCountryCategory())
				->with('onecategoriesdetail', $onecategoriesdetail);
		} else {
			 return view('categories.one_category')
			 	->with('categories', $categories)
				->with('onecategoriesdetail', $onecategoriesdetail)
				->with('channel_popular', $this->getChannelPopular())
				->with('filter_title_lg', 'Most Viewed videos')
	   			->with('filter_title_xs', 'Viewed')
	   			->with('filter_time_lg', $time_name_lg)
	            ->with('filter_time_xs', $time_name_xs)
	   			->with('hidden_action', $action)
	   			->with('country_category', $this->getCountryCategory());
		}
	}

	/**
	* Get video of category filter by most commented
	*
	* @param category Id
	* @param action get
	* @param time get
	* @return list video by filter
	*/
	public function categoryFilterCommented($id, $action, $time) {
		if ($time == 'all') {
			$fist = 0;
			$end = 7200;
			$time ="";
			$time_name_lg = "All Durations";
			$time_name_xs= "All";
		}
		if ($time== "1-3") {
			$fist = 1;
			$end = 180;
			$time ="1-3";
			$time_name_lg = "Short videos (1-3min)";
			$time_name_xs= "Short(1-3min)";
		}
		if ($time== "3-10") {
			$fist = 181;
			$end = 600;
			$time ="3-10";
			$time_name_lg = "Medium videos (3-10min)";
			$time_name_xs= "Medium(3-10min)";
		}
		if ($time== "10+") {
			$fist = 601;
			$end = 7200;
			$time ="10+";
			$time_name_lg = "Long videos (+10min)";
			$time_name_xs= "Long(+10min)";
		}
		$categories = CategoriesModel::where('status', '=', 1)
			->orderby('title_name','ASC')
			->get();

		$onecategoriesdetail = CategoriesModel::where('ID', '=', $id)->first();

        $get_comment= VideoCommentModel::Groupby('video_Id')->get();
        $list_comment_array= array();
        for($i = 0; $i < count($get_comment); $i++) { 
            array_push($list_comment_array, $get_comment[$i]->video_Id);
        }
        
        $video_id = array();
        $get_video_id = VideoCatModel::where('cat_id', '=', $id)->get();
	    for($i = 0; $i < count($get_video_id); $i++) { 
	        array_push($video_id, $get_video_id[$i]->video_id);
	    }
		$videoin = VideoModel::where('status', '=', 1)
			->whereRaw("duration BETWEEN ".$fist." and ".$end."")
			->whereIn('string_Id', $video_id)
			->whereIn('string_Id', $list_comment_array)
			->Orderby('title_name', 'DESC')
			->paginate(20);

		if(count($videoin) > 0) {
			return view('categories.one_category')
				->with('categories', $categories)
				->with('videoin', $videoin)
				->with('channel_popular', $this->getChannelPopular())
				->with('filter_title_lg', 'Most commented videos')
				->with('filter_title_xs', 'Commented')
				->with('filter_time_lg', $time_name_lg)
				->with('filter_time_xs', $time_name_xs)
				->with('hidden_action', $action)
				->with('country_category', $this->getCountryCategory())
				->with('onecategoriesdetail', $onecategoriesdetail);
		} else {
			return view('categories.one_category')
				->with('categories', $categories)
				->with('onecategoriesdetail', $onecategoriesdetail)
				->with('channel_popular', $this->getChannelPopular())
				->with('filter_title_lg', 'Most commented video')
	   			->with('filter_title_xs', 'Commented')
	   			->with('filter_time_lg', $time_name_lg)
	            ->with('filter_time_xs', $time_name_xs)
	   			->with('hidden_action', $action)
	   			->with('country_category', $this->getCountryCategory());
		}
	}
}