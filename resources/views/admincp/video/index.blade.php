@extends('admincp.master')
@section('title',"Manage Existing Videos")
@section ('subtitle',"Video Management")
@section('content')
<article class="module width_full">
    <div class="add">
        <a href="{{URL('admincp/add-video')}}"><i class="fa fa-plus-circle"></i> Add A New Video </a>
    </div>
    <header><h3 class="tabs_involved">Existing Video Management </h3></header>
    <table class="tablesorter" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th class="line_table">Video Title</th>
                <th class="line_table">Category</th>
                <th class="line_table"> Created At</th>
                <th class="line_table">Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            @foreach($video as $result)
                <tr>
                    <td class="line_table">{{str_limit($result->title_name, 40)}}</td>
                    <td class="line_table">
                        <?=get_categories_list($result->categories_Id)?>
                    </td>
                    <td class="line_table">{{$result->created_at}}</td>
                    <td class="line_table" style="min-width:60px; text-align:center">
                        <?= ($result->status==1)?'<span class="label label-success">Active</span>':'<span class="label label-danger">Block</span>'?>
                    </td>
                    <td style="min-width:80px; text-align:center">
                        <a href="{{URL('admincp/edit-video/')}}/{{$result->string_Id}}"><i style="font-size:20px ; margin:5px" class="fa fa-pencil-square-o"></i></a>
                        <a href="{{URL('admincp/delete-video')}}/{{$result->string_Id}}" onclick="return confirm('Are you sure remove Video : {{$result->title_name}} ?')"><i style="font-size: 20px ; margin: 5px" class="fa fa-trash-o"></i></a>
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
                <option value="30">30</option>
            </select>
        </form>
    </div>
</article>

<div class="spacer"></div>

<script type="text/javascript">
    $(document).ready(function() {
        
        $('.popup-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        
    });
</script>
@endsection