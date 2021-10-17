@extends('admincp.master')
@section('title',"Add A New Video")
@section ('subtitle',"Video Management")
@section('content')
<div class="row ">
    <div class="modal-dialog col-md-12" style="width:100% !important">
        <div class="panel panel-primary">
            <div class="panel-heading">Add A New Video</div>
            <div class="panel-body">
                <form action="{{URL('admincp/add-video')}}" class="form-horizontal" enctype="multipart/form-data" 
                        method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <div class="col-md-2"><label class="label-control">Video Title</label></div>
                        <div class="col-md-10"><input type="text" class="form-control" name="title_name" value=""></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="label-control">Video Description</label></div>
                        <div class="col-md-10"><textarea rows="12" class="form-control" name="description"></textarea></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="lable-control">Categories</label></div>
                        <div class="col-md-10">
                            <select id="categories_Id"   multiple="multiple" class="form-control"name="post_result_cat[]">
                                @foreach ($categories as $cate_result)
                                <option  data-name="{{$cate_result->title_name}}" value="{{$cate_result->ID}}_{{$cate_result->title_name}}">{{$cate_result->title_name}}</option>
                                @endforeach
                            </select><br>
                            <script type="text/javascript">
                                $(document).ready(function(){$('#categories_Id').select2(); })
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="label-control">Tags</label></div>
                        <div class="col-md-10"><input type="text" class="form-control" name="tag" value="" ></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="label-control">Upload your new video</label></div>
                        <div class="col-md-10">
                            <div id="fileuploader"></div>
                            <script type="text/javascript">
                                $(document).ready(function() {

                                    $("#fileuploader").uploadFile({
                                        url:"{{URL('admincp/auto-upload-video')}}",
                                        fileName:"myfile",
                                        allowedTypes:"mp4,mov,avi,flv",
                                        formData: [{ name: '_token', value: $('meta[name="csrf-token"]').attr('content') },{ name: 'string_id', value: $('input[name="string_id"]').attr('value') }],
                                        multiple: false,
                                        autoSubmit:true,
                                        onSuccess:function(files,data,xhr)
                                        {
                                            $('#fileupload').val(files);
                                        }
                                    });
                               });
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="lable-control">Status</label></div>
                        <div class="col-md-10">
                            <select name="status" class="form-control">
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            <div id="loading-upload" class="pull-left"></div>
                        </div>
                    </div>
                    <input type="hidden" id="file_hidden" name="file_hidden" >
                    <input type="hidden" name="string_id" id="string_id" value="<?=mt_rand()?>">
                    <input type="hidden" id="fileupload" name="fileupload" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <center><button type="submit" value="Publish" class="btn btn-info">Save</button></center>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="spacer"></div>

<script type="text/javascript">
    $('#submit-upload').click(function (){
        $('#loading-upload').html('<img style="position:relative; top:5px;"  src="{{URL("public/assets/images/loading.gif")}}"/><label>Waiting upload...</label> ').show
    })
    $('#submit-upload').click(function (){
        $('#jax-loading').modal('show');
    })
    $(document).ready(function(){
        $('#check_buy').click(function(){
            $('#show_ppv').slideToggle("fast");
        })
    })
</script>
@endsection