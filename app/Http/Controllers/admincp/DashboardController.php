<?php
namespace App\Http\Controllers\admincp;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\MSGPrivateModel;
use App\Models\MemberModel;
use App\Models\StandardAdsModel;
use App\Models\VideoModel;


/*
 * Dashboard Controller
 */
class DashboardController extends Controller
{
    /*
     * action get information for home page admin
     */
    public function getDashboard(){
        
        return view('admincp.dashboard.index')
            ->with('total',$this->getTotalVideo())
            ->with('new_video',$this->getNewVideo())
            ->with('video_featured',$this->getVideoFeatured())
            ->with('video_validation',$this->getVideoValidation())
            ->with('categories',$this->getCategoriesReport())
            ->with('msgprivate',$this->getMSGReport())
            ->with('member',$this->getMemberLast())
            ->with('membercount',$this->getMember())
            ->with('get_standard_ads',$this->getStandardAds());
    }

    /*
     * get number of total categories
     */
    public function getCategoriesReport(){
        
        $categories = CategoriesModel::count();
        
        if($categories>0){
            return $categories;
        }else{
            return 0;
        }
    }
    
    /*
     * get number of total message private
     */
    public function getMSGReport(){
        $count = MSGPrivateModel::count();
        
        if($count > 0){
            return $count;
        }else{
            return 0;
        }
    }
    
    /*
     * get number of total message private
     */
    public function getMember(){
        $membercount= MemberModel::count();
        if($membercount > 0){
            return $membercount;
        }else{
            return 0;
        }

    }
    
    /*
     * get last five member
     */
    public function getMemberLast(){
        $member= MemberModel::take(5)->Orderby('created_at','DESC')->get();
        
        if(count($member) > 0){
            return $member;
        }
    }

    /*
     * get number of total video have status is 0
     */
    public function getVideoValidation(){
        $video_validation = VideoModel::where('status','=',0)->count();
        
        if($video_validation > 0){
            return $video_validation;
        }else{
            return 0;
        }
    }
    
    /*
     * get number of total video have featured
     */
    public function getVideoFeatured(){
        $video_featured= VideoModel::where('featured','=',1)->count();
        
        if($video_featured > 0){
            return $video_featured;
        }else{
            return 0;
        }

    }
    
    /*
     * get 10 new video
     */
   public function getNewVideo(){
        $new_video =VideoModel::take(10)->Orderby('created_at','desc')->count();
        if($new_video>0){
            return $new_video;
        }else{
            return 0;
        }
    }
    
    /*
     * get number of total video
     */
    public function getTotalVideo(){
        $total= VideoModel::count();
        
        if($total>0){
            return $total;
        }else{
            return 0;
        }
    }
    
    /*
     * get number of total standard advertise
     */
    public function getStandardAds(){
        $standard=StandardAdsModel::count();
        
        if($standard>0){
            return $standard;
        }else{
            return 0;
        }
    }

}
