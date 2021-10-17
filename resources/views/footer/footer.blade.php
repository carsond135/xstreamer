<div id="jax-loading" style="" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <center><img width="32" height="32" src="{{URL('public/assets/images/loading_apple.gif')}}"/></center>
    </div>
</div>
<footer>
    <div class="container-footer">
        <div class="ads-here">
          <p class="advertisement">ADVERTISEMENT</p>
          <div class="ads-here-content">
              <?=StandardAdFooter()?>
          </div>
        </div>
    </div>
    <div class="container text-footer"><p class="clear text-footer-ads" style="text-align: justify"><?=$config->site_text_footer?></p></div>
    <div class="content-footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-4">
                    <h2>Infomation</h2>
                    <ul>
                        <li><?=GetStaticPage(1)?></li>
                        <li><?=GetStaticPage(2)?></li>
                        <li><?=GetStaticPage(3)?></li>
                        <li><?=GetStaticPage(4)?></li>
                        <li><a href="{{URL()}}/sitemap">Sitemap</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-4 no-border">
                    <h2>Working With Us</h2>
                    <ul>
                        <li><?=GetStaticPage(6)?></li>
                        <li><?=GetStaticPage(7)?></li>
                        <li><?=GetStaticPage(8)?></li>
                        <li><a href="{{URL('admincp')}}">Webmasters</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <h2>Help and Support</h2>
                    <ul>
                        <li><a href="{{URL('contact')}}">Contact Us</a></li>
                        <li><a href="{{URL('infomation-fqa')}}">FAQ</a></li> 
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-footer">
        <p class="copyright">{{$config->site_copyright}}<br> {{$config->site_address}}<br>{{$config->site_phone}}</p>
        <div class="icon-footer"><img src="{{URL('public/assets/images/copyright.jpg')}}" alt="image" /></div>
    </div>
</footer>

<script src="{{URL::asset('public/assets/js/custom.js')}}"></script>
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-567a4cd765841a3c" type="text/javascript"></script>
<script src="{{URL::asset('public/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript">
$(function () {
    $('.popup-modal').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#username',
        modal: true,
    });
    $(document).on('click', '.popup-modal-dismiss', function (e) {
      e.preventDefault();
      $.magnificPopup.close();
    });
});
</script>
<div id="fb-root"></div>
<script type="text/javascript">
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en/sdk.js#xfbml=1&version=v2.4";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript">
function centerModal() {
    $(this).css('display', 'block');
    var $dialog = $(this).find(".modal-dialog");
    var offset = ($(window).height() - $dialog.height()) / 2;
    $dialog.css("margin-top", offset);
}
$('.modal').on('show.bs.modal', centerModal);
$(window).on("resize", function () {
    $('.modal:visible').each(centerModal);
});
</script>
<script src="{{URL::asset('public/assets/js/jquery.raty.min.js')}}"></script>
<script type="text/javascript">
$.fn.raty.defaults.path = '{{url("public/assets/img")}}';
$(function() {
    $('#videorating').raty({
        numberMax : 5,
        score :@if(isset($viewvideo->rating)){{$viewvideo->rating}}@else 0 @endif
    });
});
</script> 
<script src="{{URL('public/assets/js/adult.js')}}" type="text/javascript" charset="utf-8" ></script>
<script src="{{URL('public/assets/js/videoscript.js')}}" type="text/javascript" charset="utf-8" ></script>
<script src="{{URL('public/assets/js/jquery.tablesorter.min.js')}}" type="text/javascript" charset="utf-8" ></script>
<script type="text/javascript">
$(document).ready(function() { 
    $(".tablesorter").tablesorter(); 
});
</script>
<script src="{{URL('public/assets/js/ticker.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{URL('public/assets/js/jquery.uploadify-3.1.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{URL('public/assets/js/bonsai.min.js')}}"></script>
<script src="{{URL('public/assets/js/main-dev.js')}}"></script>
<script type="text/javascript">
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});
</script>
@if($config->site_ga!=NULL)<?=$config->site_ga?>@endif