<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OptionModel extends Model  {

	protected $table="config";
	public static function get_config(){
		$config=OptionModel::first();
		return $config;
	}
}
