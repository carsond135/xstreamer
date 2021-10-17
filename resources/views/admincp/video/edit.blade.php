@extends('admincp.master')
@section('title',"Edit Existing Video's Information")
@section ('subtitle',"Video Management")
@section('content')
<div class="row ">
    <div class="modal-dialog col-md-12" style="width:100% !important">
        <div class="panel panel-primary">
            <div class="panel-heading">Edit Existing Video's Information</div>
            <div class="panel-body">
                <form action="{{URL('admincp/edit-video/')}}/{{$getvideo->string_Id}}" class="form-horizontal" 
                      enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <div class="col-md-2"><label class="label-control">Video Name</label></div>
                        <div class="col-md-10"><input type="text" class="form-control" name="title_name" value="{{$getvideo->title_name}}"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="label-control">Video Description</label></div>
                        <div class="col-md-10"><textarea rows="12" class="form-control" name="description">{{$getvideo->description}}</textarea></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="lable-control">Categories</label></div>
                        <div class="col-md-10">
                            <select id="categories_Id" multiple="multiple" class="form-control"name="post_result_cat[]">
                                @foreach ($categories as $cate_result)
                                    <?php
                                        $data_cat=explode(',', $getvideo->cat_id);
                                        if(in_array($cate_result->ID, $data_cat)){
                                            $selected="selected";
                                        }else{
                                            $selected="";
                                        }
                                    ?>
                                    <option <?=$selected?>  data-name="{{$cate_result->title_name}}" value="{{$cate_result->ID}}_{{$cate_result->title_name}}">
                                        {{$cate_result->title_name}}
                                    </option>
                                @endforeach
                            </select><br>
                            <script type="text/javascript">$(document).ready(function(){$('#categories_Id').select2(); })</script>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="label-control">Tags</label></div>
                        <div class="col-md-10"><input type="text" class="form-control" name="tag" value="{{$getvideo->tag}}"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="lable-control">Status</label></div>
                        <div class="col-md-10">
                            <select name="status" class="form-control">
                                <option value="0" <?php if($getvideo->status==0) echo "selected=selected"; ?>>Inactive</option>
                                <option value="1"  <?php if($getvideo->status==1) echo "selected=selected"; ?>>Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><div id="loading-upload" class="pull-left"></div></div>
                    </div>
                    <input type="hidden" id="fileupload" name="fileupload" value="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <center>
                        <button type="submit" value="Publish" class="btn btn-info">Click Here To Add This Video </button>
                    </center>
                </form>
           </div>
       </div>
    </div>
</div>

<div class="spacer"></div>

<script type="text/javascript">
$('#submit-upload').click(function (){
        $('#loading-upload').html('<img style="position: relative;top: 5px;" src="{{URL("public/assets/images/loading.gif")}}"/><label>Waiting upload...</label>').show();
})

 $(document).ready(function(){
    $(document).ready(function(){
        $('#check_buy').click(function(){
            $('#show_ppv').slideToggle("fast");
        })
    })
});
</script>
@endsection
