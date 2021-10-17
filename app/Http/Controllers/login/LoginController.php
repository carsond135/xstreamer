<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Models\ActivityLogModel;
use App\Models\CategoriesModel;
use App\Models\ChannelModel;
use App\Models\ContactModel;
use App\Models\EmailSettingModel;
use App\Models\FQAModel;
use App\Models\MemberModel;
use App\Models\OptionModel;
use App\Models\UserSignupModel;
use App\Services\Modules\Modules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
* Class is login controller
*
* @author UIT_DEV
*/
class LoginController extends Controller
{
    /**
    * Fucntion handle register user
    * 
    * @param Request
    * @return status register user
    */
    public function signUp(Request $req) {
        if(\Request::ajax() != NULL) {
            $get_temp = EmailSettingModel::get_temp_confirm_sign_up();
            $firstname = $req->firstname;
            $lastname = $req->lastname;
            $username = $req->username;
            $passwords = $req->passwords;
            $passwordagain = $req->passwordagain;
            $emails = $req->emails;
            $_token = $req->_token;

            if(strlen($firstname) < 4 or strlen($firstname) > 32) {
                return 1;
            }
            if($firstname == NULL or $firstname == '') {
                return 2;
            }
            if(strlen($lastname) < 4 or strlen($lastname) > 32) {
                return 3;
            }
            if($lastname == NULL or $lastname == '') {
                return 4;
            }
            if($username == NULL or $username == '') {
                return 11;
            }
            if(strlen($username) < 8 or strlen($username) > 32) {
                return 12;
            }

            $checkuser = UserSignupModel::where('username', '=', $username)->get();
            $checkmemberuser = MemberModel::where('username', '=', $username)->get();
            if(count($checkuser) > 0 or count($checkmemberuser) > 0) {
                return 5;
            }
            if($passwords == NULL or $passwords == '') {
                return 7;
            }
            if(strlen($passwords) < 6) {
                return 6;
            }
            if($passwordagain == NULL or $passwordagain == '') {
                return 8;
            }
            if($passwordagain != $passwords) {
                return 9;
            }
            if($emails == NULL or $emails == '') {
                return 13;
            }

            $checkemail = UserSignupModel::where('email', '=', $emails)->get();
            $checkmemberemail = MemberModel::where('email', '=', $emails)->get();
            if (count($checkemail) > 0 or count($checkmemberemail) > 0) {
                return 10;
            }

            if(!filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                return 14;
            } else {
                $newuser = new UserSignupModel ();
                $newuser->username = $username;
                $newuser->password = md5($passwords);
                $newuser->firstname = $firstname;
                $newuser->lastname = $lastname;
                $newuser->email = $emails;
                $newuser->remember_token = $_token;

                if($newuser->save()) {
                    \Session::put("UserNew",$newuser);
                    $user = \Session::get('UserNew');
                    $newmember = new MemberModel();
                    $newmember->user_id = $user->id;
                    $newmember->username = $username;
                    $newmember->password = md5($passwords);
                    $newmember->email = $emails;
                    $newmember->firstname = $firstname;
                    $newmember->lastname = $lastname;
                    $newmember->status = 0;
                    if($newmember->save()) {
                        $config = OptionModel::get_config();
                        $sendmail = Mail::send('admincp.mail.'.$get_temp->name_slug,
                            array(
                                'firstname' => $firstname,
                                'lastname' => $lastname,
                                'token' => $_token,
                                'site_name' => $config->site_name
                            ), function($message) use($req) {
                                $message->to($req->emails)->subject('WellCome To Adult Video');
                            });

                        if($sendmail) {
                            return 0; 
                        }
                    }
                }
            }
        }  
    }

    /**
    * Get confirm active user register
    *
    * @param token from mail confirm
    * @return status confirm
    */
    public function getConfrimActive($token) {
        if($token != NULL) {
            $check_token = UserSignupModel::where('remember_token', '=', $token)->first();
            if($check_token != NULL) {
                $update = MemberModel::where('user_id', '=', $check_token->id)->update(array('status'=>1));
                if($update) {
                    $get_member = MemberModel::where('user_id', '=', $check_token->id)->first();
                    \Session::put('User', $get_member);
                    return redirect('/')->with('msg', 'Your account is active !');
                } else {
                    return redirect('/')->with('msg', 'Active your account field. Please try again !');
                }
            }
        }
    }

    /**
    * Function handle sign in user
    *
    * @param Request
    * @return status sign in user
    */
    public function signIn(Request $Request) {
        $current_url = $Request->current_url;
        $user = MemberModel::where('email', '=', $Request->email)
            ->where('status', '=', 1)
            ->where('password', '=', MD5($Request->password))
            ->first();

        if($user) {
            \Session::put("User",$user);
            MemberModel::setUserOnline($Request->email);

            $log = new ActivityLogModel();
            $log->user_id = $user->id;
            $log->type = 'login';
            $log->object_id = $user->id;
            $log->description = 'Signin at ' . date('Y-m-d');
            $log->save();

            if($user['roles'] == 0 && $user['is_profile_updated'] == 0) {
                return redirect($current_url);
            }
            return redirect($current_url);
        } else {
           $categoris = CategoriesModel::where('status', '=', 1)
                ->orderby('title_name', 'ASC')
                ->get();

            return view('login.loginpage')
                ->with('categories', $categoris)
                ->with('msglogin', 'The email and password combination provided does not match our records. Please try again.');
        }
    }

    /**
    * Get view login user
    * 
    * @return view login user
    */
    public function getLogin() {
        $categoris = CategoriesModel::where('status', '=', 1)
            ->orderby('title_name', 'ASC')
            ->get();
        return view('login.loginpage')->with('categories', $categoris);
    }

    /**
    * Function handle send new password to mail
    *
    * @param Request
    * @return status send new password
    */
    public function postMailForgot(Request $get) {
        if($get->email != NULL or $get->email != "") {
            $get_email_temp = EmailSettingModel::get_temp_member_reset_password();
            $get_config = OptionModel::first();
            $get_user = MemberModel::where('email', '=', $get->email)->first();
            $newpass = str_random(8);
            if($get_user != NULL && $get_user->email == $get->email) {
                $sendmail = Mail::send('admincp.mail.'.$get_email_temp->name_slug.'',
                    array(
                        'newpassword'=> $newpass,
                        'lastname'=>$get_user->lastname,
                        'firstname'=>$get_user->firstname,
                        'site_email'=>$get_config->site_email,
                        'site_phone'=>$get_config->site_phone,
                        'site_name'=>$get_config->site_name,
                        'userid'=>$get_user->user_id), function($message) use($get) {
                        $message->to($get->email)->subject('Get New Password');
                    });

                if($sendmail) {
                    $updatepassword = MemberModel::where('email', '=', $get->email)
                        ->update(array('password'=> md5($newpass)));
                    if($updatepassword) {
                        return 1;
                    }
                } else {
                    return 0;
                }
            }
        }
    }

    /**
    * Function logout user
    *
    * @return logout user
    */
    public function logout() {
        $user = \Session::get("User");
        MemberModel::setUserOffOnline($user->email);
        $log = new ActivityLogModel();
        $log->user_id = $user->id;
        $log->type = 'logout';
        $log->object_id = $user->id;
        $log->description = 'Signout at ' . date('Y-m-d');
        $log->save();
        return redirect('/');
    }

    /**
    * Get view site map
    *
    * @return view site map
    */
    public function getSitemap() {
        $channel = ChannelModel::where('status', '=', 1)->get();
        $categoris = CategoriesModel::where('status', '=', 1)
            ->orderby('title_name', 'ASC')
            ->get();

        return view('sitemap.index')
            ->with('categories', $categoris)
            ->with('channel', $channel);
    }

    /**
    * Get view contact
    *
    * @return view contact page
    */
    public function getContact() {
        $channel = ChannelModel::where('status', '=', 1)->get();
        $categories = CategoriesModel::where('status', '=', 1)
            ->orderby('title_name', 'ASC')
            ->get();

        return view('contact.index')->with('categories', $categories);
    }

    /**
    * Function save contact
    *
    * @param Request
    * @return status add contact
    */
    public function postContact(Request $get) {
        $categories = CategoriesModel::where('status', '=', 1)
            ->orderby('title_name', 'ASC')
            ->get();

        $rules = array(
            'email_contact' => 'required|email', 
            'name_contact' => 'required', 
            'account_contact' => 'required', 
            'type_contact' => 'required', 
            'message_contact' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return view('contact.index')
                ->with('validator', $messages)
                ->with('categories', $categories);
        }

        if(!$this->captchaCheck()) {
            return redirect('contact')->with('captcha', 'Please verify captcha !');
        }

        $add = new ContactModel();
        $add->email = $get->email_contact;
        $add->name = $get->name_contact;
        $add->type = $get->type_contact;
        $add->message = $get->message_contact;
        $add->status = 1;
        if($add->save()) {
            return redirect('contact')->with('message', 'Your contact has been sent !');
        }
    }

    /**
    * Function check confirm captcha
    *
    * @return status confirm
    */
    public function captchaCheck() {
        $response = Input::get('g-recaptcha-response');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = env('RE_CAP_SECRET');
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);
        if ($resp->isSuccess()) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Get FQA
    *
    * @return view FQA
    */
    public function getFQA() {
        $categoris = CategoriesModel::where('status', '=', 1)
            ->orderby('title_name','ASC')
            ->get();

        $fqa_list = FQAModel::get_list();
        return view('footer.fqa')
            ->with('fqa', $fqa_list)
            ->with('categories', $categoris);
    }
}