<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MemberModel extends Model  {


  const ROLE_SUPERADMIN = 4;
  const ROLE_ADMIN_SITE = 3;
  const ROLE_EMPLOYEE_SITE = 2;
  const ROLE_ADMIN = 1;
  const ROLE_EMPLOYEE = 0;
  protected $table = "members";

  public static function checkUserName($username, $id = null) {
    if(!$id){
      $count = self::where('username', '=', $username)->get()->count();
    }else{
      $count = self::where('username', '=', $username)->where('id', '<>', $id)->get()->count();
    }
    return $count == 1;
  }
  public static function getUserOnline($user){
  	if($user->roles==1){
  		return self::select('firstname')
  			->where('company_id','=',$user->id)
  			->where('signin','=',1)
  			->orwhere('id',$user->id)
  			->get();
  	}else{
  		return self::select('firstname')
  			->where('company_id','=',$user->company_id)
  			->where('signin','=',1)
  			->orwhere('id',$user->company_id)
  			->get();
  	}

  }
  public static function setUserOnline($email){
  	return self::where('email','=',$email)->update(['signin'=>1]);
  }
  public static function setUserOffOnline($email){
  	$offline= self::where('email','=',$email)->update(['signin'=>0]);
  	if($offline){
		\Session::forget("User");
		return true;
  	}
  	return false;
  }
  public static function CheckImageURL($poster){

      if (!empty($poster) && file_exists($_SERVER['DOCUMENT_ROOT'] .'/lite/public/upload/member/' .$poster)==true) {
      $image =  URL('public/upload/member')."/".$poster;

      }else{
        $image = URL('public/upload/member/no_member.png');
      }
      return $image;

  }


}
