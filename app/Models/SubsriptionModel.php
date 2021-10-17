<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubsriptionModel extends Model  {

	protected $table="subscription";
	public static function check_user_buy_video($user_id, $string_Id)
	{
		$check = SubsriptionModel::where('user_id','=',$user_id)->where('video_id','=',$string_Id)->get();
		if (count($check)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
