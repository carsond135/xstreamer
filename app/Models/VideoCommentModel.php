<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VideoCommentModel extends Model {

    protected $table = "video_comment";

    public function replies() {

        return $this->hasMany('App\Models\VideoCommentModel', 'comment_parent', 'ID');
    }

    public function author() {
        return $this->belongsTo('App\Models\MemberModel', 'member_Id', 'user_id');
    }

}
