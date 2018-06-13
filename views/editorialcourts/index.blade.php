@extends('main')

@section('title', '| Все корты')
@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-1">
		<h1>Все корты</h1>
	</div>
	<div class="col-md-2">
		<a href="{{route('editcourts.create')}}" class="btn btn-lg btn-block btn-primary btn-h1-spacing" style="margin-top:20px">Создать новый</a>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-1">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<table class="table">
			<thead>			
				<th>#</th>
				<th>название клуба</th>
				<th>город</th>
				<th>категория</th>
				<th></th>
			</thead>
		<tbody>
		@foreach ($courts as $court)
			<tr>
				<th>{{ $court->id }}</th>
				<td style="width:20%">{{ strip_tags($court->name) }} </td>
				<td>{{ $court->city}}</td>
				<td>{{ $court->courtcategory->category }}</td>
				<td style="width:20%">
				<a href="{{ route('editcourts.show', $court->id) }}" class="btn btn-success btn-sm" style="width:30%; margin:0"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>

				<a href="{{ route('editcourts.edit', $court->id) }}" class="btn btn-primary btn-sm" style="width:30%"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

				<a href="{{ route('editcourts.delete', $court->id) }}" class="btn btn-danger btn-sm" style="width:30%"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
				</td>

			</tr>
		@endforeach

		</tbody>
		</table>
		<div class="text-center">
			{!! $courts->links(); !!}
		</div>
	</div>
</div>

@endsection

