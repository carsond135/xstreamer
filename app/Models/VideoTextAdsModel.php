<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VideoTextAdsModel extends Model  {

	protected $table="video_ads_text";

	public static function get_list(){
		$list=VideoTextAdsModel::where('status','=',1)->get();	
		$html="";
		// $html.='<script src="URL("public/assets/js/jquery.bootstrap.newsbox.js")"></script>';
		$html.='<div class="col-md-12 hidden-xs">';
		$html.='<div class="panel panel-default box-text-ads">';
		$html.='<div class="panel-heading">';
		// $html.='';
		// $html.='<b>Advertisements</b>';
		$html.='</div>';
		$html.='<div class="panel-body">';
		$html.='<div class="row"><div class="col-xs-12"><ul class="demo1">';
        foreach ($list as $result) {
			
   				$html.='<li class="news-item "><table cellpadding="4">';
                $html.='<tr>';
                $html.='<td class="title_ads">'.$result->ads_title.'</td>';
                $html.='</tr>';
                $html.='<tr>';
                $html.='<td>'.$result->ads_content.'<a href="'.$result->return_url.'">'.$result->return_url.'</a></td></tr>';
                $html.='</table>';
            	$html.='</li>';
		} 
		$html.='</ul> </div></div></div></div></div>';      

        return $html;
	}
	
}
