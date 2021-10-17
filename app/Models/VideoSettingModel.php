<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VideoSettingModel extends Model  {

	protected $table="video_setting";
	public static function get_config(){
		$config=VideoSettingModel::first();
		return $config;
	}
}
