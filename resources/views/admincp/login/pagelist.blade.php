@extends('admincp.master')
@section('title',"Manage Static Pages")
@section ('subtitle',"Static Page")
@section('content')
@if(session('msg'))<h4 class="alert alert-success">{{ session('msg') }}</h4> @endif
<article class="module width_full">
    <header><h3 class="tabs_involved">Page</h3></header>
    <table class="tablesorter" cellspacing="0" cellpadding="0"> 
        <thead> 
            <tr> 
                <th class="line_table">ID</th> 
                <th class="line_table">Name</th> 
                <th class="line_table">status</th>
                <th >Action</th>
            </tr> 
        </thead> 
        <tbody> 
            @foreach($static_page as $result)
                <tr> 
                    <td class="line_table center">{{$result->id}}</td> 
                    <td class="line_table">{{$result->titlename}}</td> 
                    <td class="line_table center">
                        @if($result->status==1)
                            <span id="status-page" data-id="{{$result->id}}" class="label label-success ponter" href="javascript:void(0);">Active</span>
                        @else
                            <span id="status-page" data-id="{{$result->id}}" class="label label-danger" href="javascript:void(0);">Hidden</span>
                        @endif
                    </td>
                    <td class="center">
                        <a href="{{URL('admincp/edit-static-page/')}}/{{$result->id}}">
                            <i style="font-size: 20px ; margin: 5px" class="fa fa-pencil-square-o"></i>
                        </a>
                    </td>
                </tr> 
            @endforeach
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
</article><!-- end of content manager article -->

<div class="spacer"></div>

@endsection