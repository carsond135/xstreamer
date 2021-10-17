<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\VideoModel;
use App\Models\VideoCatModel;
use Illuminate\Support\Facades\Session;

class CategoriesModel extends Model  {

	protected $table="categories";
	
	public static function video_cat($id){
		$video_id=array();
		$get_video_id= \App\Models\VideoCatModel::where('cat_id','=',$id)->get();
	    for ($i=0; $i <count($get_video_id) ; $i++) { 
	        array_push($video_id,$get_video_id[$i]->video_id);
	    }
	    $video_array=\App\Models\VideoModel::where('status','=',1)
	                                        ->whereIn('string_Id',$video_id)
	                                        ->paginate(20);
	    return $video_array;
	}

	public static function video_cat_order_rate($id,$fist,$end){
		$video_id=array();
		$get_video_id= \App\Models\VideoCatModel::where('cat_id','=',$id)->get();
	    for ($i=0; $i <count($get_video_id) ; $i++) { 
	        array_push($video_id,$get_video_id[$i]->video_id);
	    }
	    $video_array=\App\Models\VideoModel::where('status','=',1)
	    									->whereRaw("duration BETWEEN ".$fist." and ".$end."")
	                                        ->whereIn('string_Id',$video_id)
	                                        ->orderby('rating','DESC')
	                                        ->paginate(20);
	    return $video_array;
	}
	public static function video_cat_order_new($id,$fist,$end){
		$video_id=array();
		$get_video_id= \App\Models\VideoCatModel::where('cat_id','=',$id)->get();
	    for ($i=0; $i <count($get_video_id) ; $i++) { 
	        array_push($video_id,$get_video_id[$i]->video_id);
	    }
	    $video_array=\App\Models\VideoModel::where('status','=',1)
	    									->whereRaw("duration BETWEEN ".$fist." and ".$end."")
	                                        ->whereIn('string_Id',$video_id)
	                                        ->paginate(20);
	    return $video_array;
	}
	public static function video_cat_order_viewed($id,$fist,$end){
		$video_id=array();
		$get_video_id= \App\Models\VideoCatModel::where('cat_id','=',$id)->get();
	    for ($i=0; $i <count($get_video_id) ; $i++) { 
	        array_push($video_id,$get_video_id[$i]->video_id);
	    }
	    $video_array=\App\Models\VideoModel::where('status','=',1)
	    									->whereRaw("duration BETWEEN ".$fist." and ".$end."")
	                                        ->whereIn('string_Id',$video_id)
	                                        ->orderby('total_view','DESC')
	                                        ->paginate(20);
	    return $video_array;
	}

	public static function getImageUrl($poster)
	{
		if (!empty($poster) && file_exists($_SERVER['DOCUMENT_ROOT'].GetPath().'/public/upload/categories/' .$poster)==true) {
			$image =  URL('public/upload/categories')."/".$poster;

		}else{
			$image = URL('public/assets/images/no-image.jpg');
		}
		return $image;
	}
}
