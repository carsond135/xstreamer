<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HeaderModel extends Model  {

	protected $table="header_link";

	public static function get_list_link(){
		$list= HeaderModel::where('status','=',1)->get();
		$html="";
		$html.='<div class="ticker-container hidden-xs hidden-sm"><ul>';
        foreach ($list as $result) {
			$html.='<div><li><span>'.$result->title_name.':</span> '.$result->content.' Scene&ndash; <a href="'.$result->link.'">Click here</a></li></div>';
		}        
        $html.='</ul></div>';
        return $html;
		
	}
}
