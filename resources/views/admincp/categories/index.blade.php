@extends('admincp.master')
@section('title',"Categories")
@section('content')
@if(session('msg'))
    <h4 class="alert alert-success">{{ session('msg') }}</h4>
@endif
@if(session('msgerro'))
    <div class="alert alert-error">{{session('msgerro')}}</div>
@endif
<article class="module width_full">
    <div class="add">
        <a href="{{URL('admincp/add-categories')}}"><i class="fa fa-plus-circle"></i> Add a new Video Category</a>
    </div>
    <header>
        <h3 class="tabs_involved">Categories</h3>
    </header>
    <table class="tablesorter" cellspacing="0" cellpadding="0"> 
        <thead> 
            <tr> 
                <th  class="line_table">ID</th> 
                <th class="line_table">Name</th> 
                <th class="line_table">Status</th>
                <th >Action</th>
            </tr> 
        </thead> 
        <tbody> 
            @foreach($categories as $result)
                <tr> 
                    <td class="line_table">{{$result->ID}}</td> 
                    <td class="line_table">{{$result->title_name}}</td> 
                    <td class="line_table">
                        <?=($result->status==1)?'<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>'?>
                    </td>
                    <td>
                        <a href="{{URL('admincp/edit-categories/')}}/{{$result->ID}}"><i style="font-size: 20px ; margin: 5px" class="fa fa-pencil-square-o"></i></a>
                        <a href="{{URL('admincp/delete-categories/')}}/{{$result->ID}}"  onclick="return confirm('Are you sure remove categories : {{$result->title_name}} ?')"><i style="font-size: 20px ; margin: 5px" class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @Endforeach
        </tbody> 
    </table>
    <div id="pager" class="pager">
        <form>
            <img src="{{URL('public/assets/css/table/first.png')}}" class="first"/>
            <img src="{{URL('public/assets/css/table/prev.png')}}" class="prev"/>
            <input type="text" readonly="readonly" class="pagedisplay"/>
            <img src="{{URL('public/assets/css/table/next.png')}}" class="next"/>
            <img src="{{URL('public/assets/css/table/last.png')}}" class="last"/>
            <select class="pagesize">
                <option selected="selected"  value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option  value="30">30</option>
            </select>
        </form>
    </div>
</article>

<div class="spacer"></div>

@endsection