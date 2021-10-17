<?php

namespace App\Http\Controllers\admincp;
use App\Services\Modules\Modules;
use App\Models\VideoModel;
use App\Models\ChannelModel;
use App\Models\PornStarModel;
use App\Models\CategoriesModel;
use App\Models\VideoCommentModel;
use App\Models\ActivityLogModel;
use App\Models\CountReportModel;
use App\Models\VideoTextAdsModel;
use App\Models\MSGPrivateModel;
use App\Models\ConversionModel;
use App\Models\StandardAdsModel;
use App\Models\VideoAdsModel;
use App\Models\OptionModel;
use App\Models\VideoSettingModel;
use App\Models\EmailSettingModel;
use App\Models\EmailTempleteModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

/*
 * Video Setting Controller
 */
class VideoSettingController extends Controller
{
    /*
     * action get all setting
     */
    public function getSetting (){
        $get_config= VideoSettingModel::first();
        
        return view('admincp.ads.video_setting')->with('v_setting',$get_config);
    }
    
    /*
     * action post data to add setting
     */
    public function postSetting(Request $get){
        if($get){
            $data=array(
                "is_subscribe"=>$get->is_subscribe,
                "is_favorite"=>$get->is_favorite,
                "is_download"=>$get->is_download,
                "is_embed"=>$get->is_embed,
                "is_ads"=>$get->is_ads,
                "time_skip_ads"=>$get->time_skip_ads,
                "video_reload"=>$get->video_reload
            );
            $player_logo=Input::file('player_logo');

            if($player_logo){
                $extension =$player_logo->getClientOriginalExtension();

                $notAllowed = array("exe","php","asp","pl","bat","js","jsp","sh");

                $destinationPath = "".$_SERVER['DOCUMENT_ROOT']."/public/upload/player/";

                $filename = "player_logo.".$extension;

                if(!in_array($extension,$notAllowed))
                {
                     $player_logo->move($destinationPath, $filename);
                     $addchannel =VideoSettingModel::where('id','=',$get->id)->update(array('player_logo'=>$filename));
                }
            }   

            $player_loading=Input::file('player_loading');
            if($player_loading){
                $extension =$player_loading->getClientOriginalExtension();
                $notAllowed = array("exe","php","asp","pl","bat","js","jsp","sh");
                $destinationPath = "".$_SERVER['DOCUMENT_ROOT']."/public/upload/player/";
                $filename = "player_loading.".$extension;

                if(!in_array($extension,$notAllowed))
                {
                    $player_loading->move($destinationPath, $filename);
                    $addchannel =VideoSettingModel::where('id','=',$get->id)->update(array('player_loading'=>$filename));
                }
            } 
            $update_settiing=  VideoSettingModel::where('id','=',$get->id)->update($data);
            
            if($update_settiing){
                return redirect('admincp/video-setting')->with('msg','Update setting successfully!');
            }else{
                return redirect('admincp/video-setting')->with('msgerror','Update setting not complete!');
            }
        }
    } 

    /*
     * action get player media advertise
     */
    public function getInPlayerMediaAds(){
        
        return view('admincp.ads.add_video_ads')->with('title_pornstar','Manage Video Ads ');
    }
    
    /*
     * action post data to add player media advertise
     */
    public function postInPlayerMediaAds(Request $get) {
        if($get){
            $sting_name=str_random(10);
            $title= $get->title;
            $descr= $get->descr;
            $adv_url= $get->adv_url;
            $status= $get->status;
            $media=Input::file('media');
            
            if($media){
                $extension =$media->getClientOriginalExtension();
                $notAllowed = array("exe","php","asp","pl","bat","js","jsp","sh","docx","doc","pdf","xls","xlsx");
                $destinationPath = "".$_SERVER['DOCUMENT_ROOT']."/public/upload/ads/";
                $filename = "".$sting_name.".".$extension;

                if(!in_array($extension,$notAllowed))
                {
                    $media->move($destinationPath, $filename);
                    $add= new VideoAdsModel();
                    $add->title=$title;
                    $add->string_id=$sting_name;
                    $add->descr=$descr;
                    $add->adv_url=$adv_url;
                    $add->status=$status;
                    $add->media=$filename;
                    if($add->save()){
                        //create xml
                        $dom = new \DOMDocument('1.0','UTF-8');
                        //VAST tag
                        $avst = $dom->createElement('VAST');
                        $dom->appendChild($avst);
                        $avst->setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
                        $avst->setAttribute('version','3.0');
                        $avst->setAttribute('xsi:noNamespaceSchemaLocation','vast3_draft.xsd');
                        //Ad tag
                        $ad = $dom->createElement('Ad');
                        $avst->appendChild($ad);
                        $ad->setAttribute('id','preroll-1');
                        $ad->setAttribute('sequence','1');
                        //InLine
                        $inline=$dom->createElement('InLine');
                        $ad->appendChild($inline);
                        $AdSystem=$dom->createElement('AdSystem');
                        $inline->appendChild($AdSystem);
                        $AdSystem->setAttribute('version','2.0');
                        $AdSystem->appendChild($dom->createTextNode('Adult Streaming Website'));

                        $AdTitle=$dom->createElement('AdTitle');
                        $inline->appendChild($AdTitle);
                        $AdTitle->appendChild($dom->createTextNode('In player Ads'));

                        $Impression=$dom->createElement('Impression');
                        $inline->appendChild($Impression);
                        $Impression->appendChild($dom->createTextNode('http://demo.jwplayer.com/static-tag/pixel.gif'));

                        $Creatives=$dom->createElement('Creatives');
                        $inline->appendChild($Creatives);

                        $Creative=$dom->createElement('Creative');
                        $Creatives->appendChild($Creative);
                        $Creative->setAttribute('sequence','1');

                        $Linear =$dom->createElement('Linear');
                        $Creative->appendChild($Linear);

                        $Duration =$dom->createElement('Duration');
                        $Linear->appendChild($Duration);
                        $Duration->appendChild($dom->createTextNode('00:30:00'));

                        $TrackingEvents=$dom->createElement('TrackingEvents');
                        $Linear->appendChild($TrackingEvents);
                        //loop Tracking
                        $Tracking =$dom->createElement('Tracking');
                        $TrackingEvents->appendChild($Tracking);
                        $Tracking->setAttribute('event','start');
                        $Tracking->appendChild($dom->createTextNode('http://demo.jwplayer.com/static-tag/pixel.gif'));
                        // end loop
                        $VideoClicks =$dom->createElement('VideoClicks');
                        $Linear->appendChild($VideoClicks);

                        $ClickThrough=$dom->createElement('ClickThrough');
                        $VideoClicks->appendChild($ClickThrough);
                        $ClickThrough->appendChild($dom->createTextNode(''.$adv_url.''));

                        $ClickTracking=$dom->createElement('ClickTracking');
                        $VideoClicks->appendChild($ClickTracking);
                        $ClickTracking->appendChild($dom->createTextNode('http://demo.jwplayer.com/static-tag/pixel.gif'));

                        $MediaFiles=$dom->createElement('MediaFiles');
                        $Linear->appendChild($MediaFiles);

                        $MediaFile=$dom->createElement('MediaFile');
                        $MediaFiles->appendChild($MediaFile);
                        $MediaFile->setAttribute('id','1');
                        $MediaFile->setAttribute('delivery','progressive');
                        $MediaFile->setAttribute('type','video/mp4ss');
                        $MediaFile->setAttribute('bitrate','400');
                        $MediaFile->setAttribute('width','640');
                        $MediaFile->setAttribute('height','360');
                        $MediaFile->appendChild($dom->createTextNode(''.URL().'/public/upload/ads/'.$filename.''));
                        $savefile =file_put_contents(''.$_SERVER['DOCUMENT_ROOT'].'/public/upload/ads/'.$sting_name.'.xml', $dom->saveXML());
                        //create xml
                        if($savefile){
                            return redirect('admincp/in-player-media-ads')->with('msg','Add successfully!');
                        } 
                    }
                }else{
                    return redirect('admincp/in-player-media-ads')->with('msgerror','File is not allowed!');
                }
            }
        }
    }

    /*
     * action get video advertise
     */
    public function getVideoAds(){
        $getads= VideoAdsModel::get();
        
        return view('admincp.ads.video_ads_list')->with('videoAds',$getads);
    }
    
    /*
     * action get form to ađd video advertise
     */
    public function getAddVideoAds(){
         $get_video_all = VideoModel::where('status','=',1)->Orderby('total_view','DESC')->get();
        return view('admincp.ads.add_video_ads')->with('video',$get_video_all)->with('title_pornstar','Manage Video Ads ');
    }

    /*
     * action get form to update video advertise
     */
    public function getEditVideoAds($id){
        if($id!=NULL && $id!=""){
            $get_video_all = VideoModel::where('status','=',1)->Orderby('total_view','DESC')->get();
            $checkAds= VideoAdsModel::where('ID','=',$id)->first();
            if($checkAds!=NULL){
                return view('admincp.ads.edit_video_ads')->with('editvideoads',$checkAds)->with('video',$get_video_all)->with('title_pornstar','Manage Video Ads ');
            }else{
                return redirect('admincp/ads-video')->with('msg-error','Ads not found !');
            }
        }else{
            return redirect('admincp/ads-video')->with('msg-error','Ads not found !');
        }
    }
    
    /*
     * action post data to update video advertise
     */
    public function postEditVideoAds(Request $get,$id){
        if($get){
            $string=$get->string_id;
            $data=array(
                'title'=>$get->title,
                'descr'=>$get->descr,
                'adv_url'=>$get->adv_url,
                'string_id'=>$get->string_id,
                'status'=>$get->status
            );
            $media=Input::file('media');
            if($media){
                $extension =$media->getClientOriginalExtension();

                $notAllowed = array("exe","php","asp","pl","bat","js","jsp","sh","docx","doc","pdf","xls","xlsx");

                $destinationPath = "".$_SERVER['DOCUMENT_ROOT']."/public/upload/ads/";

                $filename = "".$string.".".$extension;

                if(!in_array($extension,$notAllowed))
                {
                    $media->move($destinationPath, $filename);
                    $update_media= VideoAdsModel::where('id','=',$id)->update(array('media'=>$filename));
                    if($update_media){
                    //create xml
                        $dom = new \DOMDocument('1.0','UTF-8');
                        //VAST tag
                        $avst = $dom->createElement('VAST');
                        $dom->appendChild($avst);
                        $avst->setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
                        $avst->setAttribute('version','3.0');
                        $avst->setAttribute('xsi:noNamespaceSchemaLocation','vast3_draft.xsd');
                        //Ad tag
                        $ad = $dom->createElement('Ad');
                        $avst->appendChild($ad);
                        $ad->setAttribute('id','preroll-1');
                        $ad->setAttribute('sequence','1');
                        //InLine
                        $inline=$dom->createElement('InLine');
                        $ad->appendChild($inline);
                        $AdSystem=$dom->createElement('AdSystem');
                        $inline->appendChild($AdSystem);
                        $AdSystem->setAttribute('version','2.0');
                        $AdSystem->appendChild($dom->createTextNode('Adult Streaming Website'));

                        $AdTitle=$dom->createElement('AdTitle');
                        $inline->appendChild($AdTitle);
                        $AdTitle->appendChild($dom->createTextNode('In player Ads'));

                        $Impression=$dom->createElement('Impression');
                        $inline->appendChild($Impression);
                        $Impression->appendChild($dom->createTextNode('http://demo.jwplayer.com/static-tag/pixel.gif'));

                        $Creatives=$dom->createElement('Creatives');
                        $inline->appendChild($Creatives);

                        $Creative=$dom->createElement('Creative');
                        $Creatives->appendChild($Creative);
                        $Creative->setAttribute('sequence','1');

                        $Linear =$dom->createElement('Linear');
                        $Creative->appendChild($Linear);

                        $Duration =$dom->createElement('Duration');
                        $Linear->appendChild($Duration);
                        $Duration->appendChild($dom->createTextNode('00:30:00'));

                        $TrackingEvents=$dom->createElement('TrackingEvents');
                        $Linear->appendChild($TrackingEvents);
                        //loop Tracking
                        $Tracking =$dom->createElement('Tracking');
                        $TrackingEvents->appendChild($Tracking);
                        $Tracking->setAttribute('event','start');
                        $Tracking->appendChild($dom->createTextNode('http://demo.jwplayer.com/static-tag/pixel.gif'));
                        // end loop
                        $VideoClicks =$dom->createElement('VideoClicks');
                        $Linear->appendChild($VideoClicks);

                        $ClickThrough=$dom->createElement('ClickThrough');
                        $VideoClicks->appendChild($ClickThrough);
                        $ClickThrough->appendChild($dom->createTextNode(''.$get->adv_url.''));

                        $ClickTracking=$dom->createElement('ClickTracking');
                        $VideoClicks->appendChild($ClickTracking);
                        $ClickTracking->appendChild($dom->createTextNode('http://demo.jwplayer.com/static-tag/pixel.gif'));

                        $MediaFiles=$dom->createElement('MediaFiles');
                        $Linear->appendChild($MediaFiles);

                        $MediaFile=$dom->createElement('MediaFile');
                        $MediaFiles->appendChild($MediaFile);
                        $MediaFile->setAttribute('id','1');
                        $MediaFile->setAttribute('delivery','progressive');
                        $MediaFile->setAttribute('type','video/mp4ss');
                        $MediaFile->setAttribute('bitrate','400');
                        $MediaFile->setAttribute('width','640');
                        $MediaFile->setAttribute('height','360');
                        $MediaFile->appendChild($dom->createTextNode(''.URL().'/public/upload/ads/'.$filename.''));
                        $savefile =file_put_contents(''.$_SERVER['DOCUMENT_ROOT'].'/public/upload/ads/'.$string.'.xml', $dom->saveXML());
                    }
                }else{
                    return redirect('edit_in-player-media-ads/'.$id.'')->with('msgerror','File is not allowed!');
                } 
            }

            $update_field= VideoAdsModel::where('id','=',$id)->update($data);
            if($update_field){
                 return redirect('admincp/ads-video')->with('msg','Add successfully!');
            }
        }
    }
    
    /*
     * action delete video advertise
     */
    public function delVideoAds($id){
        if($id!=NULL or $id!= ""){
            $checkAds= VideoAdsModel::where('ID','=',$id)->first();
            if($checkAds!=NULL){
                           $del_xml=unlink(''.$_SERVER['DOCUMENT_ROOT'].'/public/upload/ads/'.$checkAds->string_id.'.xml');
                           $del_media=unlink(''.$_SERVER['DOCUMENT_ROOT'].'/public/upload/ads/'.$checkAds->media.'')  ;
                           if($del_xml && $del_media){
                                $deleteAds= VideoAdsModel::where('ID','=',$id)->delete(); 
                               if($deleteAds){

                                    return redirect('admincp/ads-video')->with('msg-success','Delete Ads successfuly');
                               }
                           }else{
                                return redirect('admincp/ads-video')->with('msg-error','Ads  not found !');
                           }
                               
            }else{

                return redirect('admincp/ads-video')->with('msg-error','Ads  not found !');
            }
        }else{
            return redirect('admincp/ads-video')->with('msg-error','Ads  not found !');
        }
    }


    /*
     * action get text advertise
     */
    public function getTextAds(){
        $getads= VideoTextAdsModel::Orderby('status','DESC')->get();
        return view('admincp.ads.text_list')->with('textAds',$getads);
    }

    /*
     * action get form to add text advertise
     */
    public function getAddTextAds(){
        $get_video_all = VideoModel::where('status','=',1)->Orderby('total_view','DESC')->get();
        return view('admincp.ads.add_textads')->with('video',$get_video_all)->with('title_pornstar','Manage Text Ads ');
    }
    
    /*
     * action post data to add text advertise
     */
    public function postAddTextAds(Request $get){
        if($get){
            $addAds= new VideoTextAdsModel();
            $addAds->ads_title=$get->ads_title;
            $addAds->ads_content= $get->ads_content;
            $addAds->return_url=$get->return_url;
            $addAds->status=$get->status;
            if($addAds->save()){
                return redirect('admincp/ads-text-video')->with('msg-success','Add Ads successfuly !');
            }
        }
    }

    /*
     * action get data to update text advertise
     */
    public function getEditTextAds($id){
        if($id != NULL){
            $check= VideoTextAdsModel::where('ID','=',$id)->first();
            $get_video_all = VideoModel::where('status','=',1)->Orderby('total_view','DESC')->get();
            if($check!=NULL){
                return view('admincp.ads.edit_textads')->with('editads',$check)->with('video',$get_video_all)->with('title_pornstar','Manage Text Ads');
            }else{
                return redirect('admincp/ads-text-video')->with('msg-error','Ads Not Found !');
            }
        }
    }

    /*
     * action post data to update text advertise
     */
    public function postEditTextAds(Request $get,$id){
        if($id !=NULL && $get!=null){
            $data=array(
                "ads_title"=>$get->ads_title,
                "ads_content"=> $get->ads_content,
                "return_url"=>$get->return_url,
                "status"=>$get->status
            );
            $getupdate= VideoTextAdsModel::where('ID','=',$id)->update($data);
            if($getupdate){
                return redirect('admincp/ads-text-video')->with('msg-success','Update successfuly !');
            }else{
                return redirect('edit-video-text-ads&is='.$id.'')->with('msg-error','Update not successfuly.Please try again !');
            }
        }
    }

    /*
     * action delete text advertise
     */
    public function delTextAds($id){
        if($id!=NULL){
            $check= VideoTextAdsModel::where('ID','=',$id)->first();
            if($check!=NULL){
                $delAds=  VideoTextAdsModel::where('ID','=',$id)->delete();
                if($delAds){
                    return redirect('admincp/ads-text-video')->with('msg-success','Delete Ads successfuly !');
                }else{
                    return redirect('admincp/ads-text-video')->with('msg-error','Delete Ads not successfuly !');  
                }
            }else{
                return redirect('admincp/ads-text-video')->with('msg-error','Ads not found !');
            }
        }
    }
    
    /*
     * action get email template
     */
    public function getEmailTemplete(){
        $get_list =EmailTempleteModel::get();
        return view('admincp.mail.email_list')->with('email_temp',$get_list);
                                             
    }
    
    /*
     * action get form to add email template
     */
    public function getAddEmailTemplete(){
        return view('admincp.mail.add_email_templete')
                ->with('firstname','{{$firstname}}')
                ->with('lastname','{{$lastname}}')
                ->with('site_name','{{$site_name}}')
                ->with('site_email','{{$site_email}}')
                ->with('site_phone','{{$site_phone}}')
                ->with('channel_name','{{$channel_name}}')
                ->with('newpassword','{{$newpassword}}')
                ->with('token','{{$token}}')
                ->with('email','{{$email}}')
                ->with('content','{{$content}}');

    }
    
    /*
     * action post data to add email template
     */
    public function postAddEmailTemplete(Request $get){
        if($get){
            $name=$get->name;
            $name_slug=str_slug($get->name,'_');
            $description=$get->description;
            $content=$get->content;
            $status=1;
            $add_temp=new EmailTempleteModel();
            $add_temp->name=$name;
            $add_temp->description=$description;
            $add_temp->content=$content;
            $add_temp->name_slug=$name_slug;
            $add_temp->status=$status;
            if($add_temp->save()){
                $email_templete_file = fopen("".$_SERVER['DOCUMENT_ROOT']."/resources/views/admincp/mail/" .
                        $name_slug.".blade.php", "w") or die("Unable to open file!");
                $html = ($content);
                fwrite($email_templete_file, $html);
                fclose($email_templete_file); 
                return redirect('admincp/email-templete')->with('msg','Email templete add successfully!');
            }else{
                return redirect('admincp/email-templete')->with('msgerror','Insert not complete!')->with('data',$get);
            }
        }
    }

    /*
     * action get data to update email template
     */
    public function getEditEmailTemplete($id){
        if($id!=NULL){
            $check= EmailTempleteModel::where('id','=',$id)->first();
            if($check!=NULL){
                return view('admincp.mail.edit_email_templete')
                        ->with('edit_temp',$check)->with('firstname','{{$firstname}}')
                        ->with('lastname','{{$lastname}}')
                        ->with('site_name','{{$site_name}}')
                        ->with('site_email','{{$site_email}}')
                        ->with('site_phone','{{$site_phone}}')
                        ->with('channel_name','{{$channel_name}}')
                        ->with('newpassword','{{$newpassword}}')
                        ->with('token','{{$token}}')
                        ->with('email','{{$email}}')
                        ->with('content','{{$content}}')
                        ->with('title_pornstar','Email Templates');
            }else{
                return redirect('admincp/email-templete')->with('msgerror','Request not fount');
            }
        }else{
            return redirect('admincp/email-templete')->with('msgerror','Request not fount');
        }
    }

    /*
     * action post data to update email template
     */
    public function postEditEmailTemplete(Request $get,$id){
        if($get){
            if($id!=NULL){
                $name_slug=$get->name_slug;
                $content=$get->content;
                $data=array(
                    'name'=>$get->name,
                    'name_slug'=>str_slug($get->name,'_'),
                    'description'=>$get->description,
                    'content'=>$get->content,
                    'status'=>1,
                );
                $update_temp=EmailTempleteModel::where('id','=',$id)->update($data);
                if($update_temp){
                    $email_templete_file = fopen("".$_SERVER['DOCUMENT_ROOT']."/resources/views/admincp/mail/".$name_slug.".blade.php", "w") or die("Unable to open file!");
                    $html = ($content);
                    fwrite($email_templete_file, $html);
                    fclose($email_templete_file); 
                    return redirect('admincp/email-templete')->with('msg','Email templete update successfully!');
                }else{
                    return redirect('admincp/edit-email-templete&id='.$id.'')->with('msgerror','Update not complete.');
                }
            }else{
                return redirect('admincp/email-templete')->with('msgerror','Request not fount');
            }
        }else{
            return redirect('admincp/email-templete')->with('msgerror','Request not fount');
        }
    }

    /*
     * action delete email template
     */
    public function getDelEmailTemplete($id){
        if($id!=NULL){
            $check=EmailTempleteModel::where('id','=',$id)->first();
            if($check!=NULL){
                $delete_temp=EmailTempleteModel::where('id','=',$id)->delete();
                if($delete_temp){
                    unlink("".$_SERVER['DOCUMENT_ROOT']."/resources/views/admincp/mail/".$check->name_slug.".blade.php");
                   return redirect('admincp/email-templete')->with('msg','Email templete delete successfully!');
                }
            }else{
                return redirect('admincp/email-templete')->with('msgerror','Request not fount!');
            }
        }
    }

    /*
     * action get email setting
     */
    public function  getEmailSetting(){
        $get_email_setting =EmailSettingModel::first();
        $list_temp= EmailTempleteModel::get();
        
        return view('admincp.mail.email_setting')->with('temp',$list_temp)->with('email_setting',$get_email_setting) ;
    }
    
    /*
     * action post email setting
     */
    public function postEmailSetting(Request $get){
        if($get){
            $data=array(
                "registration_email"=>$get->registration_email,
                "admin_forgot_password_email"=>$get->admin_forgot_password_email,
                "member_forgot_password_email"=>$get->member_forgot_password_email,
                "channel_subscriber_email"=>$get->channel_subscriber_email,
                "channel_register_email"=>$get->channel_register_email,
                "reply_comment_email"=>$get->reply_comment_email,
            );
            $update= EmailSettingModel::where('id','=',$get->id)->update($data);
            if($update){
                return redirect('admincp/email-setting')->with('msg','Update successfully !');
            }else{
                return redirect('admincp/email-setting')->with('msgerror','Update not complete !');
            }
            
        }
    }
}
