<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StandardAdsModel extends Model  {

	protected $table="standard_ads";
	
	public static function get_standard_home(){
		$get_ads= StandardAdsModel::where('position','=','home')->take(1)->orderByRaw("RAND()")->first();
		if($get_ads!=NULL){
			if($get_ads->type=="upload"){
				$html="<a target='_new' href='".$get_ads->return_url."' title='".$get_ads->ads_title."'><img src='".$get_ads->ads_content."' style='max-height:269px'/></a>";
				return $html;
			}
			if($get_ads->type=="script_code"){
				$html='<div id="AD_ID" align="center">'.$get_ads->script_code.'</div>';
				return $html;
			}
		}else{
			$html="<a target='_new' href='#' title=''><img src='".URL('public/assets/images/ads-here.jpg')."' /></a>";
			return $html;
		}
	}

	public static function get_standard_footer(){
		$get_ads= StandardAdsModel::where('position','=','footer')->take(2)->orderByRaw("RAND()")->get();
		if(count($get_ads)>0){
				foreach ($get_ads as $result) {
					if($result->type=="upload"){
						$html="<div align='center' class='col-sm-6 '><a target='_new' href='".$result->return_url."' title='".$result->ads_title."'><img src='".$result->ads_content."' style='max-height:250px ;height: 250px;max-width: 300px !important;width: 300px; margin-bottom:15px;'/></a></div>";
						echo $html;
					}
					if($result->ads_type=="swf"){
						$html='<div class="col-sm-6"><embed style="max-height:132px" name="plugin" src="'.$_SERVER["DOCUMENT_ROOT"].'/adult/public/upload/ads/2OqU7KITyR.swf" type="application/x-shockwave-flash"></div>';
						echo $html;
					}
					if($result->type=="script_code"){
						$html='<div class="col-sm-6"><div id="AD_ID" align="center" style="max-height:250px">'.$result->script_code.'</div></div>';
						echo $html;
					}
				}


		}else{
			$html="<div align='center' class='col-sm-6'><a target='_new' href='#' title=''><img src='".URL('public/assets/images/image-ad.jpg')."' /></a></div><div align='center' class='col-sm-6'><a target='_new' href='#' title=''><img src='".URL('public/assets/images/image-ad.jpg')."' /></a></div>";
			
			return $html;
		}
	}

	public static function get_standard_toprate(){
		$get_ads= StandardAdsModel::where('position','=','toprate')->take(1)->orderByRaw("RAND()")->first();
		if($get_ads!=NULL){
				if($get_ads->type=="upload"){
					$html="<a target='_new' href='".$get_ads->return_url."' title='".$get_ads->ads_title."'><img src='".$get_ads->ads_content."' style='max-height:269px'/></a>";
					return $html;
				}
				if($get_ads->type=="script_code"){
					$html='<div id="AD_ID">'.$get_ads->script_code.'</div>';
					return $html;
				}
				if($get_ads->ads_type=="swf"){
					$html='<embed style="max-height:269px" name="plugin" src="'.$_SERVER["DOCUMENT_ROOT"].'/adult/public/upload/ads/2OqU7KITyR.swf" type="application/x-shockwave-flash">';
					return $html;
				}
		}else{
			$html="<a target='_new' href='#' title=''><img src='".URL('public/assets/images/ads-here.jpg')."' /></a>";
			return $html;
		}
				
	}

	public static function get_standard_mostview(){
		$get_ads= StandardAdsModel::where('position','=','mostview')->take(1)->orderByRaw("RAND()")->first();
		if($get_ads!=NULL){
				if($get_ads->type=="upload"){
					$html="<a target='_new' href='".$get_ads->return_url."' title='".$get_ads->ads_title."'><img src='".$get_ads->ads_content."' style='max-height:269px'/></a>";
					return $html;
				}
				if($get_ads->type=="script_code"){
					$html='<div id="AD_ID">'.$get_ads->script_code.'</div>';
					return $html;
				}
				if($get_ads->ads_type=="png"){
					$html="<a target='_new' href='".$get_ads->return_url."' title='".$get_ads->ads_title."'><img src='".$get_ads->ads_content."' style='max-height:269px'/></a>";
					return $html;
				}
				
				if($get_ads->ads_type=="swf"){
					$html='<embed style="max-height:269px" name="plugin" src="'.$_SERVER["DOCUMENT_ROOT"].'/adult/public/upload/ads/2OqU7KITyR.swf" type="application/x-shockwave-flash">';
					return $html;
				}
		}else{
			$html="<a target='_new' href='#' title=''><img src='".URL('public/assets/images/ads-here.jpg')."' /></a>";
			return $html;
		}
	}

	public static function get_standard_pornstar(){
		$get_ads= StandardAdsModel::where('position','=','pornstar')->take(1)->orderByRaw("RAND()")->first();
		if($get_ads!=NULL){	
			if($get_ads->type=="upload"){
				$html="<a target='_new' href='".$get_ads->return_url."' title='".$get_ads->ads_title."'><img src='".$get_ads->ads_content."' style='max-height:269px'/></a>";
				return $html;
			}
			if($get_ads->type=="script_code"){
				$html='<div id="AD_ID">'.$get_ads->script_code.'</div>';
				return $html;
			}
			if($get_ads->ads_type=="swf"){
				$html="<a target='_new' href='".$get_ads->return_url."' title='".$get_ads->ads_title."'><img src='".$get_ads->ads_content."' style='max-height:269px'/></a>";
				return $html;
			}
		}else{
			$html="<a target='_new' href='#' title=''><img src='".URL('public/assets/images/ads-here.jpg')."' /></a>";
			return $html;
		}
	}

	public static function get_standard_video(){
		$get_ads= StandardAdsModel::where('position','=','video')->take(1)->orderByRaw("RAND()")->first();
		if($get_ads!=NULL){	
			if($get_ads->type=="upload"){
				$html="<a target='_new' href='".$get_ads->return_url."' title='".$get_ads->ads_title."'><img src='".$get_ads->ads_content."' style='max-height:393x'/></a>";
				return $html;
			}
			if($get_ads->type=="script_code"){
				$html='<div id="AD_ID">'.$get_ads->script_code.'</div>';
				return $html;
			}
			
			if($get_ads->ads_type=="swf"){
				$html='<embed style="max-height:393px" name="plugin" src="'.URL('adult/public/upload/ads/'.$get_ads->ads_content.'').'" type="application/x-shockwave-flash">';
				return $html;
			}
		}else{
			$html="<a target='_new' href='#' title=''><img src='".URL('public/assets/images/ads-here.jpg')."' /></a>";
			return $html;
		}
	}
}
