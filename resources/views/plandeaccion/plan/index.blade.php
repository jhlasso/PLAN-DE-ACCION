@extends('layouts.admin')

@section('content')

@if(session()->has('msj'))
  <div class="alert alert-danger" role="alert">{{session('msj')}}</div>
@else

@endif

<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
  <h3><b>PLANES DE ACCION <a href="plan/create"><button class="btn btn-success">Nuevo</button></a></b></h3>
    @include('plandeaccion.plan.search')
</div>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>Identificador</th>
          <th>Nombre</th>
          <th>Fecha Inicion</th>
          <th>Fecha Final</th>
          <th>Opciones</th>
        </thead>
        @foreach ($planes as $pl)
        <tr>
          <td>{{$pl->id}}</td>
          <td>{{$pl->nombre}}</td>
          <td>{{$pl->fecha_inicio}}</td>
          <td>{{$pl->fecha_final}}</td>
          <td>
            <a href="{{URL::action('PlanDeAccionController@edit',$pl->id)}}"><button class="btn btn-info">Editar</button></a>
            <a href="" data-target="#modal-delete-{{$pl->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
          </td>
        </tr>
        @include('plandeaccion.plan.modal')
        @endforeach
      </table>
    </div>
    {{$planes->render()}}
  </div>
</div>

@endsection
