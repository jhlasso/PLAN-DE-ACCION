@extends('layouts.admin')

@section('content')

@if(session()->has('msj'))
	<div class="alert alert-danger" role="alert">{{session('msj')}}</div>
@else

@endif

<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	<h3><b>METAS <a href="metas/create"><button class="btn btn-success">Nuevo</button></a></b></h3>
		@include('plandeaccion.metas.search')
</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Identificador</th>
					<th>Nombre</th>
					<th>Meta</th>
					<th>Fecha</th>
					<th>Opciones</th>
				</thead>
				@foreach ($metas as $met)
				<tr>
					<td>{{$met->id}}</td>
					<td>{{$met->nombre}}</td>
					<td>{{$met->meta}}</td>
					<td>{{$met->fecha}}</td>
					<td>
						<a href="{{URL::action('MetaController@edit',$met->id)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$met->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('plandeaccion.metas.modal')
				@endforeach
			</table>
		</div>
		{{$metas->render()}}
	</div>
</div>

@endsection
