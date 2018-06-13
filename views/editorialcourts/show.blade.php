@extends('main')

@section('title', '| Корт')


@section('content')
<div class="row">
	<div class="col-md-12">
	<div class="row top-spacer">
		<div class="col-md-8">
			<h1>{!! $court->name !!}</h1>
			<div class="lead">{{ $court->courtcategory->category }}</div>

			<div class="lead">{!! $court->description !!}</div>
			<hr>
			<div class="lead"><img class="img-responsive" src="{!! asset('public/src/img' . '/' . $court->image) !!}"></img></div>
			<hr>
			<div class="col-md-12">
			
			
				<br>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<div class="">
		    		<dt>Создан: </dt>
		    		<dd>{{ date('j M Y H:i', strtotime($court->created_at)) }}</dd>
    			</div>
    			<div class="">
					<dt>Последнее обновление: </dt>
    				<dd>{{ date('j M Y H:i', strtotime($court->updated_at)) }}</dd>
				</div>
				<hr>
				<div class="row">
			    	<div class="col-sm-7">
					{!! Html::linkRoute('editcourts.edit', 'Редактировать', array($court->id), array('class'=>'btn btn-primary btn-block') )  !!}
					</div>
					<div class="col-sm-5">

			        {!! Form::open(['route'=>['editcourts.delete', $court->id], 'method'=>'DELETE']) !!}
			        {!! Form::submit('Удалить', ['class'=>'btn btn-danger btn-block']) !!}
			        {!! Form::close() !!}


			    	</div>
			    </div>
			</div>
		</div>
	</div>
	</div>
	</div>


@endsection