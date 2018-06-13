@extends('main')
@section('title', 'редактирование корта')
@section('styles')

<link rel="stylesheet" href="{{ URL::asset('css/parsley.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/select2.css') }}" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.6.6/tinymce.min.js"></script>
<script>
var editor_config = {
path_absolute : "/",
selector: "textarea.my-editor",
plugins: [
"advlist autolink autoresize lists link image charmap print preview hr anchor pagebreak",
"searchreplace wordcount visualblocks visualchars code fullscreen",
"insertdatetime media nonbreaking save table contextmenu directionality",
"emoticons template paste textcolor colorpicker textpattern"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
relative_urls: false,
image_dimensions: false,
image_class_list: [
    {title: 'Responsive', value: 'img-responsive'}
    ],
file_browser_callback : function(field_name, url, type, win) {
var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
if (type == 'image') {
cmsURL = cmsURL + "&type=Images";
} else {
cmsURL = cmsURL + "&type=Files";
}
tinyMCE.activeEditor.windowManager.open({
file : cmsURL,
title : 'Filemanager',
width : x * 0.8,
height : y * 0.8,
resizable : "yes",
close_previous : "no"
});
}
};
tinymce.init(editor_config);
</script>
@endsection
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<h1>редактирование корта</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-8">
				{!! Form::model($court, ['route' => ['editcourts.update', $court->id], 'method'=>'PUT', 'files'=>true]) !!}
				{{ Form::label('name', 'название клуба') }}
				{{ Form::text('name', null, ['class'=> 'form-control form_create', 'required', 'maxlength'=>'255']) }}
				{{ Form::label('slug', 'SEO слаг') }}<span class="glyphicon glyphicon-question-sign" aria-hidden="true" title="Редактирование слага для отображения в строке браузера. Минимум 5 знаков, максимум - 255"></span>
				{{ Form::text('slug', null, ['class'=> 'form-control', 'maxlength'=>'255']) }}
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

				{{ Form::label('courtcategory_id', 'Выберите категорию корта') }}
				{{ Form::select('courtcategory_id', $categories, null, ['class'=>'form-control'])}}

				{{ Form::label('description', 'описание корта') }}
				{{ Form::textarea('description', null, ['class'=>'form-control my-editor', 'rows'=>'20']) }}

				{{ Form::label('image', 'Загрузите иконку для записи') }}
				{{ Form::file('image') }}
				{{  Form::label('seo_description', 'SEO description') }}
				{{  Form::text('seo_description', null, ['class'=>'form-control', 'maxlength'=>'255']) }}
				{{  Form::label('seo_keywords', 'SEO ключевые слова') }}
				{{  Form::text('seo_keywords', null, ['class'=>'form-control', 'maxlength'=>'255']) }}
				<hr>
				<div class="col-md-4"></div>
			</div>
			<div class="col-md-4">
				<div class="well">
					<div class="dl-horizontal">
						<dt>Слаг: </dt>
						<dd>{{ $court->slug }}</dd>
					</div>
					<div class="dl-horizontal">
						<dt>Created At: </dt>
						<dd>{{ date('j M Y H:i', strtotime($court->created_at)) }}</dd>
					</div>
					<div class="dl-horizontal">
						<dt>Last updated: </dt>
						<dd>{{ date('j M Y H:i', strtotime($court->updated_at)) }}</dd>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-6">
							{!! Html::linkRoute('editcourts.show', 'Отменить', array($court->id), array('class'=>'btn btn-danger btn-block') )  !!}
						</div>
						<div class="col-sm-6">
							{{ Form::submit('Сохранить', ['class'=> 'btn btn-success btn-block']) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
	$('.select2-multi').select2();
	$(document).ready(function(){
		$('#leadlength').text('120');
		$('#lead')
		.bind('keyup', function(){
			var itemlen = 120 - $(this).val().length;
			$('#leadlength').text(itemlen);
		})
	});
</script>
@endsection