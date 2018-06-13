<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">

<head>
  <meta charset="utf-8">
  <meta name="robots" content="index, nofollow">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> --}}
{{--google verification--}}
  {{--<meta name="google-site-verification" content="EXCQPw7c4JuqLhjjW5OWvveZ4ltQedOqxNN9eeUmesM" />--}}
  {{--yandex verification--}}
  {{--<meta name="yandex-verification" content="74884e6f37b2d167" />--}}
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @yield('descriptiontag')
  @yield('keywords')
  @yield('fb')
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>@yield('title')</title>
  <link rel='shortcut icon' type='image/x-icon' href='{{ URL::asset('/src/img' . '/' . 'favicon.ico') }}' />
  <link rel="apple-touch-icon-precomposed" href='{{ URL::asset('/src/img' . '/' . 'favicon.ico') }}' />
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style_min_1.css') . '?ver=' . filemtime('css/style_min_1.css') }}">
  {{--google--}}
  {{--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
{{--<script>--}}
     {{--(adsbygoogle = window.adsbygoogle || []).push({--}}
          {{--google_ad_client: "ca-pub-9751160887753488",--}}
          {{--enable_page_level_ads: true--}}
     {{--});--}}
{{--</script>--}}
  @yield('styles')

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
{{--google--}}
{{--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-100145319-2"></script>--}}
{{--<script>--}}
  {{--window.dataLayer = window.dataLayer || [];--}}
  {{--function gtag(){dataLayer.push(arguments);}--}}
  {{--gtag('js', new Date());--}}

  {{--gtag('config', 'UA-100145319-2');--}}
{{--</script>--}}
  <script type="text/javascript">
      var onloadCallback = function() {
    if ( $('#contactformcaptcha').length ) {
        grecaptcha.render('contactformcaptcha', {'sitekey' : '6Lf-8zkUAAAAAJdV32BN02dQ8Wjh3uMWkABdgTxF'
        });
    }
    if ( $('#postcommentcaptcha').length ) {
       grecaptcha.render('postcommentcaptcha', {'sitekey' : '6Lf-8zkUAAAAAJdV32BN02dQ8Wjh3uMWkABdgTxF'
       });
    }
};
  </script>
  {{--yandex--}}
  {{--<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>--}}
</head>

<body>
