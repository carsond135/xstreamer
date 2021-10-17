<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VideoAdsModel extends Model  {

	protected $table="video_ads";

	public static function get_ads_video(){
		$get_server_ads= VideoAdsModel::orderByRaw("RAND()")->first();
		return $get_server_ads;
	}
	
	
}
