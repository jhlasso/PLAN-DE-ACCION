@extends('layouts.admin')

@section('content')

@if(session()->has('msj'))
	<div class="alert alert-danger" role="alert">{{session('msj')}}</div>
@else

@endif

<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	<h3><b>OBJETIVOS <a href="objetivos/create"><button class="btn btn-success">Nuevo</button></a></b></h3>
			@include('plandeaccion.objetivos.search')

</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Identificador</th>
					<th>Nombre</th>
					<th>Plan</th>
					<th>Opciones</th>
				</thead>
				@foreach ($objetivos as $ob)
				<tr>
					<td>{{$ob->id}}</td>
					<td>{{$ob->nombre}}</td>
					<td>{{$ob->plan}}</td>
					<td>
						<a href="{{URL::action('ObjetivoController@edit',$ob->id)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$ob->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('plandeaccion.objetivos.modal')
				@endforeach
			</table>
		</div>
		{{$objetivos->render()}}
	</div>
</div>

@endsection
