<?php

namespace App\Http\Controllers\admincp;
use App\Models\CategoriesModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\CountriesModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

/*
 * Category Controller
 */
class CategoriesController extends Controller
{
    /*
     * action get all cateogry
     */
    public function getCategories() {
        $categories = CategoriesModel::OrderBy('created_at', 'DESC')->get();
        
        return view('admincp.categories.index')->with('categories', $categories);
    }

    /*
     * action get form to add cateogry
     */
    public function getAddCategories() {
        $get_country = CountriesModel::get();
        
        return view('admincp.categories.add')->with('country', $get_country);
    }
    
    /*
     * action post data to cateogry
     */
    public function postAddCategories() {
        $get_country = CountriesModel::get();
        
        $rules = array(
            'title_name' => 'required',
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            $messages = $validator->messages();
            
            return view('admincp.categories.add')
                    ->with('validator',$messages)->with('country',$get_country);
        } else {
            $addcategories = new CategoriesModel();
            $addcategories->title_name= $_POST["title_name"];
            $addcategories->post_name= str_slug($_POST["title_name"],"-");
            $addcategories->status= $_POST["status"];
            
            $file = Input::File('poster');
            if($file) {
                $extension =$file->getClientOriginalExtension();
                $notAllowed = array("exe","php","asp","pl","bat","js","jsp","sh","doc","docx","xls","xlsx");
                $destinationPath = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/public/upload/categories/";
                $filename = "Categories_Poster_".$_POST["title_name"].".".$extension;

                if(!in_array($extension,$notAllowed))
                {
                    $file->move($destinationPath, $filename);
                    $addcategories->poster =$filename;
                }else{
                    return redirect('admincp/add-categories')->with('msgerro','File type not allowed!');
                }
            }
            
            if($addcategories->save()){
                return redirect('admincp/categories')->with('msg','Add Categories Successfully !');
            }else{
                return redirect('admincp/add-categories')->with('msgerro','Add Categories Field !');
            }
         }
    }
    
    /*
     * action get data to update cateogry
     */
    public function getEditCategories($id){
         $editcategories = CategoriesModel::where ('ID','=',$id)->first();
         $get_country=CountriesModel::get();
         
         if($editcategories)
         {
             return view('admincp.categories.edit')->with('editcategories',$editcategories)->with('country',$get_country);
         }
    }

    /*
     * action post data to update cateogry
     */
    public function postEditCategories($id){
        $editcategories =CategoriesModel::where('ID','=',$id)->update(array(
                    'title_name' => $_POST["title_name"],
                    'post_name'  => str_slug($_POST["title_name"],"-"),
                    'recomment' => isset($_POST["recomment"]) ? 1 : 0,
                    'status' => $_POST["status"]
                ));
        $file = Input::File('poster');
        
        if($file){
            $extension =$file->getClientOriginalExtension();
            $notAllowed = array("exe","php","asp","pl","bat","js","jsp","sh","doc","docx","xls","xlsx");
            $destinationPath = "".$_SERVER['DOCUMENT_ROOT'].GetPath()."/public/upload/categories/";
            $filename = "Categories_Poster_".$_POST["title_name"].".".$extension;

            if(!in_array($extension, $notAllowed))
            {
                $file->move($destinationPath, $filename);
                $update_editcategories = CategoriesModel::where('ID','=',$id)->update(array('poster'=>$filename));
            }else{
                return redirect('admincp/edit-categories/'.$id.'')->with('msgerro','File type not allowed!');
            }
        }
        
        if($editcategories){
            return redirect('admincp/categories')->with('msg','Update Successfully !');
        }else{
            return redirect('admincp/edit-categories/'.$id.'')->with('msgerro','Update field !');
        }
    }

    /*
     * action delete cateogry
     */
    public function getDeleteCategories($id){
        $deletecategories = CategoriesModel::where('ID','=',$id)->delete();
        
        if($deletecategories)
        {
            return redirect('admincp/categories')->with('msg','Delete Successfully !');
        }
    }
}

