@extends('admincp.master')
@section('title',"Categories")
@section('content')
<div class="row ">
    <div class="modal-dialog col-md-12" style="width:100% !important">
        @if(isset($validator))
            @if (count($validator) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($validator->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
        <div class="panel panel-primary">
            <div class="panel-heading">Add A New Video Category</div>
            <div class="panel-body">
                <form action="{{URL('admincp/add-categories')}}" class="form-horizontal" 
                      enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="form-group">
                        <div class="col-md-2"><label class="lable-control">Category Name</label></div>
                        <div class="col-md-10"><input class="form-control" type="text" name="title_name" value=""></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="lable-control">Category Image</label></div> 
                        <div class="col-md-10"><input class="form-control" type="file" name="poster" value="" placeholder=""></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2"><label class="lable-control">Status</label></div> 
                        <div class="col-md-10">
                            <select name="status" class="form-control">
                                <option value="0">Inactive</option>
                                <option value="1" selected="selected">Active</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <center><button type="submit" value="Publish" class="btn btn-info">Add Category</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
		
<div class="spacer"></div>

@endsection
