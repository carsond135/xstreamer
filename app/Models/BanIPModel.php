<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BanIPModel extends Model  {

	protected $table="ipban";

	public static function get_list_ban(){
		$getlist= BanIPModel::get();
		$ip_list=array();
		if(count($getlist)>0){

			for ($i=0; $i <count($getlist) ; $i++) { 
				array_push($ip_list,$getlist[$i]->ip_ban);
			}
			//check banip
			
			if(in_array(BanIPModel::getRealIpAddr(),$ip_list)){
				// $url_return ="<script> location.href = 'http://google.com';</script>";
				// return $url_return;
				return redirect('503');
			}else{
				return "";
			}
		}else{
			echo "";
		}
	}

	public static function getRealIpAddr()
	{
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}
}
