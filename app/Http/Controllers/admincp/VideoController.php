<?php

namespace App\Http\Controllers\admincp;
use App\Services\Modules\Modules;
use App\Models\VideoModel;
use App\Models\ChannelModel;
use App\Models\PornStarModel;
use App\Models\CategoriesModel;
use App\Models\VideoCommentModel;
use App\Models\CountReportModel;
use App\Models\MSGPrivateModel;
use App\Models\ConversionModel;
use App\Models\StandardAdsModel;
use App\Models\VideoCatModel;
use App\Models\OptionModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/*
 * Video Controller
 */
class VideoController extends Controller
{
    /*
     * action get all video to show list
     */
    public function getVideo() {
        $video = VideoModel::select('video.*','channel.title_name as title_channel','pornstar.title_name as title_porn')
            ->leftJoin('channel','channel.ID','=','video.channel_Id')
            ->leftJoin('pornstar','pornstar.ID','=','video.pornstar_Id')
            ->orderBy('video.created_at','DESC')
            ->get();

        if($video) {
            return view('admincp.video.index')->with('video', $video);
        }
    }
    
    /*
     * action form to add video
     */
    public function getAddVideo() {
        $categories = CategoriesModel::where('status','=','1')
                ->orderBy('created_at','ASC')
                ->get();
        $channel = ChannelModel::where('status','=','1')
                ->orderBy('created_at','ASC')
                ->get();
        $pornstar = PornStarModel::where('status','=','1')
                ->orderBy('created_at','ASC')
                ->get();

        if($channel && $categories) {
            return view('admincp.video.upload')
                    ->with('categories',$categories)
                    ->with('channel',$channel)
                    ->with('pornstar',$pornstar);
        }
    }
    
    /*
     * action post data to add video
     */
    public function postAddVideo(Request $request){
        if($request->post_result_cat!=NULL){
            $tostring= implode(',', $request->post_result_cat);

            $cat_post = cat_array($tostring);
            
            for ($i=0; $i <count($cat_post) ; $i++) {
                $videocat = new VideoCatModel();
                $videocat->video_id=$request->string_id;
                $videocat->cat_id=$cat_post[$i];
                $videocat->save();
            }
        }

        $addvideo = new VideoModel();
        $conversion_config= ConversionModel::get_config();

        $date=date('Y-m-d');
        $folder="".$_SERVER['DOCUMENT_ROOT'].getPath()."/videos/".$date."";
        if(!is_dir($folder)){
            $folder = mkdir("".$_SERVER['DOCUMENT_ROOT'].getPath()."/videos/" . $date , 0777, true);
            $upload_folder = "".$_SERVER['DOCUMENT_ROOT'].getPath()."/videos/".$date."";
        }else{
            $upload_folder = "".$_SERVER['DOCUMENT_ROOT'].getPath()."/videos/".$date."";
        }

        $string=$request->string_id;
        $addvideo ->string_Id = $string;
        $addvideo ->title_name = $request->title_name;
        $addvideo ->post_name = str_slug($request->title_name,"-");
        $addvideo ->categories_Id = isset($tostring)? $tostring :'' ;
        $addvideo ->cat_id = isset($tostring)? cat_form_array($tostring):'';
        $addvideo ->description = $request->description;
        $addvideo ->status= $request->status;
        $addvideo ->tag = $request->tag;
        if($request->fileupload!=NULL){
            $file_info= $request->fileupload;
            $extend= explode(".", $file_info);
            $get_extend= end($extend);
            $stringOut =mt_rand();

            $addvideo->video_type= $get_extend;
            $filename = "".$string.".".$get_extend;
            $filenameOut = "".$stringOut.".".$get_extend;
            $filename_sd="".$string."_SD.".$get_extend;
            $filename_conver="".$string.".".$get_extend."";
            $video_path_input = "".$upload_folder.'/'.$filename."";
            $video_path_output= "".$upload_folder.'/'.$filenameOut."";
            $stringOutWatermark = mt_rand();
            $filenameOutWatermark = "".$stringOutWatermark.".".$get_extend;
            $video_path_output_with_watermark= "".$upload_folder."/".$filenameOutWatermark."";
            $video_path_output_sd="".$upload_folder."/".$filename_sd."";
            $array_extend=explode(',',$conversion_config->allowed_extension);
            $ffprobe_path = str_replace('ffmpeg', 'ffprobe', $conversion_config->ffmpeg_path);

            if(in_array($get_extend,$array_extend)){
                $conver_in_array= $conversion_config->ffmpeg_path.' -i '.$video_path_input.' -c:v libx264 '.$video_path_output;
                
                $processConvert = new Process($conver_in_array);
                $processConvert->setTimeout(7200);
                $processConvert->run();
                if ($processConvert->isSuccessful()) {
                    $addvideo ->video_src="".URL('/videos/'.$date.'')."/".$filenameOut."";
                }

                $tumbnailfile="".$string.".jpg";
                $thumbnail ="".$upload_folder."/".$string.".jpg";

                $conver_thumb= $conversion_config->ffmpeg_path." -i ".$video_path_output." -deinterlace -an -ss 5 -f mjpeg -t 1 -r 1 -y -s 640x360 ".$thumbnail." 2>&1";
                $get_duration= $ffprobe_path." -v quiet -of csv=p=0 -show_entries format=duration ".$video_path_output;
                $convert_sd= $conversion_config->ffmpeg_path." -i ".$video_path_output." -s 640x360 ".$video_path_output_sd;

                $processConvertSD = new Process($convert_sd);
                $processConvertSD->setTimeout(7200);
                $processConvertSD->run();
                if ($processConvertSD->isSuccessful()) {
                    $addvideo->video_sd = "".URL('/videos/'.$date.'')."/".$filename_sd."";
                }

                $processConvertThumb = new Process($conver_thumb);
                $processConvertThumb->setTimeout(7200);
                $processConvertThumb->run();
                if ($processConvertThumb->isSuccessful()) {
                    $addvideo->poster = "".URL('/videos/'.$date.'')."/".$tumbnailfile."";
                }
                
                $processConvertDuration = new Process($get_duration);
                $processConvertDuration->setTimeout(7200);
                $processConvertDuration->run();
                if ($processConvertDuration->isSuccessful()) {
                   $addvideo->duration = $processConvertDuration->getOutput();
                }

            }else{
                $conver_in_array= $conversion_config->ffmpeg_path.' -i '.$video_path_input.' -c:v libx264 '.$video_path_output;
                
                $processConvert = new Process($conver_in_array);
                $processConvert->setTimeout(7200);
                $processConvert->run();
                if ($processConvert->isSuccessful()) {
                    $addvideo->video_src = "".URL('/videos/'.$date.'')."/".$filenameOut."";
                }

                $tumbnailfile = "".$string.".jpg";
                $thumbnail = "".$upload_folder."/".$string.".jpg";

                $conver_thumb= $conversion_config->ffmpeg_path." -i ".$video_path_output." -deinterlace -an -ss 5 -f mjpeg -t 1 -r 1 -y -s 640x360 ".$thumbnail." 2>&1";
                $get_duration= $ffprobe_path." -v quiet -of csv=p=0 -show_entries format=duration ".$video_path_output;
                $convert_sd= $conversion_config->ffmpeg_path." -i ".$video_path_output." -s 640x360 ".$video_path_output_sd;
                
                $processConvertSD = new Process($convert_sd);
                $processConvertSD->setTimeout(7200);
                $processConvertSD->run();
                if ($processConvertSD->isSuccessful()) {
                    $addvideo->video_sd="".URL('/videos/'.$date.'')."/".$filename_sd."";
                }

                $processConvertThumb = new Process($conver_thumb);
                $processConvertThumb->setTimeout(7200);
                $processConvertThumb->run();
                if ($processConvertThumb->isSuccessful()) {
                    $addvideo->poster = "".URL('/videos/'.$date.'')."/".$tumbnailfile."";
                }
                
                $processConvertDuration = new Process($get_duration);
                $processConvertDuration->setTimeout(7200);
                $processConvertDuration->run();
                if ($processConvertDuration->isSuccessful()) {
                    $addvideo->duration=$get_duration;
                }
            }
        }
        
        if($addvideo->save()){
            return redirect('admincp/video')->with('msg', 'Update video successfully!');
        }

    }

    /*
     * action get video info
     */
    public function getVideoInfo($input){
        $conversion_config= ConversionModel::get_config();
        $cmd=shell_exec("".$conversion_config->mediainfo_path." ".$input."");
        var_dump(json_encode($cmd));
    }

    /*
     * action get gif video thump 
     */
    public function get_video_thumb_gif($input_video,$string){

        $conversion_config= ConversionModel::get_config();
        $date=date('Y-m-d');
        $folder="".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/thumb/".$date."";
        if(!is_dir($folder)){
            $folder = mkdir("".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/thumb/" . $date , 0777, true);
            $upload_folder_thum = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/thumb/".$date."/";
        }else{
            $upload_folder_thum = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/thumb/".$date."/";
        }
        $path_out_thumb= "".$upload_folder_thum."/".$string."_";
        shell_exec("".$conversion_config->ffmpeg_path." -i ".$input_video." -vf fps=1/60 ".$path_out_thumb."%d.jpg");
    }

    /*
     * action delete video
     */
    public function getDeleteVideo($string_Id){
        $get = VideoModel::where('string_Id','=',$string_Id)->first();
            if($get!=NULL){
                $getvideo = VideoModel::where('string_Id','=',$string_Id)->delete();
                
                if($getvideo){
                    $deleteCat = VideoCatModel::where('video_id','=', $string_Id);
                    
                    if($deleteCat->count() >0){
                        $deleteCat->delete();
                    }
                    
                    return redirect('admincp/video')->with('msg','Delete video successfully!');;
                }else{
                    return redirect('admincp/video')->with('msgerror','Request not found !');
                }
            }else{
                return redirect('admincp/video')->with('msgerror','Request not found !');
            }
    }
    
    /*
     * action get info video to update
     */
    public function getEditVideo($string_Id){
        $getvideo = VideoModel::where('string_Id','=',$string_Id)->first();
        
        $categories = CategoriesModel::where('status','=','1')
                ->orderBy('created_at','ASC')
                ->get();
        $channel = ChannelModel::where('status','=','1')
                ->orderBy('created_at','ASC')
                ->get();
        $pornstar = PornStarModel::where('status','=','1')
                ->orderBy('created_at','ASC')
                ->get();

        if($getvideo && $categories && $channel){
            return view('admincp.video.edit')
                    ->with('getvideo',$getvideo)
                    ->with('categories',$categories)
                    ->with('channel',$channel)
                    ->with('pornstar',$pornstar)
                    ->with('title_pornstar','Manage Existing Videos');
        }
    }
    
    /*
     * action post data to update video
     */
    public function postEditVideo(Request $get ,$string_Id){
        $conversion_config= ConversionModel::get_config();
        $tostring= implode(',', $get->post_result_cat);
        $updatevideo =VideoModel::where('string_Id','=',$string_Id)->update(array(
                'title_name' => $get->title_name,
                'post_name'  => str_slug($get->title_name,"-"),
                'description' =>$get->description,
                'tag' =>$get->tag,
                'status' =>$get->status,
                'categories_Id' =>$tostring,
                'cat_id'=> cat_form_array($tostring),
        ));
        $check_video_cat = VideoCatModel::where('video_id','=',$string_Id)->count();
        if($check_video_cat>0){
            $delete_video_cal= VideoCatModel::where('video_id','=',$string_Id)->delete();

            $cat_post = cat_array($tostring);
            for ($i=0; $i <count($cat_post) ; $i++) {
                $videocat = new VideoCatModel();
                $videocat->video_id=$string_Id;
                $videocat->cat_id=$cat_post[$i];
                $videocat->save();
            }
        }else{
            $cat_post = cat_array($tostring);
            for ($i=0; $i <count($cat_post) ; $i++) {
                $videocat = new VideoCatModel();
                $videocat->video_id=$string_Id;
                $videocat->cat_id=$cat_post[$i];
                $videocat->save();
            }
        }

        if($get->fileupload!=NULL){
            $file_info=$get->fileupload;
            $extend=explode('.',$file_info);
            $get_extend=end($get_extend);
            $get_video= VideoModel::where('string_id','=',$sting_Id)->first();
            $get_path_date=date_format('Y-m-d',$get_video->created_at);
            //convert
            $upload_folder = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/".$get_path_date."";
            $filename = "".$string_Id.".".$get_extend;
            $filename_conver="".$string_Id.".".$get_extend."";
            $video_path_input = "".$upload_folder."/".$filename."";
            $video_path_output= "".$upload_folder."/".$filename."";
            $array_extend=array(''.$conversion_config->allowed_extension.'');
            $ffprobe_path = str_replace('ffmpeg', 'ffprobe', $conversion_config->ffmpeg_path);
            if(in_array($get_extend,$array_extend)){
                //conver all to mp4
                $conver_in_array= shell_exec(''.$conversion_config->ffmpeg_path.' -i '.$video_path_input.' -c:v libx264 '.$video_path_output.'');
                if($conver_in_array){
                    $tumbnailfile="".$string_Id.".jpg";
                    $thumbnail ="".$upload_folder."/".$string_Id.".jpg";

                    $conver_thumb= shell_exec("".$conversion_config->ffmpeg_path." -i ".$video_path_output." -deinterlace -an -ss 5 -f mjpeg -t 1 -r 1 -y -s 640x360 ".$thumbnail." 2>&1");
                    $get_duration= shell_exec($ffprobe_path." -v quiet -of csv=p=0 -show_entries format=duration ".$video_path_output."");
                    if($conver_thumb && $get_duration){
                        $update_option = VideoModel::where('string_Id','=',$string_Id)
                                ->update(array(
                                    "video_src"=>"".URL('/videos/'.$get_path_date.'')."/".$filename_conver."",
                                    "duration"=>$get_duration,
                                    "poster"=>"".URL('/videos/'.$get_path_date.'')."/".$tumbnailfile."",
                                    "video_type"=>$get_extend
                                ));
                    }
                }
            }else{
                $tumbnailfile="".$string_Id.".jpg";
                $thumbnail ="".$upload_folder."/".$string_Id.".jpg";

                $conver_thumb = shell_exec("".$conversion_config->ffmpeg_path." -i ".$video_path_input." -deinterlace -an -ss 5 -f mjpeg -t 1 -r 1 -y -s 640x360 ".$thumbnail." 2>&1");
                $get_duration = shell_exec($ffprobe_path." -v quiet -of csv=p=0 -show_entries format=duration ".$video_path_input."");
                if($conver_thumb && $get_duration){
                    $update_option=VideoModel::where('string_Id','=',$string_Id)
                            ->update(array(
                                "video_src"=>"".URL('/videos/'.$get_path_date.'')."/".$filename."",
                                "duration"=>$get_duration,
                                "poster"=>"".URL('/videos/'.$get_path_date.'')."/".$tumbnailfile."",
                                "video_type"=>$get_extend
                            ));

                }
            }
        }

        if($updatevideo){
            return redirect('admincp/video')->with('msg','Update video successfully!');
        }else{
           return redirect('admincp/edit-video')->with('msgerror','Update video not complete!');
        }
    }

    public function sec2hms($sec, $padHours = false)
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

    /*
     * action get all coment
     */
    public function getComment(){
        $get_comment = VideoCommentModel::select('video_comment.*','members.username','video.string_Id','video.poster','video.title_name')
                ->join('video','video.string_Id','=','video_comment.video_Id')
                ->join('members','members.user_id','=','video_comment.member_Id')
                ->get();
        
        if(count($get_comment)>0){
            return view('admincp.comment.videocomment')->with('comment',$get_comment);
        }else{
            return view('admincp.comment.videocomment')->with('msg',' No comment for all video');
        }
    }
    
    /*
     * action delete comment
     */
    public function getDeleteComment($id){
        VideoCommentModel::where('ID','=',$id)->delete();
        
        return redirect('admincp/video-comment')
                ->with('msg-success','Delete comment successfully !');
    }
    
    /*
     * action get info to update comment
     */
    public function getEditComment($id) {

        $edit = VideoCommentModel::select('video_comment.*', 'members.username', 'video.string_Id', 'video.poster', 'video.title_name')
                ->join('video', 'video.string_Id', '=', 'video_comment.video_Id')
                ->join('members', 'members.user_id', '=', 'video_comment.member_Id')
                ->where('video_comment.ID','=',$id)
                ->first();
        return view('admincp.comment.editcomment')
                ->with('edit', $edit)
                ->with('porn_name','Manage Video Comments ');
    }
    
    /*
     * action post data to update comment
     */
    public function post_edit_comment($id){
        if($id !=NULL){
            $data=array(
                "post_comment"=>$_POST['post_comment'],
            );
            
            $getupdate = VideoCommentModel::where('ID','=',$id)->update($data);
            
            if($getupdate){
                return redirect('admincp/video-comment')->with('msg-success','Update successfuly !');
            }else{
                return redirect('edit-video-comments/'.$id.'')->with('msg-error','Update not successfuly.Please try again !');
            }
        }
    }
    
    /*
     * action export report excel
     */
    public function getReport($listid){
        if($listid!=NULL){
            $get_count = CountReportModel::where('report_status','=',1)->first();
            $countreport = CountReportModel::where('report_status','=',1)
                    ->update(array('count_report'=>$get_count->count_report + 1));
            $get_title=VideoModel::where('string_Id','=',$listid)->first();
            $getcomment = VideoCommentModel::select('video_comment.*','members.firstname','members.lastname','video.title_name')
                    ->where('video_comment.video_Id','=',$listid)
                    ->join('members','members.user_id','=','video_comment.member_Id')
                    ->join('video','video.string_Id','=','video_comment.video_Id')
                    ->get();
            $stt=2;
            $i=1;
            Excel::create('Report Comment '.$get_title->title_name.' '.date('D-M-Y').'', function($excel)use ($getcomment,$i,$stt) {
                $excel->sheet('sheet1', function($sheet)use($getcomment,$i,$stt) {
                    $sheet->cells('A1:G1', function($cells) {
                        $cells->setBackground('#ee577c');
                        $cells->setFontColor('#ffffff');
                    });
                    
                    $sheet->SetCellValue("A1", "#");
                    $sheet->SetCellValue("B1", "Video ID");
                    $sheet->SetCellValue("C1", "Video Title");
                    $sheet->SetCellValue("D1", "First Name");
                    $sheet->SetCellValue("E1", "Last Name");
                    $sheet->SetCellValue("F1", "Comment");
                    $sheet->SetCellValue("G1", "Created At");
                    
                    foreach($getcomment as $result){
                        $sheet->row($stt++,array($i++,$result->video_Id, $result->title_name,$result->firstname,
                            $result->lastname,$result->post_comment,$result->created_at));
                    }
                });
            })->download('xls');
        }
    }

    /*
     * action get all standard advertise
     */
    public function getStandardAds() {
        $get_list= StandardAdsModel::get();
        
        return view('admincp.ads.standard_list')->with('standard', $get_list);
    }
    
    /*
     * action get info to add standard advertise
     */
    public function getAddStandardAds(){
        return view('admincp.ads.add_standard_ads');
    }
    
    /*
     * action post data to add standard advertise
     */
    public function postAddStandardAds(Request $get){
        if($get){
            $string=mt_rand();
            $addstandard = new StandardAdsModel();
            $addstandard->ads_title=$get->ads_title;
            $addstandard->position=$get->position;
            $addstandard->return_url=$get->return_url;
            $addstandard->status=$get->status;
            $addstandard->string_id=$string;
            $addstandard->type=$get->type;
            $addstandard->script_code=$get->script_code;

            $file=Input::file('ads_content');
            if($file){
                if($file->getClientOriginalExtension()=="swf"){
                    $path="".$_SERVER['DOCUMENT_ROOT'].GetPath()."/public/upload/ads/";
                    $filename=$string.".".$file->getClientOriginalExtension();
                    $uploadfile=$file->move($path,$filename);
                    if($uploadfile){
                        $addstandard ->ads_content= $filename;
                        $addstandard ->ads_type= $file->getClientOriginalExtension();
                    }
                }else{
                    $extension =$file->getClientOriginalExtension();
                    $notAllowed = array("exe","php","asp","pl","bat","js","jsp","sh","doc","docx","xls","xlsx");
                    $destinationPath = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/public/upload/ads/";
                    $filename = "Standard_".$string.".".$extension;

                    if(!in_array($extension,$notAllowed))
                    {
                        $file->move($destinationPath, $filename);
                        $addstandard->ads_content =URL('public/upload/ads/')."/".$filename;
                        $addstandard->ads_type=$extension;
                    }
                }

            }

            if($addstandard->save()){
                return redirect('admincp/ads-standard')->with('msg-success','Upload successfuly !');
            }else{
                return redirect('admincp/add-standard-ads')->with('msg-error','Upload not success !');
            }
        }

    }

    /*
     * action get data to update standard advertise
     */
    public function getEditStandardAds($id){
        if($id!=NULL or $id !=" "){
            $checkid= StandardAdsModel::where('ID','=',$id)->first();
            
            if($checkid!=NULL){
                return view('admincp.ads.edit_standardads')->with('editstandard',$checkid)->with('title_pornstar','Manage Standard Ads') ;
            }else{
                return redirect('admincp/ads-standard')->with('msg-error','Ads  not found !');
            }
        }else{
            return redirect('admincp/ads-standard')->with('msg-error','Ads  not found !');
        }
    }

    /*
     * action post data to update standard advertise
     */
    public function postEditStandardAds(Request $get, $id){
        if($id!=NULL or $id !=" "){
            $checkid= StandardAdsModel::where('ID','=',$id)->first();
            if($checkid!=NULL){
                $string=$get->string_id;
                $cl_version=$get->cl_version;
                $data=array(
                    'ads_title'=>$get->ads_title,
                    'position'=>$get->position,
                    'return_url'=>$get->return_url,
                    'status'=>$get->status,
                    'string_id'=>$string,
                    'type'=>$get->type,
                    'script_code'=>$get->script_code

                );
                $updateAds= StandardAdsModel::where('ID','=',$id)->update($data);
                $file=Input::file('ads_content');
                if($file){
                    $extension =$file->getClientOriginalExtension();
                    $notAllowed = array("exe","php","asp","pl","bat","js","jsp","sh","doc","docx","xls","xlsx");
                    $destinationPath = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/public/upload/ads/";
                    $filename = "Standard_".$string.".".$extension;

                    if(!in_array($extension,$notAllowed))
                    {
                        $file->move($destinationPath, $filename);
                        $updatestandard= StandardAdsModel::where('ID','=',$id)->update(array(
                            'ads_content' =>URL('public/upload/ads/')."/".$filename,
                            'ads_type' =>$extension
                        ));
                    }
                }
                if($updateAds){
                    return redirect('admincp/ads-standard')->with('msg-success','Update Ads successfuly !');
                }
            }else{
                return redirect('admincp/ads-standard')->with('msg-error','Ads  not found !');
            }
        }else{
            return redirect('admincp/ads-standard')->with('msg-error','Ads  not found !');
        }
    }

    /*
     * action delete standard advertise
     */
    public function deleteStandardAds($id){
        if($id!=NULL or $id!= ""){
            $checkAds= StandardAdsModel::where('ID','=',$id)->first();
            if($checkAds!=NULL){
                $deleteAds= StandardAdsModel::where('ID','=',$id)->delete();
                if($deleteAds){
                    return redirect('admincp/ads-standard')->with('msg-success','Delete Ads successfuly');
                }else{
                    return redirect('admincp/ads-standard')->with('msg-error','Delete Ads not success');
                }
            }else{
                 return redirect('admincp/ads-standard')->with('msg-error','Ads not found !');
            }
        }
    }

    /*
     * action get comment reply of admin
     */
    public function getAdminReply($id) {
        $comment = VideoCommentModel::select('video_comment.*', 'members.username', 'video.string_Id', 'video.poster', 'video.title_name')
                ->join('video', 'video.string_Id', '=', 'video_comment.video_Id')
                ->join('members', 'members.user_id', '=', 'video_comment.member_Id')
                ->where('video_comment.ID', '=', $id)
                ->first();
        return view('admincp.comment.reply')->with('comment', $comment)->with('title_pornstar','Manage Video Comments ');
    }
    
    /*
     * action post comment reply of admin to add
     */
    public function postAdminReply($id ,Request $req) {
        if ($id != NULL) {
            $comment = VideoCommentModel::select('video_comment.*', 'members.username')
                    ->join('members', 'members.user_id', '=', 'video_comment.member_Id')
                    ->where('video_comment.ID', '=', $id)
                    ->first();
            
            if ($comment){
                $user=\Session::get('logined');
                $post_comment = $req->post_comment;
                $memberid = $user->user_id;
                $addcomment = new VideoCommentModel();
                $addcomment->video_Id = $comment->video_Id;
                $addcomment->member_Id = $memberid;
                $addcomment->comment_parent = $id;
                $addcomment->post_comment = $post_comment;
                if ($addcomment->save()) {
                    return redirect('admincp/video-comment')->with('msg-success', 'Your reply successfuly !');
                } else {
                    return redirect('admincp/admin-reply-comment')->with('msg-error', 'Your reply successfuly !');
                }
            }
        } else {
            return redirect('admincp/video-comment')->with('msg-error', 'Can\'t found this comment !');
        }
    }

    /*
     * action auto update video
     */
    public function autoUploadVideo() {
        $conversion_config= ConversionModel::get_config();
        $date=date('Y-m-d');
        $folder="".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/".$date."";
        if(!is_dir($folder)){
            $folder = mkdir("".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/" . $date , 0777, true);
            $upload_folder = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/".$date."/";
        }else{
            $upload_folder = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/videos/".$date."/";
        }

        if(isset($_FILES["myfile"]))
        {
            $ret = array();
            $string_id = $_POST['string_id'];
            $error = $_FILES["myfile"]["error"];

            if(!is_array($_FILES["myfile"]["name"]))
            {
                $file_info = $_FILES["myfile"]["type"];
                $extend = explode("/", $file_info);
                $get_extend = end($extend);
                $fileName = $string_id.".".$get_extend;
                $upload_video =  move_uploaded_file($_FILES["myfile"]["tmp_name"],$upload_folder.$fileName);
                $ret[] = $fileName;
            }
        }
    }

    /*
     * action change text
     */
    public function changeText($text)
    {
        $need = array('%2F','%3A','%3D','%3F','%26','%25');
        $replace = array('/',':','=','?','&','%');
        $text = str_replace($need, $replace, $text);
        
        return $text;
    }

    /*
     * action get list private message
     */
    public function getListPrivateMessage(){
        $getlist= MSGPrivateModel::select('msg_private.*','video.string_Id','video.title_name','video.post_name')
                                ->join('video','video.string_Id','=','msg_private.string_id')
                                ->get();
        
        return view('admincp.video.msglist')->with('message',$getlist);
    }
    
    /*
     * action get replay message
     */
    public function getRelayMessage($id){
        if($id){
            $checkid=MSGPrivateModel::find($id);
            
            if($checkid!=NULL){
                return view('admincp.video.replymsg')->with('reply', $checkid);
            }else{
                return redirect('admincp/private-message')->with('msgerror', 'Message Not Found !');
            }
        }
    }
    
    /*
     * action post data to add replay message
     */
    public function postRelayMessage(Request $get){
        if($get){
            $email= $get->email;
            $id=$get->id;
            $content_reply=$get->content_reply;
            $config=OptionModel::get_config();
            $sendmail = Mail::send('admincp.mail.reply_mail',array('site_name'=>$config->site_name,
                'content'=>$content_reply,'email'=>$email),
            function($message) use($email){
                $message->to($email)->subject('Adult Streaming Website Reply Message Center');
            });
            
            if($sendmail){
                $update_status =MSGPrivateModel::where('id','=',$id)->update(array('status'=>1));
                if($update_status){
                    return redirect('admincp/private-message')->with('msg','Your reply has ben send to '.$email.' . ');
                }
            }else{
                return redirect('admincp/reply-message/'.$id.'')->with('msgerror','Your reply has ben send to '.$email.' . ');
            }
        }
    }

    /*
     * action get url
     */
    static function get($url, $referer = '', $host = '') {
        if (empty($referer)) {
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

    /*
     * action post data to add replay message
     */
    public function saveVideo(Request $data)
    {
        $model =  new VideoModel();
        $user = \Session::get('logined');
        $model->user_id = $user->user_id;

        $model->categories_Id = $data->category;
        $string = mt_rand();
        $model->title_name = $data->title;
        $model->post_name = str_slug($data->title);
        $model->video_src = $data->link;
        $model->poster = $data->image;
        $model->tag = $data->tags;
        $model->string_Id = $string;
        $dura = (int)$data->duration;
        $duration =  $this->sec2hms($dura);
        $model->duration = $duration;
        $model->description = $data->description;
        $model->status = $data->status;
        if (strpos($data->image, 'pornfun.com')) {
            $model->duration = $data->duration;
        }
        
        if (strpos($data->image, 'www.vporn.com')) {
            $model->duration = $data->duration;
        }

        $v = Validator::make($data->all(), [
            'title' => 'required|max:255',
            'link' => 'required',
        ]);
        if ($v->fails())
        {
            return redirect('admincp/grab-video')->with('msg','Save fails!');
        }else{
            $model->save();
            return redirect('admincp/grab-video')->with('success','Save video successfully!');
        }
    }

    /*
     * action delete message
     */
    public function deleleMessage($id){
        if($id){
            $checkid = MSGPrivateModel::find($id);
            if($checkid!=NULL){
                 $delete=MSGPrivateModel::where('id','=',$id)->delete();
                 
                 if($delete){
                    return redirect('admincp/private-message')->with('msg',' Message has been delete successfully');
                 }
            }else{
                return redirect('admincp/private-message')->with('msgerror','Message Not Found !');
            }
        }
    }

}
