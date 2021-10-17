<?php

namespace App\Http\Controllers\admincp;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Models\VideoModel;
use App\Helpers\Languages;

class DownloaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video  = VideoModel::select('video.*','channel.title_name as title_channel','categories.title_name as title_categories','pornstar.title_name as title_porn')
                            ->where('video.status','=','1')
                            ->where('video.dowloader','=','1')
                            ->leftJoin('channel','channel.ID','=','video.channel_Id')
                            ->leftJoin('categories','categories.ID','=','video.categories_Id')
                            ->leftJoin('pornstar','pornstar.ID','=','video.pornstar_Id')
                            ->orderBy('video.created_at','ASC')
                            ->get();
        if($video){
            return view('admincp.dowload.index')->with('video',$video);
        }
    }

    public function add_view()
    {
        $categories = \App\Models\CategoriesModel::get();
        $channel = \App\Models\ChannelModel::get();
        $pornstar = \App\Models\PornStarModel::get();
        return view('admincp.dowload.add')->with('categories',$categories)->with('channel',$channel)->with('pornstar',$pornstar);
    }

    public function add(Request $data)
    {
        $rule = array(
            'link' => 'required',
        );
        $validator = Validator::make($data->all(), $rule);
        if ($validator->fails())
        {
            return redirect('admincp/dowload-video-add-view')->withErrors($validator);
        }else{
            $website = $data->website;
            $url = $data->link;
            if (strpos($url, $website)) {
                $result = $this->check_url_video($url);

                $video = VideoModel::where("video_src", "=", "'".$result['link']."'")->count();
                //var_dump($data->categories_result);die;
                if (empty($video)) {
                    $string = mt_rand();
                    if(isset($data->post_result_cat)){
                        $tostring= implode(',', $data->post_result_cat);
                        $cat_post = cat_array($tostring);
                        for ($i=0; $i <count($cat_post) ; $i++) {
                            $videocat = new \App\Models\VideoCatModel();
                            $videocat->video_id=$string;
                            $videocat->cat_id=$cat_post[$i];
                            $videocat->save();
                        }
                    }

                    $model =  new VideoModel();
                    // $model->categories_Id = $data->category;
                    $model->categories_Id = isset($tostring)? $tostring : '';
                    $model->cat_id = isset($tostring) ?cat_form_array($tostring) : '';
                    $model->channel_Id = $data->channel;
                    $model->pornstar_Id = $data->pornstar;
                    $model->title_name = $result['title'];
                    $model->post_name = str_slug($result['title']);
                    $model->video_sd = $result['link'];
                    $model->video_src = $result['linkHD'];
                    $model->video_url = $result['video_url'];
                    $model->poster = str_replace('\/','/',$result['image']);
                    $model->tag = $result['tag'];
                    $model->string_Id = $string;
                    //var_dump($result['duration']."/".(int)$result['duration']);die;
                    if(strlen($result['duration'])!=strlen((int)$result['duration'])){
                        $duration=convert_time($result['duration']);
                    }else{
                        $dura = (int)$result['duration'];
                        $duration =$dura;
                    }
                    $model->duration = $duration;
                    $model->description = $result['description'];
                    $model->status = $data->status;
                    if (strpos($result['image'], 'pornfun.com')) {
                        $model->duration = $result['duration'];
                    }
                    if (strpos($result['image'], 'www.vporn.com')) {
                        $model->duration = $result['duration'];
                    }
                    $model->website = $website;
                    $model->dowloader = 1;
                    $model->save();
                    $success = "Save video success";
                    return redirect('admincp/video')->with('success',$success);
                }else{
                    $error = array('erroe' => "Video exists on database!" );
                    return redirect('admincp/dowload-video-add-view')->withErrors($error);
                }
            }else{
                $error = array('erroe' => "Link Url incorect with website!" );
                return redirect('admincp/dowload-video-add-view')->withErrors($error);
            }

        }
    }

    public function check_url_video($url){
        $get_url= parse_url($url);
        // var_dump($get_url['host']); die;
        switch ($get_url['host']) {
            case 'www.maxjizztube.com':
                return $this->get_info_video($url,'www.maxjizztube.com');
                break;
            case 'www.4tube.com':
                return $this->get_info_video($url,'www.4tube.com');
                break;
            case 'www.besthdtube.com':
                return $this->get_info_video($url,'www.besthdtube.com');
                break;
            case 'lubetube.com':
                return $this->get_info_video($url,'lubetube.com');
                break;
            case 'www.txxx.com':
                return $this->get_info_video($url,'www.txxx.com');
                break;
            case 'www.pornhub.com':
                return $this->get_info_video($url,'www.pornhub.com');
                break;
            case 'pornfun.com':
                return $this->get_info_video($url,'pornfun.com');
                break;
            case 'www.vporn.com':
                return $this->get_info_video($url,'www.vporn.com');
                break;
            case 'www.yobt.com':
                return $this->get_info_video($url,'www.yobt.com');
                break;
            case 'www.youporn.com':
                return $this->get_info_video($url,'www.youporn.com');
                break;
            case 'xhamster.com':
                return $this->get_info_video($url,'xhamster.com');
                break;
            case 'www.xvideos.com':
                return $this->get_info_video($url,'www.xvideos.com');
                break;
            case 'www.xtube.com':
                return $this->get_info_video($url,'www.xtube.com');
                break;

            default: return redirect('admincp/grab-video')->with('msg','Url incorect!');
        }
    }

    //grab youtube
    public function get_info_video($url,$host){
        $data = $this->actionSimpleHtmlWithURL($url,$host);
        return $data;
    }



    public function actionSimpleHtmlWithURL($url,$host)
    {
        require ''.$_SERVER['DOCUMENT_ROOT'].'/lib/simplehtmldom/simple_html_dom.php';
        if ($host == 'www.pornhub.com') {
            $html_content = $this->get($url, 'http://www.pornhub.com', 'www.pornhub.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('#player',0)->innertext ;
            // get Url Video
            if (strpos($linkURL, 'player_quality_480p')) {
                $vtri = strpos($linkURL, 'player_quality_480p');
                $link = substr($linkURL, $vtri+23);
                $vtri1 = strpos($link, "'");
                // get Url Video
                $linkUrl = substr($link,0, $vtri1);
            }
            if (empty($linkUrl)) {
                $vtri = strpos($linkURL, 'player_quality_240p');
                $link = substr($linkURL, $vtri+23);
                $vtri1 = strpos($link, "'");
                // get Url Video
                $linkUrl = substr($link,0, $vtri1);
            }
            $video_url=$url;
            // $start= date('Y-m-d H:i:s','1452585475');
            // $end = date('Y-m-d H:i:s','1452592675');

            //http://cdn2b.video.pornhub.phncdn.com/videos/201512/31/64985831/480P_600K_64985831.mp4?rs=200&ri=2500&ipa=115.79.59.63&s=1452582499&e=1452589699&h=13bf9f1d98da64cd3b6be3ba549dae2f
            //var_dump($linkUrl);die;
            // get duration Video
            if (strpos($linkURL, 'video_duration')) {
                $d_vtri = strpos($linkURL, 'video_duration');
                $dura = substr($linkURL, $d_vtri+17);
                $d_vtri1 = strpos($dura, '"');
                // get duration Video
                $video_duration = (float)substr($dura,0, $d_vtri1);
            }

            // get Title
            $title = $obj_content->find('.title-container h1.title',0)->plaintext ;
            // Tag
            $tagsWrapper = $obj_content->find('.tagsWrapper',0)->plaintext;
            // get Image URL
            if (strpos($linkURL, 'image_url')) {
                $i_vtri = strpos($linkURL, 'image_url');
                $im = substr($linkURL, $i_vtri+12);
                $i_vtri1 = strpos($im, '"');
                // get duration Video
                $image = substr($im,0, $i_vtri1);
            }

            $description = '';
        }
        if ($host == 'pornfun.com') {
            $html_content = $this->get($url, 'http://www.pornfun.com', 'pornfun.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('.player',0)->innertext ;
            // get Url Video
            if (strpos($linkURL, 'video_url')) {
                $vtri = strpos($linkURL, 'video_url');
                $link = substr($linkURL, $vtri+12);
                $vtri1 = strpos($link, "'");
                // get Url Video
                $linkUrl = substr($link,0, $vtri1);
            }
            // get duration Video
            $video_duration = $obj_content->find('.information strong',0)->plaintext ;

            // get Title
            $title = $obj_content->find('.headline h1',0)->plaintext ;
            // Tag
            $tags = $obj_content->find('meta[itemprop="keywords"]',0)->outertext;
            if (strpos($tags, 'content')) {
                $tag_vitri = strpos($tags, 'content');
                $ta = substr($tags, $tag_vitri+9);
                $tag_vitri1 = strpos($ta, '"');
                // get duration Video
                $tagsWrapper = substr($ta,0, $tag_vitri1);
            }
            // get Image URL
            $ima = $obj_content->find('meta[itemprop="thumbnailUrl"]',0)->outertext;
            if (strpos($ima, 'content')) {
                $i_vtri = strpos($ima, 'content');
                $im = substr($ima, $i_vtri+9);
                $i_vtri1 = strpos($im, '"');
                // get duration Video
                $image = substr($im,0, $i_vtri1);
                // var_dump($image); die;
            }
            // get description
            $decr = $obj_content->find('meta[itemprop="description"]',0)->outertext;
            if (strpos($decr, 'content')) {
                $de_vitri = strpos($decr, 'content');
                $dec = substr($decr, $de_vitri+9);
                $de_vitri1 = strpos($dec, '"');
                // get duration Video
                $description = substr($dec,0, $de_vitri1);
            }
        }
        //www.txxx.com
        if ($host == 'www.txxx.com') {
            $html_content = $this->get($url, 'www.txxx.com', 'www.txxx.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('.player',0)->innertext ;
            $video_url=$url;
            // get Url Video
            if (strpos($linkURL, 'video_url')) {
                $vtri = strpos($linkURL, 'video_url');
                $link = substr($linkURL, $vtri+12);
                $vtri1 = strpos($link, "'");
                // get Url Video
                $linkUrl = substr($link,0, $vtri1);
            }
            // get duration Video
            $video_duration = $obj_content->find('.video-info__data strong',0)->plaintext ;
            //var_dump($video_duration);die;
            // get Title
            $title = $obj_content->find('.video-info__title h1',0)->plaintext ;

            // Tag

            $get_meta = get_meta_tags($url);
            $tagsWrapper=$get_meta['keywords'];
            //$obj_content->find('meta[itemprop="keywords"]',0)->outertext;
            $image = $obj_content->find('.player',0)->innertext ;
            // get Url Video
            if (strpos($image, 'preview_url')) {
                $vtri = strpos($image, 'preview_url');
                $link = substr($image, $vtri+14);
                $vtri1 = strpos($link, "'");

                // get Url Video
                $image = substr($link,0, $vtri1);

            }

            $description=$get_meta['description'];


        }//www.txxx.com

        //lubetube.com
        if ($host == 'lubetube.com') {
            $html_content = $this->get($url, 'http://lubetube.com', 'lubetube.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('#video-hd',0)->href ;
            $linkUrl=$linkURL;

            $video_url=$url;
            // get  Video script tag
            foreach($obj_content->find('script') as $key => $value)
            {
                if($key==10){
                    $image= $value->outertext;

                }
            }
            if (strpos($image, 'video_preview_url')) {
                $vtri = strpos($image, 'video_preview_url');
                $link = substr($image, $vtri+21);
                $vtri1 = strpos($link, '"');
                $image_url = substr($link,0, $vtri1);
            }
            if (strpos($image, 'videopreview ')) {
                $vtri = strpos($image, 'videopreview ');
                $link = substr($image, $vtri+16);
                $vtri1 = strpos($link, '"');
                $image_file = substr($link,0, $vtri1);
            }
            $image=$image_url."/".$image_file; //image url
            $video_duration = $obj_content->find('.detailstitle'); //video duration
            foreach($video_duration as $key =>$value)
            {
                if($key==3){
                    $video_duration=$value->next_sibling()->innertext;
                }
                if($key==2){
                    $title=$value->next_sibling()->innertext;
                }
            }
            $get_meta = get_meta_tags($url); //get meta data video
            $tagsWrapper=$get_meta['keywords']; //video tag
            $description=$get_meta['description']; //video description

        }//lubetube.com-- end



        //www.besthdtube.com
        if ($host == 'www.besthdtube.com') {
            $html_content = $this->get($url, 'http://www.besthdtube.com', 'www.besthdtube.com');
            $obj_content = str_get_html($html_content);

            foreach($obj_content->find('script') as $key => $value) //get string
            {
                    if($key==13){
                        $string= $value->outertext;
                    }
            }
            if (strpos($string, 'file')) {
                $vtri = strpos($string, 'file');
                $link = substr($string, $vtri+7);
                $vtri1 = strpos($link, '"');
                $linkUrl = substr($link,0, $vtri1); //video link

            }

            $video_url=$url;
            if (strpos($string, 'image')) {
                $vtri = strpos($string, 'image');
                $link = substr($string, $vtri+8);
                $vtri1 = strpos($link, "'");
                $image = substr($link,0, $vtri1); //image url
            }
            $title=$obj_content->find('title',0)->plaintext;
            $video_duration = $obj_content->find('.time',0)->plaintext; //video duration
            $get_meta = get_meta_tags($url); //meta data
            $tagsWrapper=$get_meta['keywords'];// video tag
            $description=$get_meta['description'];//video description


        }//www.besthdtube.com
        //www.4tube.com
        if ($host == 'www.4tube.com') {
            $html_content = $this->get($url, 'http://www.4tube.com', 'www.4tube.com');
            $obj_content = str_get_html($html_content);
            $data= $obj_content->find('#download-links');
            foreach ($data as $key) {
              $string_html= $key;
            }
            $attr=array();
            foreach ($string_html->find('button') as $key => $value) {
                $string=$value->attr;
                array_push($attr, $string);
            }
            //$data_id=$attr[0]['data-id'];
            for ($i=0; $i <count($attr) ; $i++) {
               if($attr[$i]['data-quality']=="240"){
                $quality240=$attr[$i]['data-quality'];
               }if($attr[$i]['data-quality']=="360"){
                $quality360=$attr[$i]['data-quality'];
               }
               if($attr[$i]['data-quality']=="480"){
                $quality480=$attr[$i]['data-quality'];
               }
               if($attr[$i]['data-quality']=="720"){
                $quality720=$attr[$i]['data-quality'];
               }
               if($attr[$i]['data-quality']=="1080"){
                $quality1080=$attr[$i]['data-quality'];
               }

            }
            // var_dump($quality240.$quality360.$quality480.$quality720.$quality1080);
            $v1080=isset($quality1080)? $quality1080.'+':'';
            $v720=isset($quality720)? $quality720.'+':'';
            $v480=isset($quality480)? $quality480.'+':'';
            $v360=isset($quality360)? $quality360.'+':'';
            $v240=isset($quality240)? $quality240:'';
            $urlv = 'tkn.4tube.com/'.$attr[0]['data-id'].'/desktop/'.$v1080.$v720.$v480.$v360.$v240 ;
            $ch = curl_init($urlv);
            curl_setopt($ch,CURLOPT_HTTPHEADER,array('Origin: http://www.4tube.com'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            $data_back=json_decode($response);
            //date('H:i:s ','20160109040025')
            $data = json_decode(json_encode($data_back), true);
            $linkUrl=$data['360']['token'];
            if(isset($data['720'])){
                 $linkUrlHD=$data['720']['token'];
            }else{
                $linkUrlHD=$linkUrl;
            }

            $video_url=$url;

            $str_image= $obj_content->find('.videoplayer');
            foreach ($str_image as $key ) {
                foreach ($key->find('meta') as $keychild =>$value ){
                   if($keychild==0){
                        $temp_title=$value->outertext;
                   }
                   if($keychild==4){
                        $temp_image=$value->outertext;
                   }
                   if($keychild==4){
                        $temp_image=$value->outertext;
                   }
                   if(strlen($value->outertext)==48){
                        $temp_duration=$value->outertext;
                   }
                }
            }
            if (strpos($temp_title, 'content=')) {
                $vtri = strpos($temp_title, 'content=');
                $link = substr($temp_title, $vtri+14);
                $vtri1 = strpos($link, '"');
                $title = substr($link,0, $vtri1); //video link
            }
            if (strpos($temp_image, 'content=')) {
                $vtri = strpos($temp_image, 'content=');
                $link = substr($temp_image, $vtri+9);
                $vtri1 = strpos($link, '"');
                $image = substr($link,0, $vtri1); //video link
            }
            if (strpos($temp_duration, 'content=')) {
                $vtri = strpos($temp_duration, 'content=');
                $link = substr($temp_duration, $vtri+9);
                $vtri1 = strpos($link, '"');
                $du_temp = substr($link,0, $vtri1); //video link
            }
            $dura_strim_1=substr($du_temp,2);
            $dura_strim_2 =substr($dura_strim_1, 0, -1);
            $vowels = array("H", "M");
            $video_duration=str_replace($vowels,':',$dura_strim_2); //video duration
            $get_meta = get_meta_tags($url); //get meta data video
            $tagsWrapper=""; //$get_meta['keywords']; //video tag
            $description=$get_meta['description']; //video description
        }//www.4tube.com

        //www.maxjizztube.com
            if ($host == 'www.maxjizztube.com') {
            $html_content = $this->get($url, 'http://www.maxjizztube.com', 'www.maxjizztube.com');
            $obj_content = str_get_html($html_content);
            $str_content= $obj_content->find('#player',0)->outertext;
            if (strpos($str_content, 'settings')) {
                $vtri = strpos($str_content, 'settings');
                $link = substr($str_content, $vtri+9);
                $vtri1 = strpos($link, '"');
                $link_temp = substr($link,0, $vtri1);
            }
            //get data form URL
            $urlv = $link_temp;
            $ch = curl_init($urlv);
            curl_setopt($ch,CURLOPT_HTTPHEADER,array('Origin: http://www.maxjizztube.com'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            if (strpos($response, 'defaultVideo')) {
                $vtri = strpos($response, 'defaultVideo');
                $link = substr($response, $vtri+13);
                $vtri1 = strpos($link, ';');
                $linkUrl = substr($link,0, $vtri1);
            }

            $video_url=$url;
            if (strpos($str_content, 'overlay')) {
                $vtri = strpos($str_content, 'overlay');
                $link = substr($str_content, $vtri+8);
                $vtri1 = strpos($link, '&');
                $image = substr($link,0, $vtri1); //image url
            }
            $title=$obj_content->find('title',0)->plaintext;

            $video_duration = "08:00"; //video duration
            $get_meta = get_meta_tags($url); //meta data
            $tagsWrapper=$get_meta['keywords'];// video tag
            $description=$get_meta['description'];//video description



        }
        //www.maxjizztube.com

        if ($host == 'www.vporn.com') {
            $html_content = $this->get($url, 'http://www.vporn.com/', 'www.vporn.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('.video_panel',0)->innertext ;
            // get Url Video
            if (strpos($linkURL, 'videoUrlMedium')) {
                $vtri = strpos($linkURL, 'videoUrlMedium');
                $link = substr($linkURL, $vtri+18);
                $vtri1 = strpos($link, '"');
                $linkUrl = substr($link,0, $vtri1);
            }
            if (empty($linkUrl)) {
                $vtri = strpos($linkURL, 'videoUrlLow');
                $link = substr($linkURL, $vtri+15);
                $vtri1 = strpos($link, '"');
                $linkUrl = substr($link,0, $vtri1);
            }
            // get duration Video
            $video_duration = $obj_content->find('.info-runtime',1)->plaintext ;
            if (strpos($video_duration, 'Runtime')) {
                $vtri = strpos($video_duration, 'Runtime');
                $link = substr($video_duration, $vtri+11);
                $link = trim($link);
                $video_duration = str_replace(array('min','sec',' '), array(':','',''), $link);
            }

            // get Title
            $title = $obj_content->find('#vtitle',0)->plaintext ;
            // Tag
            $tagsWrapper = $obj_content->find('.tagas-secondrow',0)->plaintext;
            // get Image URL
            if (strpos($linkURL, 'imageUrl')) {
                $vtri = strpos($linkURL, 'imageUrl');
                $link = substr($linkURL, $vtri+12);
                $vtri1 = strpos($link, '"');
                $image = substr($link,0, $vtri1);
                $image = 'http://www.vporn.com'.$image;
            }
            // get description
            $description = $obj_content->find('.descr',0)->plaintext;
        }
        if ($host == 'www.yobt.com') {
            $html_content = $this->get($url, 'http://www.yobt.com/', 'www.yobt.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('.player',0)->innertext ;
            // var_dump($linkURL); die;
            // get Url Video
            if (strpos($linkURL, "video'   : '")) {
                $vtri = strpos($linkURL, "video'   : '");
                $link = substr($linkURL, $vtri+12);
                $vtri1 = strpos($link, "'");
                $linkUrl = substr($link,0, $vtri1);
            }
            // get duration Video
            if (strpos($linkURL, "runtime' : ")) {
                $vtri = strpos($linkURL, "runtime' : ");
                $link = substr($linkURL, $vtri+11);
                $vtri1 = strpos($link, ",");
                $video_duration = (float)substr($link,0, $vtri1);
            }
            // get Title
            $title = $obj_content->find('#post-title',0)->plaintext ;
            // Tag
            $tagsWrapper = $obj_content->find('#post-tags',0)->plaintext;
            // get Image URL
            if (strpos($linkURL, "cover'   : ")) {
                $vtri = strpos($linkURL, "cover'   : ");
                $link = substr($linkURL, $vtri+12);
                $vtri1 = strpos($link, "'");
                $image = substr($link,0, $vtri1);
            }
            // get description
            $description = '';
        }
        if ($host == 'www.youporn.com') {
            $html_content = $this->get($url, 'http://www.youporn.com/', 'www.youporn.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('#videoWrapper',0)->innertext ;
            // var_dump($linkURL); die;
            // get Url Video
            if (strpos($linkURL, "720: '")) {
                $vtri = strpos($linkURL, "720: '");
                $link = substr($linkURL, $vtri+6);
                $vtri1 = strpos($link, "'");
                // get Url Video
                $linkUrl = substr($link,0, $vtri1);
            }
            if (empty($linkUrl)) {
                if (strpos($linkURL, "480: '")) {
                    $vtri = strpos($linkURL, "480: '");
                    $link = substr($linkURL, $vtri+6);
                    $vtri1 = strpos($link, "'");
                    // get Url Video
                    $linkUrl = substr($link,0, $vtri1);
                }
                if (empty($linkUrl)) {
                    $vtri = strpos($linkURL, "240: '");
                    $link = substr($linkURL, $vtri+6);
                    $vtri1 = strpos($link, "'");
                    // get Url Video
                    $linkUrl = substr($link,0, $vtri1);
                }
            }
            $video_url=$url;
            // get duration Video
            if (strpos($linkURL, "videoDuration ")) {
                $vtri = strpos($linkURL, "videoDuration ");
                $link = substr($linkURL, $vtri+16);
                $vtri1 = strpos($link, ",");
                $video_duration = (float)substr($link,0, $vtri1);
            }
            // get Title
            if (strpos($linkURL, "videoTitle")) {
                $vtri = strpos($linkURL, "videoTitle");
                $link = substr($linkURL, $vtri+13);
                $vtri1 = strpos($link, '"');
                $title = substr($link,0, $vtri1);
            }
            // Tag
            $tagsWrapper = '';
            // get Image URL
            if (strpos($linkURL, "poster")) {
                $vtri = strpos($linkURL, "poster");
                $link = substr($linkURL, $vtri+8);
                $vtri1 = strpos($link, '"');
                $image = substr($link,0, $vtri1);
            }
            // get description
            $description = '';
        }
        if ($host == 'xhamster.com') {
            $html_content = $this->get($url, 'http://xhamster.com/', 'xhamster.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('#playerSwf',0)->innertext ;
            // get link
            $linkUrl = $obj_content->find('.noFlash a',0)->href;

            $video_url=$url;
            // get duration Video
            if (strpos($linkURL, 'duration":')) {
                $vtri = strpos($linkURL, 'duration":');
                $link = substr($linkURL, $vtri+11);
                $vtri1 = strpos($link, ",");
                $video_duration = (float)substr($link,0, $vtri1);
            }
            // get Title
            $title = $obj_content->find('#playerBox .head h1',0)->plaintext;
            // Tag
            $tagsWrapper = '';
            // get Image URL
            $image = $obj_content->find('.noFlash img',0)->src;
            // get description
            $description = '';
        }
        if ($host == 'www.xvideos.com') {
            $html_content = $this->get($url, 'http://www.xvideos.com/', 'www.xvideos.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('#player',0)->innertext ;
            // var_dump($linkURL); die;
            // get link
            if (strpos($linkURL, "flv_url")) {
                $vtri = strpos($linkURL, "flv_url");
                $link = substr($linkURL, $vtri+8);
                $vtri1 = strpos($link, "&amp;");
                $linkUrl = substr($link,0, $vtri1);
                $linkUrl = $this->change_text($linkUrl);
                // var_dump($linkUrl); die;
            }

            $video_url=$url;
            // get duration Video

            $video_duration = $obj_content->find('.duration',0)->plaintext;
            $video_duration = str_replace('-', '', trim($video_duration));
            $video_duration = strimConvertTime(trim($video_duration));

            // // get Title
            $title = $obj_content->find('title',0)->plaintext;
            // Tag
            $tag = $obj_content->find('meta[name="keywords"]',0)->outertext;
            if (strpos($tag, 'content')) {
                $de_vitri = strpos($tag, 'content');
                $dec = substr($tag, $de_vitri+9);
                $de_vitri1 = strpos($dec, '"');
                // get duration Video
                $tagsWrapper = substr($dec,0, $de_vitri1);
            }
            // get Image URL
            if (strpos($linkURL, "url_bigthumb")) {
                $vtri = strpos($linkURL, "url_bigthumb");
                $link = substr($linkURL, $vtri+13);
                $vtri1 = strpos($link, "&amp;");
                $image = substr($link,0, $vtri1);
                $image = $this->change_text($image);
            }
            // get description
            $decr = $obj_content->find('meta[name="description"]',0)->outertext;
            if (strpos($decr, 'content')) {
                $de_vitri = strpos($decr, 'content');
                $dec = substr($decr, $de_vitri+9);
                $de_vitri1 = strpos($dec, '"');
                // get duration Video
                $description = substr($dec,0, $de_vitri1);
            }
        }
        if ($host == 'www.xtube.com') {
            $html_content = $this->get($url, 'http://www.xtube.com/', 'www.xtube.com');
            $obj_content = str_get_html($html_content);
            $linkURL = $obj_content->find('#watchPageLeft',0)->innertext ;
            // var_dump($linkURL); die;
            // get link
            if (strpos($linkURL, "flashvars.video_url")) {
                $vtri = strpos($linkURL, "flashvars.video_url");
                $link = substr($linkURL, $vtri+23);
                $vtri1 = strpos($link, '"');
                $linkUrl = substr($link,0, $vtri1);
                $linkUrl = $this->change_text($linkUrl);
                // var_dump($linkUrl); die;
            }

            // get duration Video

            // $video_duration = $obj_content->find('.duration',0)->plaintext;
            if (strpos($linkURL, "video_duration")) {
                $vtri = strpos($linkURL, "video_duration");
                $link = substr($linkURL, $vtri+18);
                $vtri1 = strpos($link, '"');
                $video_duration = substr($link,0, $vtri1);
            }
            // flashvars.video_duration
            // // get Title
            $title = $obj_content->find('#videoDetails .title',0)->plaintext;

            // Tag
            $tag = $obj_content->find('#videoDetails .fields',0)->plaintext;
            $tag = trim($tag);
            $tagsWrapper = str_replace(' ', '',$tag);

            // get Image URL
            if (strpos($linkURL, "timeline_preview_url")) {
                $vtri = strpos($linkURL, "timeline_preview_url");
                $link = substr($linkURL, $vtri+29);
                $vtri1 = strpos($link, '"');
                $image = substr($link,0, $vtri1);
                $image = str_replace(array('{','}'), array('',''), $image);
            }
            // get description
            $description = $obj_content->find('#videoDetails .fieldsDesc',0)->plaintext;
        }

        $data = array(
            'link' => $linkUrl,
            'linkHD'=>isset($linkUrlHD)? $linkUrlHD :'',
            'video_url'=> isset($video_url)? $video_url:'',
            'duration' => $video_duration,
            'title' => $title,
            'tag' => $tagsWrapper,
            'image' => $image,
            'description' => $description,
        );
        // var_dump($data);die;
        return $data;
    }

    public function change_text($text)
    {
        $need = array('%2F','%3A','%3D','%3F','%26','%25');
        $replace = array('/',':','=','?','&','%');
        $text =str_replace($need, $replace, $text);
        return $text;
    }

    static function get($url, $referer = '', $host = '') {

        if ( empty($referer) ) {
            $info = pathinfo($url);
            $referer = $info['dirname'];
            $host = get_domain($referer);
        }

        $objCurl = curl_init();
        $header[0] = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection:keep-alive";
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[] = "Accept-Language:en-US,en;q=0.8,vi;q=0.6";
        $header[] = "Pragma: "; // browsers keep this blank.
        $header[] = "Host:{$host}"; // browsers keep this blank.
        $header[] = "Referer: {$referer}"; // browsers keep this blank.
        curl_setopt($objCurl, CURLOPT_URL, $url);
        curl_setopt($objCurl, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36");
        curl_setopt($objCurl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($objCurl, CURLOPT_ENCODING, 'gzip,deflate,sdch');
        curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($objCurl, CURLOPT_TIMEOUT, 10);
        curl_setopt($objCurl, CURLOPT_FOLLOWLOCATION, FALSE);

        $result = curl_exec($objCurl);
        return $result;
    }
}
