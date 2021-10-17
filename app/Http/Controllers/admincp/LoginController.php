<?php

namespace App\Http\Controllers\admincp;

use Illuminate\Foundation\Http\Kernel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\UsersModel;
use App\Models\OptionModel;
use App\Models\StaticPageModel;
use App\Models\SubsriptionModel;
use App\Models\PaymentConfigModel;
use App\Models\ConversionModel;
use App\Models\HeaderModel;
use App\Models\FQAModel;
use App\Models\ContactModel;
use App\Models\EmailSettingModel;
use App\Models\BanIPModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

/*
 * Login Controller
 */
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return View('admincp.login.login');
    }

    /*
     * action post login
     */
    public function postLogin(Request $request)
    {
        $username=$request->input('username');
        $password=MD5($request->input('password'));
        $login = UsersModel::CheckLogin($username,$password);
        
        if($login){
            return redirect('admincp');
        }
        else if($login)
        {
            return redirect('admincp');
        }
        else{
            return View('admincp.login.login')->with('login_error','The Username or Password you entered is incorrect. !!!');
        }
    }
    
    /*
     * action logout
     */
    public function getLogout()
    {
        Session::forget('logined');
        return redirect('admincp/login');
    }

    /*
     * action all options
     */
    public function getOption(){
        $get_option= OptionModel::first();
        
        return view('admincp.option.option')->with('option',$get_option);
    }
    
    /*
     * action post to add option
     */
    public function postOption(Request $get){
        if($get){
            $site_name= $get->site_name;
           $site_description=$get->site_description;
           $site_copyright=$get->site_copyright;
           $site_keyword=$get->site_keyword;
           $site_phone=$get->site_phone;
           $site_email=$get->site_email;
           $site_fb=$get->site_fb;
           $site_tw=$get->site_tw;
           $site_text_footer=$get->site_text_footer;
           $site_linkin=$get->site_linkin;
           $site_address=$get->site_address;
           $site_ga=$get->site_ga;

            if($site_name!=NULL){
                if(!preg_match("/^[-a-z A-Z 0-9 @ = ~ _ | ! : , . ; ]*$/",$site_name)){
                    return redirect('admincp/option')->with('msgerro',' Site name Only letters and white space allowed');
                }
            }
            if($site_description!=NULL){
                if(!preg_match("/^[-a-z A-Z 0-9 @ = ~ _ | ! : , . ; ]*$/",$site_description)){
                    return redirect('admincp/option')->with('msgerro',' description Only letters and white space allowed');
                }
            }
            if($site_copyright!=NULL){
                if(!preg_match("/^[-a-z A-Z  0-9 ©&@=~_|!:,.; ]*$/",$site_copyright)){
                    return redirect('admincp/option')->with('msgerro','Copyright Only letters and white space allowed');
                }
            }
            if($site_keyword!=NULL){
                if(!preg_match("/^[-a-zA-Z 0-9 @ = ~ _ | ! : , . ; ]*$/",$site_keyword)){
                    return redirect('admincp/option')->with('msgerro','Keyword Only letters and white space allowed');
                }
            }
            if($site_phone !=NULL){
                if(!preg_match("/^[0-9 +]*$/",$site_phone)){
                    return redirect('admincp/option')->with('msgerro','Phone Input must be numberis');
                }
            }
            if($site_email!=NULL){
                if (!filter_var($site_email, FILTER_VALIDATE_EMAIL)) {
                    return redirect('admincp/option')->with('msgerro','email Invalid email format');
                }
            }
            if($site_fb!=NULL){
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$site_fb)) {
                    return redirect('admincp/option')->with('msgerro','Facebook Invalid website address format');
                }
            }
            if($site_tw!=NULL){
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$site_tw)) {
                    return redirect('admincp/option')->with('msgerro',' Twitter Invalid website address format');
                }
            }
            if($site_linkin!=NULL){
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$site_linkin)) {
                    die("LOL");
                    return redirect('admincp/option')->with('msgerro',' Linkin Invalid website address format');
                }
            }
            $data=array(
                'site_name'=>$site_name,
                'site_description'=>$site_description,
                'site_keyword'=>$site_keyword,
                'site_address'=>$site_address,
                'site_phone'=>$site_phone,
                'site_email'=>$site_email,
                'site_fb'=>$site_fb,
                'site_tw'=>$site_tw,
                'site_linkin'=>$site_linkin,
                'site_copyright'=>$site_copyright,
                'site_text_footer'=>$site_text_footer,
                'site_ga'=>$site_ga
            );
            
            $site_map=Input::file('site_map');
            $site_logo=Input::file('site_logo');
            if($site_map){
                $extension =$site_map->getClientOriginalExtension();

                $Allowed = array("xml");

                $destinationPath = "".$_SERVER['DOCUMENT_ROOT'].getPath()."/";

                $filename = "sitemap.".$extension;

                if(in_array($extension,$Allowed))
                {
                     $site_map->move($destinationPath, $filename);
                     $update_sitemap =OptionModel::where('ID','=',$get->id)->update(array('site_map'=>$filename));
                }
            }

            if($site_logo){
                $extension =$site_logo->getClientOriginalExtension();

                $Allowed = array("png","jpg","gif","PNG","JPG","GIF");

                $destinationPath = "".$_SERVER['DOCUMENT_ROOT'].getPath()."/";

                $filename = "logo.".$extension;

                if(in_array($extension,$Allowed))
                {
                     $site_logo->move($destinationPath, $filename);
                     $update_logo =OptionModel::where('ID','=',$get->id)->update(array('site_logo'=>$filename));
                }
            }
            $update_config =OptionModel::where('ID','=',$get->id)->update($data);
            if($update_config){
                return redirect('admincp/option')->with('msg','Update config sucessfully');
            }else{
                return redirect('admincp/option')->with('msg','Update config sucessfully');
            }
        }
    }

    /*
     * action get form change pass
     */
    public function getChangePass(){
        return view('admincp.login.changepassword');
    }
    
    /*
     * action post form change pass
     */
    public function postChangePass(Request $get){
        if($get->current_pass !=NULL && $get->new_pass !=NULL && strlen($get->new_pass)>=6){
            $user=\Session::get('logined');

            $data= array(
                'password'=>md5($get->new_pass)
            );
            
            $update= UsersModel::where('id','=',$user->id)->update($data);
            if($update){
                Session::forget('logined');
                return redirect('admincp/login');
            }
        }else{
            return redirect('admincp/change-password')
                    ->with('msg','Update password has failed! Please check again. Password must be at least 6 characters');
        }
    }

    /*
     * action get all static page
     */
    public function getStaticPage(){
        $get_page= StaticPageModel::get();
        
        return view('admincp.login.pagelist')->with('static_page',$get_page);
    }
    
    /*
     * action get form to add static page
     */
    public function getAddStaticPage(){
        
        return view('admincp.login.page_add');
    }
    
    /*
     * action post data to add static page
     */
    public function postAddStaticPage(Request $get){
        if($get){
            $titlename=$get->titlename;
            $content_page=$get->content_page;
           if($titlename ==NULL or $titlename== ""){
                return redirect('admincp/add-static-page')->with('msg',' * Invalid Title only text  format!')->with('titlename',$titlename)->with('content_page',$content_page);
            }
            if(!preg_match("/^[a-zA-Z 0-9 ]*$/",$titlename)){
                return redirect('admincp/add-static-page')->with('msg',' * Invalid Title only text  format !')->with('titlename',$titlename)->with('content_page',$content_page);
            }
            if($content_page ==NULL or $content_page== ""){
                return redirect('admincp/add-static-page')->with('msg',' * Please input not null here !')->with('titlename',$titlename)->with('content_page',$content_page);
            }
           else{
                $addpage=new StaticPageModel();
                $addpage->titlename=$titlename;
                $addpage->content_page=$content_page;
                $addpage->status=1;
                if($addpage->save()){
                    return redirect('admincp/static-page')->with('msg','Add page sucessfully !');
                }
            }
        }
    }
    
    /*
     * action post data to update static page
     */
    public function postEditStaticPage(Request $get,$id){
        if($id!=NULL){
            $checkid= StaticPageModel::find($id);
            if($checkid!=NULL){
                $titlename=$get->titlename;
                $content_page=$get->content_page;
                $status=$get->status;
                if($titlename ==NULL or $titlename== ""){
                    return redirect('admincp/add-static-page')->with('msg',' * Invalid Title only text  format!')->with('titlename',$titlename)->with('content_page',$content_page);
                }
                if(!preg_match("/^[a-zA-Z 0-9 ]*$/",$titlename)){
                    return redirect('admincp/add-static-page')->with('msg',' * Invalid Title only text  format !')->with('titlename',$titlename)->with('content_page',$content_page);
                }
                if($content_page ==NULL or $content_page== ""){
                    return redirect('admincp/add-static-page')->with('msg',' * Please input not null here !')->with('titlename',$titlename)->with('content_page',$content_page);
                } else {

                    $data=array(
                    'titlename'=>$titlename,
                    'content_page'=>$content_page,
                    'status'=>$status
                    );
                    $update= StaticPageModel::where('id','=',$id)->update($data);
                    if($update){
                        return redirect('admincp/static-page')->with('msg','Update sucessfully !');
                    }else{
                        return redirect('admincp/edit-static-page/'.$id.'');
                    }
                }
            }else{
                return redirect('admincp/static-page')->with('msg',' Request page not found !');
            }
        }else{
            return redirect('admincp/static-page')->with('msg',' Request page not found !');
        }
    }

    /*
     * action get list ip were banned
     */
//    public function getBanip(){
//        $get_list= BanIPModel::get();
//
//        return view('admincp.login.ip_list')->with('ipban',$get_list);
//    }
    
    /*
     * action get form to add banip
     */
//    public function getAddBanip(){
//        return view('admincp.login.add_ip_ban')->with('title_pornstar','Banned IP Address Management');
//    }
    
    /*
     * action post data to add banip
     */
//    public  function postAddBanip(Request $get){
//        if($get){
//            $ip=$get->ip_ban;
//            $status=$get->status;
//            if(!filter_var($ip, FILTER_VALIDATE_IP) === false){
//                $addip= new BanIPModel();
//                $addip->ip_ban = $ip;
//                $addip->status =1;
//                if($addip->save()){
//                    return redirect('admincp/banip')->with('msg','Ban IP sucessfully');
//                }
//            }else{
//                 return redirect('admincp/add-banip')->with('msgerror',''.$ip.' is not a valid IP address');
//            }
//        }
//    }

    /*
     * action get data to update banip
     */
//    public function getEditBanip($id){
//        if($id!=NULL){
//            $checkip= BanIPModel::find($id);
//            if($checkip!=NULL){
//                return view('admincp.login.edit_ip_ban')->with('edit_ip',$checkip);
//            }else{
//                return redirect('admincp/banip')->with('msg','Request not fount !');
//            }
//        }else{
//            return redirect('admincp/banip')->with('msg','Request not fount !');
//        }
//    }

    /*
     * action post data to update banip
     */
//    public function postEditBanip(Request $get,$id){
//        if($get){
//            $ip=$get->ip_ban;
//            $status=$get->status;
//            if(!filter_var($ip, FILTER_VALIDATE_IP) === false){
//                $update=BanIPModel::where('id','=',$id)->update(array('ip_ban'=>$ip,'status'=>$status));
//                if($update){
//                    return redirect('admincp/banip')->with('msg','Update sucessfully !');
//                }
//            }else{
//                 return redirect('admincp/edit-banip')->with('msg',''.$ip.' is not a valid IP address');
//            }
//        }
//    }

    /*
     * action delete banip
     */
//    public function deleteIP($id){
//        if($id!=NULL){
//            $check=BanIPModel::find($id);
//            if($check!=NULL){
//                $get_del= BanIPModel::where('id','=',$id)->delete();
//                if($get_del){
//                    return redirect('admincp/banip')->with('msg','Delete sucessfully !');
//                }
//            }else{
//                return redirect('admincp/banip')->with('msgerror','Request not fount !');
//            }
//        }
//    }

    /*
     * action post data to send mail reset password
     */
    public function postResetPassword(Request $get){
        if($get){
            $email =$get->email_forgot;
            $token =$get->_token;
            $string_pass=str_random(6);
            $get_email_temp=EmailSettingModel::get_temp_admin_reset_password();
            $getoption=OptionModel::get_config();
            $checkadmin= UsersModel::where('email','=',$email)->first();
            if($checkadmin!=NULL){
                $update= UsersModel::where('id','=',$checkadmin->id)->update(array('password'=>md5($string_pass)));
                if($update){
                    $sendmail = Mail::send('admincp.mail.'.$get_email_temp->name_slug.'',
                            array(
                                'site_name'=>$getoption->site_name,
                                'site_phone'=>$getoption->site_phone,
                                'site_email'=>$getoption->site_email,
                                'newpassword'=>$string_pass
                            ),
                            function($message) use($email){
                                $message->to($email)->subject('Adult Streaming Website Administrator Change Password');
                            }
                    );
                    
                    if($sendmail){
                        return 1;
                    }
                }
            }else{
                return 2;
            }
        }
    }

    /*
     * action get payment setting
     */
    public function getPaymentSetting(){
        $config=PaymentConfigModel::get_payment_config();
        
        return view('admincp.payment.payment_setting')->with('config',$config);
    }
    
    /*
     * action post data to payment setting
     */
    public function postPaymentSetting(Request $get){
        if($get){
            $data=array(
                "clientAccnum"=>$get->clientAccnum,
                "clientSubacc"=>$get->clientSubacc,
                "formName"=>$get->formName,
                "form_signle"=>$get->form_signle,
                "language"=>$get->language,
                "allowedTypes"=>$get->allowedTypes,
                "allowedTypes_signle"=>$get->allowedTypes_signle,
                "subscriptionTypeId"=>$get->subscriptionTypeId,
                "subscriptionTypeId_signle"=>$get->subscriptionTypeId_signle,
                "id"=>$get->id
            );
            
            $update=PaymentConfigModel::where('id','=',$get->id)->update($data);
            if($update){
                return redirect('admincp/payment-setting')->with('msg','Update sucessfully !');
            }else{
                return redirect('admincp/payment-setting')->with('msgerro','Update not Complete');
            }
        }
    }

    /*
     * action get list payment 
     */
//    public function getListMemberPayment(){
//        $get_list = SubsriptionModel::select('subscription.*','channel.title_name','video.title_name as video_name','video.post_name as video_slug')
//                                            ->leftJoin('channel','channel.ID','=','subscription.channel_id')
//                                            ->leftJoin('video','video.string_Id','=','subscription.video_id')
//                                            ->get();
//        return view('admincp.payment.payment_list')->with('payment',$get_list);
//    }


    /*
     * action get header link all
     */
    public function getHeaderLink(){
        $get_header_link=HeaderModel::get();
        return view('admincp.option.header_list')->with('header_link',$get_header_link);
    }
    
    /*
     * action get form to add header link
     */
    public function getAddHeaderLink(){
        return view('admincp.option.add_header_link');
    }
    
    /*
     * action post data to add header link
     */
    public function postAddHeaderLink(Request $get){
        if($get){
            $title_name= $get->title_name;
            $content= $get->content;
            $link= $get->link;
            $status= $get->status;
            $add = new HeaderModel();
            $add->title_name= $title_name;
            $add->content= $content;
            $add->link= $link;
            $add->status= $status;
            if($add->save()){
                return redirect('admincp/header-link')->with('msg','Add sucessfully !');
            }else{
                return redirect('admincp/add-header-link')->with('msgerror','Add not complete !');
            }
        }
    }
    
    /*
     * action get data to update header link
     */
    public function getEditHeaderlink($id){
        if($id !=NULL){
            $checkid= HeaderModel::find($id);
            if($checkid!=NULL){
                return view('admincp.option.edit_header_link')->with('edit_header',$checkid);
            }else{
                return redirect('admincp/header-link')->with('msgerror','Request not found !');
            }
        }
    }
    
    /*
     * action post data to update header link
     */
    public function postEditHeaderLink(Request $get,$id){
        if($get){
            $data=array(
                "title_name"=>$get->title_name,
                "content"=>$get->content,
                "link"=>$get->link,
                "status"=>$get->status
            );
            $update= HeaderModel::where('id','=',$id)->update($data);
            if($update){
                 return redirect('admincp/header-link')->with('msg','update sucessfully !');
            }else{
                 return redirect('admincp/edit-header-link/'.$id.'')->with('msg','update not complete !');
            }
        }
    }

    /*
     * action delete header link
     */
    public function getDeleteHeaderLink($id){
       if($id !=NULL){
            $checkid= HeaderModel::find($id);
            if($checkid!=NULL){
                $delete= HeaderModel::where('id','=',$id)->delete();
                if($delete){
                         return redirect('admincp/header-link')->with('msg','Delete sucessfully !');
                    }else{
                         return redirect('admincp/header-link/'.$id.'')->with('msg','Delete not complete !');
                    }
            }else{
                return redirect('admincp/header-link')->with('msgerror','Request not found !');
            }
        }
    }

    /*
     * action get conversion config
     */
    public function getConversionConfig(){
        $get_conversion_config= ConversionModel::get_config();
        
        return view('admincp.option.conversion')->with('config',$get_conversion_config);
    }

    /*
     * action post request conversion config
     */
    public function postConversionConfig(Request $get){
        if($get){
            $data=array(
                "php_cli_path"=>$get->php_cli_path,
                "mplayer_path"=> $get->mplayer_path,
                "mencoder_path" => $get->mencoder_path,
                "ffmpeg_path"=> $get->ffmpeg_path,
                "flvtool2_path"=> $get->flvtool2_path,
                "mp4box_path"=> $get->mp4box_path,
                "mediainfo_path"=> $get->mediainfo_path,
                "yamdi_path"=> $get->yamdi_path,
                "thumbnail_tool"=> $get->thumbnail_tool,
                "meta_injection_tool"=> $get->meta_injection_tool,
                "max_thumbnail_w"=> $get->max_thumbnail_w,
                "max_thumbnail_h"=> $get->max_thumbnail_h,
                "allowed_extension"=> $get->allowed_extension
            );
            
            $update=ConversionModel::where('id','=',$get->id)->update($data);
            if($update){
                return redirect('admincp/conversion-config')->with('msg','Update sucessfully !');
            }else{
                return redirect('admincp/conversion-config')->with('msgerror','Update not complete !');
            }
        }
    }

    /*
     * action get Contact List
     */
    public function getContactList(){
        $contact = ContactModel::orderby('status','ASC')->get();
        
        return view('admincp.contact.list')->with('contact',$contact);
    }
    
    /*
     * action post Contact List
     */
    public function postContactList(Request $get,$id){
        if($get->reply!=NULL){
            $update= ContactModel::where('id','=',$id)->update(array('reply'=>$get->reply,'status'=>2));
            if($update){
                $get_full_contact=ContactModel::find($id);
                $getoption=OptionModel::get_config();
                $sendmail = Mail::send('admincp.mail.reply_mail',
                        array(
                            'site_name'=>$getoption->site_name,
                            'email'=>$get_full_contact->email,
                            'content'=>$get_full_contact->reply
                        ),
                        function($message) use($get_full_contact,$getoption){
                            $message->to($get_full_contact->email)->subject(''.$getoption->site_name.' Reply Contact');
                        }
                );
                if($sendmail){
                    return redirect('admincp/contact')->with('msg-success',' Your reply has been sent to '.$get_full_contact->email.'');
                }
            }
        }else{
            return redirect('admincp/contact')->with('msgerror','Invalid reply content must be not blank !');
        }
    }

    /*
     * action get List
     */
    public function getFQAList(){
        $fqa =FQAModel::get();
        return view('admincp.contact.fqa_list')->with('fqa',$fqa);
    }
    
    /*
     * action get form to add fqa
     */
    public function getAddFQA(){
        return view('admincp.contact.add_fqa');
    }
    
    /*
     * action post data to add fqa
     */
    public function postAddFQA(Request $get){
        $rules = array(
        'question'       => 'required',
        'answer'        => 'required',
        'status'     => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect()->back()->withInput()->withErrors($validator);
        }else{
            $add= new FQAModel();
            $add->question=$get->question;
            $add->answer=$get->answer;
            $add->status=$get->status;
            if($add->save()){
                return redirect('admincp/all-fqa')->with('msg','Add new FQA sucessfully!');
            }
        }
    }
    
    /*
     * action get data to update fqa
     */
    public function getEditFQA($id){
        $check_ID= FQAModel::find($id);
        if($check_ID!=NULL){
            return view('admincp.contact.edit_fqa')->with('edit',$check_ID);
        }else{
            return redirect('admincp/all-fqa')->with('msgerror','Request not found!');
        }
    }
    
    /*
     * action post data to update fqa
     */
    public function postEditFQA(Request $get,$id){
       $rules = array(
        'question'       => 'required',
        'answer'        => 'required',
        'status'     => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect()->back()->withInput()->withErrors($validator);
        }else{
            $update=FQAModel::find($id);
            $update->question=$get->question;
            $update->answer=$get->answer;
            $update->status=$get->status;
            if($update->save()){
                return redirect('admincp/all-fqa')->with('msg','Update FQA sucessfully!');
            }
        }
    }

    /*
     * action delete fqa
     */
    public function getDeleteFQA($id){
        $check_ID= FQAModel::find($id);
        if($check_ID!=NULL){
           if($check_ID->delete()){
             return redirect('admincp/all-fqa')->with('msg','Delete FQA sucessfully!');
           }
        }else{
            return redirect('admincp/all-fqa')->with('msgerror','Request not found!');
        }
    }

    /*
    * action edit static page
    */
    public function getEditStaticPage($id) {
        if($id != NULL) {
            $checkid = StaticPageModel::find($id);
            if($checkid != NULL) {
                return view('admincp.login.page_edit')->with('edit_page', $checkid);
            } else {
                return redirect('admincp/static-page')->with('msg',' Request page not found !');
            }
        } else {
            return redirect('admincp/static-page')->with('msg',' Request page not found !');
        }
    }
}

