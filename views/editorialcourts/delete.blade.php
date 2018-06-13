@extends('main')

@section('title', "| удаление корта")


@section('content')

	<h1 class="text-center">Вы действительно хотите удалить корт?</h1>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<strong> {{ $court->name }} </strong>
			<br>
			<hr>

			{{ Form::open(['route'=>['editcourts.destroy', $court->id], 'method'=>'DELETE']) }}

				{{ Form::submit('ДА, удалить окончательно', ['class'=>'btn btn-danger', 'style'=>'margin:2rem 0']) }}

			{{ Form::close() }}

		</div>
	</div>

@endsection