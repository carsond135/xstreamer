<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VideoModel extends Model {

    protected $table = "video";
    Protected $primaryKey = "ID" ;
    // public $timestamps = false;
    public function nestedComments() {

        return $this->hasMany('VideoComment')->where('comment_parent', 0);
    }

    public static function getImageUrl($poster)
	{
		if (!empty($poster)) {
			$image = $poster;
		}else{
			$image = URL('public/assets/images/no-image.jpg');
		}
		return $image;
	}

}
