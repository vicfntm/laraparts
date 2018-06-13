    </div>
  </div>
</div>
</div>
<footer>
<div class="container">
<div class="row">
<div class="col-md-4 col-sm-6 footerleft">
  <div class="logofooter"> Logo</div>
  <p></p>
  <p><i class="fa fa-map-pin"></i> </p>
{{--   <p><i class="fa fa-phone"></i> Телефон: +38 999 878 398</p>
  <p><i class="fa fa-envelope"></i> E-mail : info@tennispro.com</p> --}}
</div>
<div class="col-md-2 col-sm-6 paddingtop-bottom">
  <div class="heading7">Полезные ресурсы</div>
  <ul class="footer-ul">
    <li><a href="#"> ATP</a></li>
    <li><a href="#"> WTA</a></li>
    <li><a href="http://www.livescore.in/ru/" title="Livescore.in" target="_blank">Livescore.in</a></li>
  </ul>
</div>
<div class="col-md-3 col-sm-6 paddingtop-bottom">
  <div class="heading7">Последние статьи</div>
  @foreach($news_chunk as $news)
  <div class="post">
    <p>
      <a href="{{route('blogs.single', $news->slug)}}">
        {{ mb_substr($news->title, 0, 50) }}{{ strlen($news->title) > 50 ? '...' : '' }}
      </a>
      <span>{{$news->created_at}}</span></p>
    </div>
    @endforeach
  </div>
  <div class="col-md-3 col-sm-6 paddingtop-bottom">
    <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
      <div class="fb-xfbml-parse-ignore">
        <blockquote cite="https://www.facebook.com/tennisinfocomua-1726289677382603/"><a href="https://www.facebook.com/tennisinfocomua-1726289677382603/" target="_blank">Facebook</a></blockquote>
      </div>
      <div class="fb-xfbml-parse-ignore">
        {{-- <blockquote cite="googleplus.com"><a href="googleplus.com">Google +</a></blockquote> --}}
      </div>
    </div>
  </div>
</div>
</div>
</footer>
<!--footer start from here-->
<div class="copyright" id="contact-form_close">
<div class="container">
<div class="col-md-6">
  <p>&copy; 
  @php
    echo date('Y');
  @endphp - Все права защищены</p>
</div>
<div class="col-md-6">
  <ul class="bottom_ul">
    @include('partials._contactform')
    <li><a href="#">О нас</a></li>
    <li><a href="#">Новости</a></li>
    <li><a class="__onfocusedelement" id="contactform" v-on:click="switchmodal()" >Контакты</a></li>
    <li><a href="{{ route('sitemap') }}">Карта сайта</a></li>
  </ul>
</div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
<!-- Include all compiled plugins (below), or include individual files as needed -->
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script type="text/javascript" src="{{ asset('js/eventscripts.js') . '?ver=' . filemtime('js/eventscripts.js')}}"></script>
    <script src="{{ asset('js/app.js')  . '?ver=' . filemtime('js/app.js')}}"></script>
    <script type="text/javascript">
  $(document).ready(function() {
    var menuHeight;
$('#sandwich').click(function(){
  $('body').toggleClass('menuMobileOpen');
  menuHeight = $('.menuMobileOpen .links-wrapper').height();
  $(' .top-row')
    .parent()
    .toggle()
    .attr('style', 'margin-top:'+ 0 + 'px');
  $('.menuMobileOpen .top-row')
    .parent()
    .toggle()
    .attr('style', 'margin-top:'+ menuHeight + 'px');
});
$(window).resize(function(){
   if ($(window).width()>576) {
  $('.menuMobileOpen')
    .removeClass('menuMobileOpen');
  $('.top-row')
    .parent()
    .attr('style', 'margin-top:', '0px');
 }
});

$('.submenu-wrapper').click(function() {
    $(this).toggleClass('submenuMobileActivation');
  });
$('.link.submenu-wrapper').click(function(){
  var updHeight = $('.links-wrapper').height();
  console.log(updHeight);
  $('.menuMobileOpen .top-row').parent().attr('style', 'margin-top:'+ updHeight + 'px');
});
localStorage.setItem('isClicked', 1);
$('.submenu-container').click(function(){
  $('.desktop-submenu-elements').removeAttr('style');
  if (localStorage.isClicked == 1){
    $(this).children('.desktop-submenu-elements').attr('style', 'display:block; top: 5rem;');
    localStorage.setItem('isClicked', 0);
  }
  else{
    $('.desktop-submenu-elements').removeAttr('style');
    localStorage.setItem('isClicked', 1);
  }
  $('.navbar-item-single').click(function(){
    $('.desktop-submenu-elements').removeAttr('style');
  });

});
$('.desktop-search-close').click(function(){
  $('.submenu-container').removeClass('_search-active');
});
$('.glyphicon-search').click(function(){
  $('.submenu-container').addClass('_search-active');
});

  });
</script>

@yield('scripts')
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
    </script>
</body>

</html>