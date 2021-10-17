<?php
function dumpComments($comments, $view = 'video.comment') {
    $commentList = '';
    $user=\Session::get('User'); 
    foreach ($comments as $comment) {

        $commentList .= view($view)->with('result', $comment)->with('user',$user)->render();
    }

    echo $commentList;
}
/**
 * truncate a string after n words
 * @param string $text
 * @param int $limit limit word
 * @return string
 */
function truncate($text, $limit){
    $text = strip_tags($text);
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function sec2hms ($sec, $padHours = false)
     {
        $hms = "";
        $hours = intval(intval($sec) / 3600);
        if($hours > 0){
          $hms .= ($padHours)? str_pad($hours, 2, "0", STR_PAD_LEFT). ':': $hours. ':';  
        }
        $minutes = intval(($sec / 60) % 60);
        $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';
        $seconds = intval($sec % 60);
        $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
        return $hms;
    }
function convert_time($time="00:00:00"){
  $time_array=explode(':', $time);
  // var_dump($time_array);die;
  $timer=0;
  $hours=$minutes=$seconds=0;
  if(count($time_array)==3){
    // die('dsd')/;
    $hours=intval($time_array[0])*3600;
    $minutes=intval($time_array[1])*60;
    $seconds=intval($time_array[2]);
    return $timer=$hours+$minutes+$seconds;
  }else{
    $minutes=intval($time_array[0])*60;
    $seconds=intval($time_array[1]);
    return $timer=$hours+$minutes+$seconds;
  }
}

function get_title_datetime() {
    $date = new Datetime();
    $format = $date->format('l, F dS, Y');
    return "Videos Uploaded On " . $format;
}

function getAvailableAppLangArray()
{
  $locales[''] = Lang::get('app.select_your_language');
 
  foreach (Config::get('app.locales') as $key => $value)
  {
    $locales[$key] = $value;
  }
 
  return $locales;
}
function get_categories_list($cat_array){
  $cat=explode(',',$cat_array);
    $cat_list=array();
    for ($i=0; $i <count($cat) ; $i++) { 
        $catID=explode("_",$cat[$i]);
        array_push($cat_list,end($catID));
    }
  echo implode(",", $cat_list);
}

function get_categories_list_link($cat_array){
  $cat=explode(',',$cat_array);
    $cat_list=array();
    for ($i=0; $i <count($cat) ; $i++) { 
        $catID=explode("_",$cat[$i]);
        $cat_name= \App\Models\CategoriesModel::find($catID[0]);
        if($cat_name!=NULL){
          $html='<a class="tag" href="'.URL('categories').'/'.$cat_name->ID.'.'.$cat_name->post_name.'.html">'.$cat_name->title_name.'</a>';
          array_push($cat_list, $html);
        }
        
    }
  
  return  implode(',',$cat_list);
  
}
  function cat_form_array($cat_array){
    $cat_post= explode(',', $cat_array);
    $cat_list=array();
    for ($i=0; $i <count($cat_post) ; $i++) { 
        $catID=explode("_", $cat_post[$i]);
        array_push($cat_list, $catID[0]);
    }
    return implode(',',$cat_list);
}
function cat_array($cat_array){
    $cat_post= explode(',', $cat_array);
    $cat_list=array();
    for ($i=0; $i <count($cat_post) ; $i++) { 
        $catID=explode("_", $cat_post[$i]);
        array_push($cat_list, $catID[0]);
    }
    return $cat_list;
}
function cat_array_name($cat_array){
    $cat_post= explode(',', $cat_array);
    $cat_list=array();
    for ($i=0; $i <count($cat_post) ; $i++) { 
        $catID=explode("_", $cat_post[$i]);
        array_push($cat_list, $catID[1]);
    }
    return implode(',',$cat_list);
}
function get_cat_video_id($id,$video_list){
  $temp=array();
    $tempvideoID=array();
    for ($i=0; $i <count($video_list); $i++) { 
      array_push($temp,$video_list[$i]->string_Id."_".$video_list[$i]->cat_id);
    }
    for ($i=0; $i <count($temp) ; $i++) { 
      $videoID=explode('_', $temp[$i]);
      $cat_id=$videoID[1];
      $cat_array=explode(',',$cat_id);
      if(in_array($id,$cat_array)){
        array_push($tempvideoID,$videoID[0]);
      }
    }
    return $tempvideoID;
}
function get_video_form_cat($id){
    $video_id=array();
    $get_video_id= \App\Models\VideoCatModel::where('cat_id','=',$id)->get();
    for ($i=0; $i <count($get_video_id) ; $i++) { 
        array_push($video_id,$get_video_id[$i]->video_id);
    }
    $video_array=\App\Models\VideoModel::where('status','=',1)
                                        ->whereIn('string_Id',$video_id)
                                        ->take(4)
                                        ->OrderbyRaw('RAND()')
                                        ->get();
    return $video_array;
}
function count_video_in_cat($id){
   $count= \App\Models\VideoCatModel::select('video_cat.video_id')->where('video_cat.cat_id','=',$id)->count();
   if($count==1 or $count==0){
    return $count." Video";
   }else{
    return $count." Videos";
   }
}
function count_video_in_channel($id){
   $count= \App\Models\VideoModel::where('channel_Id','=',$id)->count();
   if($count==1 or $count==0){
    return $count." Video";
   }else{
    return $count." Videos";
   }
}
function get_client_ip() {
         // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}
function pornhub_param_url_time_start(){
  $start=date('Y-m-d H:i:s');
  return strtotime($start);
}
function pornhub_param_url_time_end(){
  $end=strtotime('+2 hours',pornhub_param_url_time_start());
  return $end;
}

function get_categories(){
  $categories = \App\Models\CategoriesModel::where('status','=',1)->orderby('title_name','asc')->get();
  return $categories;
}

function StandardAdHome(){
  $data= \App\Models\StandardAdsModel::get_standard_home();
  return $data;
}
function StandardAdFooter(){
  $data= \App\Models\StandardAdsModel::get_standard_footer();
  return $data;
}
function StandardAdTopRate(){
  $data= \App\Models\StandardAdsModel::get_standard_toprate();
  return $data;
}
function StandardAdMostView(){
  $data= \App\Models\StandardAdsModel::get_standard_mostview();
  return $data;
}
function StandardAdVideo(){
  $data= \App\Models\StandardAdsModel::get_standard_video();
  return $data;
}
function StandardAdPornstar(){
  $data = \App\Models\StandardAdsModel::get_standard_pornstar();
  return $data;
}
function GetVideoConfig(){
  $setting = \App\Models\VideoSettingModel::get_config();
  return $setting;
}
function GetSiteConfig(){
  $setting = \App\Models\OptionModel::get_config();
  return $setting;
}
function GetPlayerAds(){
  $video_ads = \App\Models\VideoAdsModel::get_ads_video();
  return $video_ads;
}
function GetRatingVideo($videoID){
  $rating = \App\Models\RatingModel::get_percent($videoID);
  return $rating;
}
function CheckWatchingVideo(){
  $checkwatching = \App\Models\WatchNowModel::check_watch();
  return $checkwatching;
}
function CheckBanIP(){
  $IPadress = \App\Models\BanIPModel::get_list_ban();
  return $IPadress;
}
function GetPaymentConfig(){
  $config = \App\Models\PaymentConfigModel::get_payment_config();
  return $config;
}
function GetStaticPage($id){
  $staticpage= \App\Models\StaticPageModel::show_link($id);
  return $staticpage;
}
function GetHeaderNews(){
  $sticknews= \App\Models\HeaderModel::get_list_link();
  return $sticknews;
}
function is_404($url) {
    $handle = curl_init($url);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

    /* Get the HTML or whatever is linked in $url. */
    $response = curl_exec($handle);

    /* Check for 404 (file not found). */
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);

    /* If the document has loaded successfully without any redirection or error */
    if ($httpCode >= 200 && $httpCode < 300) {
        return false;
    } else {
        return true;
    }
}
function CountMessageMember($form){
  $c_message= App\Models\MemberMessageModel::where('frommember','=',$form)->count();
  return $c_message;
}
function GetAllMessage($form){
  $allmessage= \App\Models\MemberMessageModel::select('members.firstname','members.lastname','member_message.*')
                                            ->where('member_message.frommember','=',$form)
                                            //->where('member_message.tomember','=',$frommember)
                                            ->join('members','members.user_id','=','member_message.frommember')
                                            ->get();
    return $allmessage;
}
function GetMemberName($uID){
  $member_name= \App\Models\MemberModel::where('user_ID','=',$uID)->first();
  return $member_name;
}
function CheckUserPayment($userID,$videoID){
  $checkUse= \App\Models\SubsriptionModel::check_user_buy_video($userID,$videoID);
  return $checkUse;
}

//get link server http://www.4tube.com/

function ResetURLVideo($url,$host){
 
  $call_c= new App\Http\Controllers\admincp\DownloaderController();
 $data= $call_c->get_info_video($url,$host);
  return $data;
}
function GetPath() {
  return "";
}
