<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VideoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PornStarModel extends Model  {

	protected $table="pornstar";

	public static function getVideoByPornStarId($id)
	{
		$video = VideoModel::where('pornstar_Id','=',"$id")->count();
		if($video==1 or $video==0){
			return $video." Video";
		}else{
			return $video." Videos";
		}
	}
	public static function CountPornStarVideo($id)
	{
		$video = VideoModel::where('pornstar_Id','=',"$id")->count();
		if(!empty($video)){
			return $video;
		}else{
			return 0;
		}
	}
	public static function check_thumb($id){
		$get_thumb=PornStarModel::find($id);
		$thumb="";
		if($get_thumb!=NULL){
			if($get_thumb->poster==NULL or file_exists($_SERVER['DOCUMENT_ROOT'].GetPath().'/public/upload/pornstar/'.$get_thumb->poster.'')==false){
				$thumb=URL('public/assets/images/no-image.jpg');
				return $thumb;
			}else{
				$thumb=URL('public/upload/pornstar')."/".$get_thumb->poster;
				return $thumb;
			}
		}else{
			return redirect('pornstar.html')->with('msg','Request not found !');
		}

	}
	public static function check_wall($id){
		$get_thumb=PornStarModel::find($id);
		$thumb="";
		if($get_thumb!=NULL){
			if($get_thumb->wall_poster==NULL or file_exists($_SERVER['DOCUMENT_ROOT'].'/public/upload/pornstar/'.$get_thumb->wall_poster.'')==false){
				$thumb=URL('public/upload/pornstar/Pornstar_Wall_Poster_Amateur.jpg');
				return $thumb;
			}else{
				$thumb=URL('public/upload/pornstar')."/".$get_thumb->wall_poster;
				return $thumb;
			}
		}else{
			return redirect('pornstar.html')->with('msg','Request not found !');
		}

	}
	public static function get_total_video_view($id){
		$video_sum_view= VideoModel::where('pornstar_Id','=',$id)->get()->sum('total_view');
		//var_dump($video_sum_view);die;
		if($video_sum_view>0){
			return $video_sum_view;
		}else{
			return 0;
		}

	}
}
