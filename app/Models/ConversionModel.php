<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConversionModel extends Model  {

	protected $table="conversion_config";
	public static function get_config(){
		$conversion_config=ConversionModel::first();
		return $conversion_config;
	}
}
