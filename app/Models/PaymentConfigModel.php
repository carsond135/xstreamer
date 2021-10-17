<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentConfigModel extends Model  {

	protected $table="paymentconfig";
	public static function get_payment_config(){
		$config=PaymentConfigModel::first();
		return $config;
	}
	public function update_config($id,$data){
		$update_config= PaymentConfigModel::where('id','=',$id)->update($data);
	}
}
