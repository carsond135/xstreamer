<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaticPageModel extends Model  {

	protected $table="static_page";

	public static function show_link($id){
		$checkid=StaticPageModel::find($id);
		if($checkid!=NULL){
			if($checkid->status==1){
				$html='<a href="'.URL("static/")."/".$id.'">'.$checkid->titlename.'</a>';
				return $html;
			}
		}else{
			return redirect('')->with('msg',' Page not found !');
		}
	}
	
}
