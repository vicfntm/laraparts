@extends('main')
<?php $siteName = asset(''); ?>
@section('title', "| Фотогаллереи - $siteName")
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.modallery.min.css')}}">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="{{ route('homepage') }}" class="{{ Request::is('homepage') ? "active" : "" }}">
					<span itemprop="name" class="glyphicon glyphicon-home" aria-hidden="true"></span>
				</a>
				<meta itemprop="position" content="1" />
			</li>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="{{ route('pics') }}" class="{{ Request::is('pics') ? "active" : "" }}">
					<span itemprop="name">Изображения</span>
				</a>
				<meta itemprop="position" content="2" />
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-10">
	</div>
</div>
@foreach ($albums as $album)
@if ($album->images->count() > 0)
<div class="row">
	<div class="col-md-12">
		<h2>{{ $album->title }}</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			@foreach ($album->images as $element)
			<div class=" col-xs-12  col-sm-6 col-md-4 col-lg-3">
				<img src="{{ URL::asset('/src/img' . '/' . 'thumb_' . $element->pictureUniqueName) }}" data-to="{{ URL::asset('/src/img' . '/' . $element->pictureUniqueName) }}"
					 data-caption="{{ $element->title }}" class="img img-responsive modallery thumbnail thumbnail-mod" title="{{ $element->title }}"
					style="min-height:180px">
			</div>
			@endforeach
		</div>
	</div>
</div>
@endif
@endforeach
<div class="row">
	<div class="col-md-12 text-center">
		{!! $albums->links(); !!}
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('/js/bootstrap.modallery.min.js') }}">
</script>
<script type="text/javascript">
$(document).modallery({title: ''});
</script>
@endsection