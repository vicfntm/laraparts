@extends('main')

@section('title', '| Создание корта')

@section('styles')
	{!! Html::style('public/css/parsley.css') !!}
	{!! Html::style('public/css/select2.css') !!}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.6.6/tinymce.min.js"></script>
	<script>

	tinymce.init({ 
		selector:'textarea',
		plugins: ['link', 'textcolor', 'image', 'code'],
		menubar: false,
		toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor | code ',
		content_css : '{!! asset('css/style_min.css') !!}' });
	</script>
@endsection

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2 article-wrapper">
	<div class="panel panel-info">
		<div class="panel-heading">Создание корта</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['route'=>'editcourts.store', 'data-parsley-validate'=>'', 'files'=>true]) }}

		{{ Form::label('name', 'название клуба') }}
		{{ Form::text('name', null, ['class'=>'form-control form_create', 'required', 'maxlength'=>'255']) }}

		{{ Form::label('slug', 'SEO слаг') }}
		{{ Form::text('slug', null, ['class'=>'form-control', 'maxlength'=>'255']) }}

		{{ Form::label('city', 'Город') }}
		{{ Form::text('city', null, ['class'=>'form-control', 'maxlength'=>'255']) }}

		{{ Form::label('address', 'Адрес') }}
		{{ Form::text('address', null, ['class'=>'form-control', 'maxlength'=>'255']) }}

		{{ Form::label('courtcover', 'Тип покрытия') }}
		{{ Form::text('courtcover', null, ['class'=>'form-control', 'maxlength'=>'255']) }}

		{{ Form::label('courtamount', 'Количество кортов') }}
		{{ Form::text('courtamount', null, ['class'=>'form-control', 'maxlength'=>'255']) }}

		{{ Form::label('contacts', 'Контакты') }}
		{{ Form::text('contacts', null, ['class'=>'form-control', 'maxlength'=>'255']) }}

		{{ Form::label('website', 'Website') }}
		{{ Form::text('website', null, ['class'=>'form-control', 'maxlength'=>'255']) }}

		{{ Form::label('courtcategory_id', 'Выберите категорию корта')}}
		<select class="form-control" name="courtcategory_id">
			@foreach($cats as $courtCategory)
			<option value='{{ $courtCategory->id }}'>{{ $courtCategory->category }}</option>
			@endforeach
		</select>

		{{  Form::label('description', 'описание корта') }}
		{{  Form::textarea('description', null, ['class'=>'form-control my-editor', 'rows'=>'20', 'maxlength'=>'5000']) }}

		{{ Form::label('image', 'Загрузите иконку для записи') }}
		{{ Form::file('image') }}

		{{  Form::label('seo_description', 'SEO description') }}
		{{  Form::text('seo_description', null, ['class'=>'form-control', 'maxlength'=>'255']) }}

		{{  Form::label('seo_keywords', 'SEO ключевые слова') }}
		{{  Form::text('seo_keywords', null, ['class'=>'form-control', 'maxlength'=>'255']) }}
		<br>

		{{  Form::submit('Создать', ['class'=>'btn btn-success btn-large btn-block form_submit-button'])  }}
		{{ Form::close() }}
	</div>
	</div>
</div>


@endsection

@section('scripts')

{!! Html::script('public/js/parsley.min.js') !!}
{!! Html::script('public/js/select2.min.js') !!}

<script type="text/javascript">
	$('.select2-multi').select2();
</script>

@endsection