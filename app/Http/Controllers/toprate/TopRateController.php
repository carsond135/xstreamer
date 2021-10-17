<?php

namespace App\Http\Controllers\toprate;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogModel;
use App\Models\CategoriesModel;
use App\Models\ChannelModel;
use App\Models\ChanneSubscriberModel;
use App\Models\CountriesModel;
use App\Models\RatingModel;
use App\Models\VideoModel;
use App\Services\Modules\Modules;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

/**
* Class is Top rate controller
*
* @author UIT_DEV
*/
class TopRateController extends Controller
{
	/**
	* Get view index of top rate controller
	* 
	* @return view top rate video
	*/
	public function getIndex() {
	    $toprate = VideoModel::where('status', '=', 1)
	    	->orderBy('rating','DESC')
	    	->paginate(20);

		$categories = CategoriesModel::where('status', '=', 1)
			->orderby('title_name','asc')
			->get();

		$countries = CountriesModel::select('countries.*')
	        ->join('categories', 'countries.id', '=', 'categories.contries_id')
	        ->join('video', 'video.categories_Id', '=', 'categories.ID')
	        ->groupBy('countries.id')
	        ->get();

		if($categories) {
			return view('toprate.index')
			->with('categories', $categories)
			->with('countries', $countries)
			->with('toprate', $toprate);
		}
	}

	/**
	* Get video top rate by filter
	*
	* @param date get
	* @param time get
	* @return list video by filter
	*/
	public function getTopRateFilter($date, $time) {
		if(\Request::ajax()) {
			$compare = "=";

			if ($time == 'all') {
				$fist = 0;
				$end = 7200;
				$time ="";
				$time_name = "All Durations";
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
					$toprate = VideoModel::whereRaw("updated_at BETWEEN '".get_object_vars($lastweek)['date']."' and '".get_object_vars($thisweek)['date']."'  and duration BETWEEN ".$fist." and ".$end."")
                        ->orderby('rating', 'DESC')
                        ->paginate(20);
	            }
	            if($date == "month") {
	            	$toprate = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
            			->where(DB::raw('MONTH(updated_at)'), '=', date('n'))
                        ->orderby('rating', 'DESC')
                        ->paginate(20);
	            }
	            if($date == "all") {
	            	$toprate = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
		            	->where('status', '=', 1)
		            	->orderby('rating', 'DESC')
		            	->paginate(20);
	            }
	         } else {
	            $toprate = VideoModel::select('video.*','rating.like','rating.dislike','rating.string_id as video_id','rating.created_at as rated_at')
        			->whereBetween('video.duration', array($fist,$end))
        			->where('rating.created_at', 'like', ''.date('Y-m-d').'%' )
        			->join('rating', 'rating.string_id', '=', 'video.string_Id')
                    ->orderby('video.rating', 'DESC')
                    ->groupBy('rating.ID')
                    ->paginate(20);
	        }
	        
			if($toprate) {
				return view('toprate.filter')
					->with('toprate', $toprate)
					->with('date', $date)
					->with('time', $time_name)
					->with('data_time', $time);
			}
		} else {
			return redirect('most-view.html');
		}
	}
}