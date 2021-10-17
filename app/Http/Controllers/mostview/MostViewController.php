<?php

namespace App\Http\Controllers\mostview;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogModel;
use App\Models\CategoriesModel;
use App\Models\ChannelModel;
use App\Models\ChanneSubscriberModel;
use App\Models\CountriesModel;
use App\Models\VideoModel;
use App\Services\Modules\Modules;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

/**
* Class is Most view controller
* 
* @author UIT_DEV
*/
class MostViewController extends Controller
{
	/**
	* Get view index of Most viewed videos
	*
	* @return view index
	*/
	public function getIndex() {
	    $mostview = VideoModel::where('status', '=', 1)
	    	->orderBy('total_view', 'DESC')
	    	->paginate(20);

	    $countries = CountriesModel::select('countries.*')
            ->join('categories', 'countries.id', '=', 'categories.contries_id')
            ->join('video', 'video.categories_Id', '=', 'categories.ID')
            ->groupBy('countries.id')
            ->get();

		$categories = CategoriesModel::where('status', '=', 1)
			->orderby('title_name','ASC')
			->get();

		if($categories) {
			return view('mostview.index')
			->with('categories', $categories)
			->with('mostview', $mostview)
			->with('countries', $countries);
		}
	}

	/**
	* Get list video Most viewed by filter
	*
	* @param date get
	* @param time get
	* @return list video by filter
	*/
	public function getVideoMostViewedFilter($date, $time) {
		if(\Request::ajax()) {
			$compare = "=";
			
			if ($time == 'all') {
				$fist = 0;
				$end = 7200;
				$time = "";
				$time_name = "All Time";
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
				$end = "100:00";
				$time = "10+";
				$time_name = "videos (10+min)";
			}
			if($date != "today") {
				if($date =="week") {
					$lastweek = date_create('Sunday last week');
	                $thisweek = date_create('Sunday this week');
					$mostview = VideoModel::whereRaw("updated_at BETWEEN '".get_object_vars($lastweek)['date']."' and '".get_object_vars($thisweek)['date']."'  and duration BETWEEN ".$fist." and ".$end."")
                        ->orderBy('total_view', 'DESC')
                        ->where('status', '=', 1)
                        ->paginate(20);
	            }
	            if($date == "month") {
	            	$mostview = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
            			->where(DB::raw('MONTH(updated_at)'), '=', date('n'))
            			->where('status', '=', 1)
                        ->orderBy('total_view', 'DESC')
                        ->paginate(20);
	            }
	            if($date == "all") {
	            	$mostview = VideoModel::whereRaw("duration BETWEEN ".$fist." and ".$end."")
		            	->where('status', '=', 1)
		            	->orderBy('total_view', 'DESC')
		            	->paginate(20);
	            }
	        } else {
	            $mostview = VideoModel::whereBetween('duration', array($fist, $end))
        			->where('updated_at', 'like', ''.date('Y-m-d').'%')
                    ->orderby('total_view', 'DESC')
                    ->groupBy('ID')
                    ->paginate(20);
	        }
			if($mostview) {
				return view('mostview.filter')
					->with('mostview', $mostview)
					->with('date', $date)
					->with('time', $time_name)
					->with('data_time', $time);
			}
		} else {
			return redirect('top-rate.html');
		}
	}
}