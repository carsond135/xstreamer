<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\VideoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChannelModel extends Model  {

	protected $table="channel";
	public static function getImageUrl($poster)
	{
		if (!empty($poster)) {
			$image =  URL('public/upload/channel')."/".$poster;

		}else{
			$image = URL('public/assets/images/no-image.jpg');
		}
		return $image;
	}
}
