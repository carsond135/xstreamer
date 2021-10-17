@extends('admincp.master')
@section('title',"Download Video Content")
@section ('subtitle',"Video Management")
@section('content')


    <div class="row">

        <div class="modal-dialog col-md-12" style="width:100% !important">
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            
            @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>        
                @endforeach
            </div>
            @endif
            <div class="panel panel-primary">
                <div class="panel-heading">Download Video Content</div>
                <div class="panel-body">
                    
                    <form action="{{URL('admincp/dowload-video-add')}}" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <div class="col-md-2"><label class="label-control">Website</label></div>
                            <div class="col-md-10">
                                <select name="website" class="form-control">
                                    <option value="www.maxjizztube.com">www.maxjizztube.com</option>
                                    <option value="www.4tube.com">www.4tube.com</option>
                                    <option value="www.besthdtube.com">www.besthdtube.com</option>
                                    <option value="lubetube.com">lubetube.com</option>
                                    <option value="www.txxx.com">www.txxx.com</option>
                                    <option value="www.pornhub.com">www.pornhub.com</option>
                                    <option value="pornfun.com">pornfun.com</option>
                                    <option value="www.vporn.com">www.vporn.com</option>
                                    <option value="www.yobt.com">www.yobt.com</option>
                                    <option value="www.youporn.com">www.youporn.com</option>
                                    <option value="xhamster.com">xhamster.com</option>
                                    <option value="www.xvideos.com">www.xvideos.com</option>
                                    <option value="www.xtube.com">www.xtube.com</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"><label class="label-control">Link to specific video URL</label></div>
                            <div class="col-md-10">
                                <input type="text" name="link" class="form-control" value="" placeholder="Link url video ">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"><label class="label-control">Username that will appear as uploaded by</label></div>
                            <div class="col-md-10">
                                <?php if (\Session::has('logined')): ?>
                                    <?php 
                                        $user = \Session::get('logined');
                                     ?>
                                    <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>" placeholder="Username">
                                <?php else: ?>
                                    <input type="text" name="username" class="form-control" value="" placeholder="Username">
                                <?php endif ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-2"><label class="lable-control">Categories</label></div> 
                            <div class="col-md-10">
                                <select id="categories_Id" multiple="multiple" class="form-control"name="post_result_cat[]">
                                            @foreach ($categories as $cate_result)
                                            <option  data-name="{{$cate_result->title_name}}" value="{{$cate_result->ID}}_{{$cate_result->title_name}}">{{$cate_result->title_name}}</option>
                                            @endforeach
                                </select>
                                <script type="text/javascript">
                                $(document).ready(function(){$('#categories_Id').select2(); })
                                    
                                </script>
                                
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-2"><label class="label-control">Channel</label></div>
                            <div class="col-md-10">
                                <select name="channel" class="form-control">
                                    <option></option>
                                    <?php if (!empty($channel)): ?>
                                        <?php foreach ($channel as $key => $result): ?>
                                            <option value="<?php echo $result->ID ?>"><?php echo $result->title_name; ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-2"><label class="label-control">Pornstar</label></div>
                            <div class="col-md-10">
                                <select name="pornstar" class="form-control">
                                    <option></option>
                                    <?php if (!empty($pornstar)): ?>
                                        <?php foreach ($pornstar as $key => $result): ?>
                                            <option value="<?php echo $result->ID ?>"><?php echo $result->title_name; ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-2"><label class="label-control">Status</label></div>
                            <div class="col-md-10">
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                        </div>
                        
                        <center><button type="submit" name="save" value="Save" class="btn btn-info">Save</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection