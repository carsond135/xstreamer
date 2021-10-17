<?php
use App\Services\Languages\LanguageService as Languages;
use App\Http\Controllers\KeyHitech;
use App\Models\CategoriesModel;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// User Routers
# Home
Route::get('/', 'home\HomeController@getIndex');

Route::get('/views', 'home\HomeController@getOrderViews');

Route::get('/rating', 'home\HomeController@getOrderRating');

Route::get('/duration', 'home\HomeController@getOrderDuration');

Route::get('/date', 'home\HomeController@getOrderDate');

Route::post('/login.html', 'login\LoginController@signIn');

Route::get('/login.html', 'login\LoginController@getLogin');

Route::get('/logout.html', 'login\LoginController@logout');

Route::post('/signup.html', 'login\LoginController@signUp');

Route::get('/register.html&action=active&token={token}', 'login\LoginController@getConfrimActive');

Route::post('/forgot-password.html', 'login\LoginController@postMailForgot'); 

# Video
Route::get('/video.html&action={action}&catid={catid}', 'video\VideoController@getVideoByAction');

Route::get('/video.html&action={action}&date={date}&time={time}', 'video\VideoController@getActionFilter');

Route::get('/video.html&action={action}', 'video\VideoController@getVideoByAction');

Route::get('/watch/{string_Id}/{name}.html', 'video\VideoController@getIndex');

Route::get('/search.html&keyword={keyword}&sort={sort}&date={date}&duration={time}', 'video\VideoController@getSearchFilter');

Route::get('/search.html', 'video\VideoController@getSearchVideo');

# Categories
Route::get('/categories.html', 'categories\CategoriesController@getIndex');

Route::get('/categories/{id}.{name}.html', 'categories\CategoriesController@getCategory'); 

Route::get('categories/{id}.{name}.html&sort={action}&time={time}', 'categories\CategoriesController@getCategoryFilter');

# Top rated
Route::get('/top-rate.html&date={date}&time={time}', 'toprate\TopRateController@getTopRateFilter'); 

Route::get('/top-rate.html', 'toprate\TopRateController@getIndex'); 

# Most viewed
Route::get('/most-view.html&date={date}&time={time}', 'mostview\MostViewController@getVideoMostViewedFilter'); 

Route::get('/most-view.html', 'mostview\MostViewController@getIndex'); 

# Statics
Route::get('static/{id}', 'video\VideoController@showStaticPage'); 

Route::get('infomation-fqa', 'login\LoginController@getFQA'); 

Route::get('/sitemap', 'login\LoginController@getSitemap'); 

Route::get('/contact', 'login\LoginController@getContact'); 

Route::post('/contact', 'login\LoginController@postContact'); 



// Admin Routers
Route::group(array('prefix'=>'admincp'), function() {

Route::get('logout', 'admincp\LoginController@getLogout');

Route::get('login', array(
	'as'	=>'login', 
	'uses'	=>'admincp\LoginController@getLogin', 
	'middleware'=>'HasSession'
	));

Route::get('/', array(
	'as'	=>'admincp', 
	'uses'	=>"admincp\DashboardController@getDashboard", 
	'middleware'=>'checkLogin'
	));

Route::post('login', 'admincp\LoginController@postLogin');

Route::post('admin-rest-password', 'admincp\LoginController@postResetPassword');

Route::get('categories', array(
	'uses'=>'admincp\CategoriesController@getCategories', 
	'middleware'=>'checkLogin'
	)); //

Route::get('add-categories', array(
	'uses'=>'admincp\CategoriesController@getAddCategories', 
	'middleware'=>'checkLogin'
	));

Route::post('add-categories', array(
	'uses'=>'admincp\CategoriesController@postAddCategories', 
	'middleware'=>'checkLogin'
	));

Route::get('edit-categories/{id}', array(
	'uses'=>'admincp\CategoriesController@getEditCategories', 
	'middleware'=>'checkLogin'
	));

Route::post('edit-categories/{id}', array(
	'uses'=>'admincp\CategoriesController@postEditCategories', 
	'middleware'=>'checkLogin'
	));

Route::get('delete-categories/{id}', array(
	'uses'=>'admincp\CategoriesController@getDeleteCategories', 
	'middleware'=>'checkLogin'
	));

Route::get('add-video', array(
	'uses' =>'admincp\VideoController@getAddVideo', 
	'middleware' =>'checkLogin'
	));

Route::post('add-video', array(
	'uses'=>'admincp\VideoController@postAddVideo', 
	'middleware' =>'checkLogin'
	));

Route::get('video', array(
	'uses' =>'admincp\VideoController@getVideo', 
	'middleware' =>'checkLogin'
	));

Route::get('delete-video/{string_Id}', array(
	'uses' =>'admincp\VideoController@getDeleteVideo', 
	'middleware' => 'checkLogin'
	));

Route::get('edit-video/{string_Id}', array(
	'uses' =>'admincp\VideoController@getEditVideo', 
	'middleware'=>'checkLogin'
	));

Route::post('edit-video/{string_Id}', array(
	'uses' =>'admincp\VideoController@postEditVideo', 
	'middleware' =>'checkLogin'
	));

Route::get('video-comment', array(
	'uses'=>'admincp\VideoController@getComment', 
	'middleware' => 'checkLogin'
	));

Route::get('delete-video-comment/{string_Id}', array(
	'uses'=>'admincp\VideoController@getDeleteComment', 
	'middleware' => 'checkLogin'
	));

Route::get('edit-video-comment/{string_Id}', array(
	'uses'=>'admincp\VideoController@getEditComment', 
	'middleware' => 'checkLogin'
	));

Route::get('report-comment&id={listid}', array(
	'uses'=>'admincp\VideoController@getReport', 
	'middleware' => 'checkLogin'
	));

Route::get('admin-reply-comment/{listid}', array(
	'uses'=>'admincp\VideoController@getAdminReply', 
	'middleware' => 'checkLogin'
	));

Route::post('admin-reply-comment/{listid}', array(
	'uses'=>'admincp\VideoController@postAdminReply', 
	'middleware' => 'checkLogin'
	));

Route::get('option', array(
	'uses'=>'admincp\LoginController@getOption', 
	'middleware' => 'checkLogin'
	));

Route::post('edit-video-comment/{string_Id}', array(
	'uses'=>'admincp\VideoController@postEditComment', 
	'middleware' => 'checkLogin'
	));

Route::post('option', array(
	'uses'=>'admincp\LoginController@postOption', 
	'middleware' => 'checkLogin'
	));

Route::get('ads-text-video', array(
	'uses'=>'admincp\VideoSettingController@getTextAds', 
	'middleware' => 'checkLogin'
	));

Route::get('add-video-text-ads', array(
	'uses'=>'admincp\VideoSettingController@getAddTextAds', 
	'middleware' => 'checkLogin'
	));

Route::post('add-video-text-ads', array(
	'uses'=>'admincp\VideoSettingController@postAddTextAds', 
	'middleware' => 'checkLogin'
	));

Route::get('edit-video-text-ads&is={id}', array(
	'uses'=>'admincp\VideoSettingController@getEditTextAds', 
	'middleware' => 'checkLogin'
	));

Route::post('edit-video-text-ads&is={id}', array(
	'uses'=>'admincp\VideoSettingController@postEditTextAds', 
	'middleware' => 'checkLogin'
	));

Route::get('del-text-ads&is={id}', array(
	'uses'=>'admincp\VideoSettingController@delTextAds', 
	'middleware' => 'checkLogin'
	));

Route::get('ads-standard', array(
	'uses'=>'admincp\VideoController@getStandardAds', 
	'middleware' => 'checkLogin'
	)); //

Route::get('add-standard-ads', array(
	'uses'=>'admincp\VideoController@getAddStandardAds', 
	'middleware' => 'checkLogin'
	));

Route::post('add-standard-ads', array(
	'uses'=>'admincp\VideoController@postAddStandardAds', 
	'middleware' => 'checkLogin'
	));

Route::get('edit-standard-ads&is={id}', array(
	'uses'=>'admincp\VideoController@getEditStandardAds', 
	'middleware' => 'checkLogin'
	));

Route::post('edit-standard-ads&is={id}', array(
	'uses'=>'admincp\VideoController@postEditStandardAds', 
	'middleware' => 'checkLogin'
	));

Route::get('del-standard-ads&is={id}', array(
	'uses'=>'admincp\VideoController@deleteStandardAds', 
	'middleware' => 'checkLogin'
	));

Route::get('ads-video', array(
	'uses'=>'admincp\VideoSettingController@getVideoAds', 
	'middleware' => 'checkLogin'
	));

Route::get('edit_in-player-media-ads/{id}', array(
	'uses'=>'admincp\VideoSettingController@getEditVideoAds', 
	'middleware' => 'checkLogin'
	));

Route::post('edit_in-player-media-ads/{id}', array(
	'uses'=>'admincp\VideoSettingController@postEditVideoAds', 
	'middleware' => 'checkLogin'
	));

Route::get('delete_in-player-media-ads/{id}', array(
	'uses'=>'admincp\VideoSettingController@delVideoAds', 
	'middleware' => 'checkLogin'
	));

Route::get('change-password', array(
	'uses'=>'admincp\LoginController@getChangePass', 
	'middleware' => 'checkLogin'
	));

Route::post('change-password', array(
	'uses'=>'admincp\LoginController@postChangePass', 
	'middleware' => 'checkLogin'
	));

Route::get('static-page', array(
	'uses'=>'admincp\LoginController@getStaticPage', 
	'middleware' => 'checkLogin'
	));

Route::get('add-static-page', array(
	'uses'=>'admincp\LoginController@getAddStaticPage', 
	'middleware' => 'checkLogin'
	));

Route::post('add-static-page', array(
	'uses'=>'admincp\LoginController@postAddStaticPage', 
	'middleware' => 'checkLogin'
	));

Route::get('edit-static-page/{id}', array(
	'uses'=>'admincp\LoginController@getEditStaticPage', 
	'middleware' => 'checkLogin'
	)); //

Route::post('edit-static-page/{id}', array(
	'uses'=>'admincp\LoginController@postEditStaticPage', 
	'middleware' => 'checkLogin'
	));

Route::post('auto-upload-video', array(
	'uses'=>'admincp\VideoController@autoUploadVideo', 
	'middleware' => 'checkLogin'
	));

Route::post('save-video', array(
	'uses'=>'admincp\VideoController@saveVideo', 
	'middleware' => 'checkLogin'
	));

Route::get('private-message', array(
	'uses'=>'admincp\VideoController@getListPrivateMessage', 
	'middleware' => 'checkLogin'
	));

Route::get('reply-message/{id}', array(
	'uses'=>'admincp\VideoController@getRelayMessage', 
	'middleware' => 'checkLogin'
	));

Route::post('reply-message/{id}', array(
	'uses'=>'admincp\VideoController@postRelayMessage', 
	'middleware' => 'checkLogin'
	));

Route::get('delete-message/{id}', array(
	'uses'=>'admincp\VideoController@deleleMessage', 
	'middleware' => 'checkLogin'
	));

Route::get('header-link', array(
	'uses'=>'admincp\LoginController@getHeaderLink', 
	'middleware' => 'checkLogin'
	));

Route::get('add-header-link', array(
	'uses'=>'admincp\LoginController@getAddHeaderLink', 
	'middleware' => 'checkLogin'
	));

Route::post('add-header-link', array(
	'uses'=>'admincp\LoginController@postAddHeaderLink', 
	'middleware' => 'checkLogin'
	));

Route::get('edit-header-link/{id}', array(
	'uses'=>'admincp\LoginController@getEditHeaderlink', 
	'middleware' => 'checkLogin'
	));

Route::post('edit-header-link/{id}', array(
	'uses'=>'admincp\LoginController@postEditHeaderLink', 
	'middleware' => 'checkLogin'
	));

Route::get('delete-header-link/{id}', array(
	'uses'=>'admincp\LoginController@getDeleteHeaderLink', 
	'middleware' => 'checkLogin'
	));

Route::get('general-setting', array(
	'uses'=>'admincp\LoginController@get_general_setting', 
	'middleware' => 'checkLogin'
	));

Route::get('conversion-config', array(
	'uses'=>'admincp\LoginController@getConversionConfig', 
	'middleware' => 'checkLogin'
	));

Route::post('conversion-config', array(
	'uses'=>'admincp\LoginController@postConversionConfig', 
	'middleware' => 'checkLogin'
	));

Route::get('video-setting', array(
	'uses'=>'admincp\VideoSettingController@getSetting', 
	'middleware' => 'checkLogin'
	));

Route::post('video-setting', array(
	'uses'=>'admincp\VideoSettingController@postSetting', 
	'middleware' => 'checkLogin'
	));

Route::get('in-player-media-ads', array(
	'uses'=>'admincp\VideoSettingController@getInPlayerMediaAds', 
	'middleware' => 'checkLogin'
	));

Route::post('in-player-media-ads', array(
	'uses'=>'admincp\VideoSettingController@postInPlayerMediaAds', 
	'middleware' => 'checkLogin'
	));

Route::get('email-templete', array(
	'uses'=>'admincp\VideoSettingController@getEmailTemplete', 
	'middleware' => 'checkLogin'
	));

Route::get('add-email-templete', array(
	'uses'=>'admincp\VideoSettingController@getAddEmailTemplete', 
	'middleware' => 'checkLogin'
	));

Route::post('add-email-templete', array(
	'uses'=>'admincp\VideoSettingController@postAddEmailTemplete', 
	'middleware' => 'checkLogin'
	));

Route::get('email-templete', array(
	'uses'=>'admincp\VideoSettingController@getEmailTemplete', 
	'middleware' => 'checkLogin'
	));

Route::get('edit-email-templete&id={id}', array(
	'uses'=>'admincp\VideoSettingController@getEditEmailTemplete', 
	'middleware' => 'checkLogin'
	));

Route::post('edit-email-templete&id={id}', array(
	'uses'=>'admincp\VideoSettingController@postEditEmailTemplete', 
	'middleware' => 'checkLogin'
	));

Route::get('del-email-templete&id={id}', array(
	'uses'=>'admincp\VideoSettingController@getDelEmailTemplete', 
	'middleware' => 'checkLogin'
	));

Route::get('email-setting', array(
	'uses'=>'admincp\VideoSettingController@getEmailSetting', 
	'middleware' => 'checkLogin'
	));

Route::post('email-setting', array(
	'uses'=>'admincp\VideoSettingController@postEmailSetting', 
	'middleware' => 'checkLogin'
	));

Route::get('contact', array(
	'uses'=>'admincp\LoginController@getContactList', 
	'middleware' => 'checkLogin'
	));

Route::post('contact&action=reply&id={id}', array(
	'uses'=>'admincp\LoginController@postContactList', 
	'middleware' => 'checkLogin'
	));

Route::get('all-fqa', array(
	'uses'=>'admincp\LoginController@getFQAList', 
	'middleware' => 'checkLogin'
	));

Route::get('add-fqa', array(
	'uses'=>'admincp\LoginController@getAddFQA', 
	'middleware' => 'checkLogin'
	));

Route::post('add-fqa', array(
	'uses'=>'admincp\LoginController@postAddFQA', 
	'middleware' => 'checkLogin'
	));

Route::get('edit-fqa/{id}', array(
	'uses'=>'admincp\LoginController@getEditFQA', 
	'middleware' => 'checkLogin'
	));

Route::post('edit-fqa/{id}', array(
	'uses'=>'admincp\LoginController@postEditFQA', 
	'middleware' => 'checkLogin'
	));

Route::get('delete-fqa/{id}', array(
	'uses'=>'admincp\LoginController@getDeleteFQA', 
	'middleware' => 'checkLogin'
	));

Route::get('member-list-subscribe/{id}', array(
	'uses'=>'admincp\ChannelController@get_member_list_subscribe', 
	'middleware' => 'checkLogin'
	));

});
