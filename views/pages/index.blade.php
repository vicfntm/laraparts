@extends('main')
<?php $siteName = asset(''); ?>
@section('title', "| Главная - $siteName")

@section('content')
<div class="row">
  <div class="col-md-10">
{{--     <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="{{ route('homepage') }}" class="{{ Request::is('homepage') ? "active" : "" }}"><span itemprop="name"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </span></a>
        <meta itemprop="position" content="1" />
      </li>
    </ol> --}}
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h2>Главные новости</h2>
    <div class="mark-underline"></div>
  </div>
</div>
<div class="row">
  <section class="col-md-9 col-sm-12">
    <div class="row news-main__wrapper" itemscope itemtype="http://schema.org/NewsArticle">
      <div class="col-md-5 col-sm-12 main_picture" style="background-image:url({{ $post->image=='' ? asset('/src/img' . '/' . 'thumb_noimage.png') : asset('/src/img' . '/' . 'thumb_' . $post->image) }})"></div>
      <div class="col-md-3 main_title-block">
        <h3 class="main-article_title" itemprop="name"><a class="title_link" href="{{ url('blogs/'. $post->slug)}}">{{ $post->title }}</a></h3>
        <p class="main-article_content " itemprop="articleBody"><a class="content-link" href="{{ url('blogs/'. $post->slug)}}">
          @if ($post->lead)
            {{$post->lead}}
          @else
            {{ strlen(strip_tags($post->body))>120 ? mb_substr(strip_tags($post->body), 0, 120) . '[...]' : mb_substr(strip_tags($post->body), 0, 120) }}
          @endif

        </a></p>
        <div>
          <i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>
          <span class=" post-date">{{ $post->corrected_views }}</span>
      </div>
        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
        <span class="post-date" itemprop="dateCreated">{{$post->created_at}}</span>
      </div>
      <div class="col-md-4 additional_main-block">
        <div class="row">
          <div class="col-md-12">
            {{-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}
              <!-- Tennisinfo-240х295 -->
             {{--  <ins class="adsbygoogle"
                   style="display:inline-block;width:240px;height:295px"
                   data-ad-client="ca-pub-4890038468001112"
                   data-ad-slot="4516985542"></ins>
              <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
              </script> --}}
              <a href="{{route('rg.main')}}"><img src="{{asset('src/img/roland/Frenchopen.svg')}}" alt="roland garros banner" class="img img-responsive" /></a>
          </div>
          {{-- <div class="col-md-10 col-md-offset-1 additional_main_picture" style="background-image:url('{{ $secondpost->image=='' ? asset('/src/img' . '/' . 'thumb_noimage.png') : asset('/src/img' . '/' . 'thumb_' . $secondpost->image) }}')"></div> --}}
          {{-- <div class="col-md-10 col-md-offset-1 additional_main_title">
            <h3><a class="title_link" href="{{ url('blogs/'. $secondpost->slug)}}">{{$secondpost->title}}</a></h3>
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
            <span class="post-date">{{$secondpost->created_at}}</span>
          </div> --}}

        </div>
      </div>
    </div>
    <div class="row">
      @foreach($anothermainposts as $anotherpost)
      <div class="col-sm-6 col-md-4 main_additional-news">
        <div class="thumbnail">
          <img src="{{$anotherpost->image=='' ? URL::asset('/src/img' . '/' . 'thumb_noimage.png') : URL::asset('/src/img' . '/' . 'thumb_' . $anotherpost->image) }} " alt="{{$anotherpost->title}}" class="anotherpost-img">
          <div class="caption">
            <h3 class="short-news-title"><a class="title_link" href="{{ url('blogs/'. $anotherpost->slug)}}"> {{$anotherpost->title}}</a></h3>
            <p><a class="content-link" href="{{ url('blogs/'. $anotherpost->slug)}}">
          @if ($anotherpost->lead)
            {{$anotherpost->lead}}
          @else
            {{ strlen(strip_tags($anotherpost->body))>120 ? mb_substr(strip_tags($anotherpost->body), 0, 120) . '[...]' : mb_substr(strip_tags($anotherpost->body), 0, 120) }}
          @endif
            </a></p>
          </div>
          <div class="data-wrapper text-left">
            <div>
              <i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>
              <span class=" post-date">{{ $anotherpost->corrected_views }}</span>
            </div>
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
            <span class="post-date">{{date_format($anotherpost->created_at, 'd-m-Y H:i')}}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row">
      <div class="google-ads-spacer col-md-12">
        {{-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}
        <!-- Tennisinfo-800x200 -->
       {{--  <ins class="adsbygoogle"
        style="display:inline-block;width:100%;height:200px"
        data-ad-client="ca-pub-4890038468001112"
        data-ad-slot="8337562084"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script> --}}
      </div>
    </div>
  </section>
  <aside class="col-md-3 col-sm-12">
    <div class="row">
      <div class="col-md-12">
      @include('partials._latest')
          </div>

      <div class="col-md-12">
         <a href="http://www.livescore.in/ru/" title="Livescore.in" target="_blank"><img class="img-responsive text-center" src="{{ URL::asset('/src/img/livescorelogo.jpg') }} " alt="livescore" style="margin: 0 auto"/></a>
      </div>
    </div>

  </aside>

</div>
<div class="row full-wide-banner">
  <div class="col-md-12 text-center full-wide-banner_image-container google-ads-spacer">
    {{-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}
    <!-- Tennisinfo-1065x215 -->
     {{--  <ins class="adsbygoogle"
         style="display:inline-block;width:100%;height:215px"
         data-ad-client="ca-pub-4890038468001112"
         data-ad-slot="3183160522">
      </ins>
    <script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script> --}}
    {{-- <a href="{{ url($banners->where('place_id', 1)->pluck('adv_link')->first()===null ? asset('') : $banners->where('place_id', 1)->pluck('adv_link')->first())}}" target="_blank">
  <img src="{{ URL::asset('/src/img/banners'). '/' . $banners->where('place_id', 1)->pluck('source')->first()  }}"
       alt=""
       class="img-responsive">
    </a> --}}
  </div>
</div>
<div class="row __margin-setter">
  <div class="col-md-12">
    <h3 class="category-title"><a href="{{ route('pages.uanews') }}">Украинский теннис</a></h3>
    <div class="mark-underline"></div>
    <div class="row">
      @foreach($uaposts as $uapost)
      <div class="col-md-4 __reset-padding">
        <div class="row news-brdr">
          <div class="col-md-5 ua-news-3" style="background-image:url('{{ $uapost->image=='' ? URL::asset('/src/img' . '/' . 'thumb_noimage.png') : URL::asset('/src/img' . '/' . 'thumb_' . $uapost->image) }}')"></div>
          <div class="col-md-7 category-news worldnews-wrapper">
            <h3 class="short-news-title"><a class="title_link" href="{{ url('blogs/'. $uapost->slug)}}"> {{$uapost->title}}</a></h3>
            <a class="content_link" href="{{ url('blogs/'. $uapost->slug)}}">
              <p>
              @if ($uapost->lead)
                {{$uapost->lead}}
              @else
                {{ strlen(strip_tags($uapost->body))>120 ? mb_substr(strip_tags($uapost->body), 0, 120) . '[...]' : mb_substr(strip_tags($uapost->body), 0, 120) }}
              @endif
          </p>
            </a>
            <div class="data-wrapper">
              <div>
                <i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>
                <span class=" post-date">{{ $uapost->corrected_views }}</span>
              </div>
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
            <span class="post-date">{{date_format($uapost->created_at, 'd-m-Y H:i')}}</span>
            </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="row __margin-setter">
    <div class="col-md-12">
      <h3 class="category-title"><a href="{{ route('pages.worldnews') }}">  Новости мирового тенниса</a></h3>
      <div class="mark-underline"></div>
      <div class="row">
        @foreach($worldposts as $worldpost)
        <div class="col-md-4 __reset-padding">
          <div class="row news-brdr">
            <div class="col-md-5 ua-news-2" style="background-image:url('{{ $worldpost->image=='' ? URL::asset('/src/img' . '/' . 'thumb_noimage.png') : URL::asset('/src/img' . '/' . 'thumb_' . $worldpost->image) }}')"></div>
            <div class="col-md-7 worldnews-wrapper category-news">
              <h3 class="short-news-title"><a class="title_link" href="{{ url('blogs/'. $worldpost->slug)}}"> {{$worldpost->title}}</a></h3>
              <a class="content_link" href="{{ url('blogs/'. $worldpost->slug)}}">
                <p>
                  @if ($worldpost->lead)
                    {{$worldpost->lead}}
                  @else
                    {{ strlen(strip_tags($worldpost->body))>120 ? mb_substr(strip_tags($worldpost->body), 0, 120) . '[...]' : mb_substr(strip_tags($worldpost->body), 0, 120) }}
                  @endif
                </p>
              </a>
              <div class="data-wrapper">
                <div>
                 <i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>
                 <span class=" post-date">{{ $worldpost->corrected_views }}</span>
                </div>
              <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
              <span class="post-date">{{date_format($worldpost->created_at, 'd-m-Y H:i')}}</span>
              </div></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
      <div class="row __margin-setter">
    <div class="col-md-12">
      <h3 class="category-title"><a href="{{ route('pages.offcourt') }}">  Новости off корт</a></h3>
      <div class="mark-underline"></div>
      <div class="row">
        @foreach($offcourt_news as $single_oc)
        <div class="col-md-4 __reset-padding">
          <div class="row news-brdr">
            <div class="col-md-5 ua-news-2" style="background-image:url('{{ $single_oc->image=='' ? URL::asset('/src/img' . '/' . 'thumb_noimage.png') : URL::asset('/src/img' . '/' . 'thumb_' . $single_oc->image) }}')"></div>
            <div class="col-md-7 worldnews-wrapper category-news">
              <h3 class="short-news-title"><a class="title_link" href="{{ url('blogs/'. $single_oc->slug)}}"> {{$single_oc->title}}</a></h3>
              <a class="content_link" href="{{ url('blogs/'. $single_oc->slug)}}">
                <p>
                  @if ($single_oc->lead)
                    {{$single_oc->lead}}
                  @else
                    {{ strlen(strip_tags($single_oc->body))>120 ? mb_substr(strip_tags($single_oc->body), 0, 120) . '[...]' : mb_substr(strip_tags($single_oc->body), 0, 120) }}
                  @endif
                </p>
              </a>
              <div class="data-wrapper">
                <div>
                 <i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>
                 <span class=" post-date">{{ $single_oc->corrected_views }}</span>
                </div>
              <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
              <span class="post-date">{{date_format($single_oc->created_at, 'd-m-Y H:i')}}</span>
              </div></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="row full-wide-banner">
      <div class="col-md-12 full-wide-banner_image-container">
        {{-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}
          <!-- Tennisinfo-1080x265 -->
         {{--  <ins class="adsbygoogle"
               style="display:inline-block;width:100%;height:265px"
               data-ad-client="ca-pub-4890038468001112"
               data-ad-slot="5151327244"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script> --}}
        {{-- <a href="{{ url($banners->where('place_id', 2)->pluck('adv_link')->first()===null ? asset('') :
        $banners->where('place_id', 2)->pluck('adv_link')->first())}}" target="_blank">
          <img src="{{ URL::asset('/src/img/banners'). '/' . $banners->where('place_id', 2)->pluck('source')->first()
           }}" alt="" class="img-responsive">
        </a> --}}
      </div>
    </div>
    @endsection

    @section('scripts')
      


    @endsection