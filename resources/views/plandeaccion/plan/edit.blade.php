@extends('layouts.admin')

@section('content')

<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3><b>Editar Plan De Accion: {{$plan->nombre}}</b></h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($plan,['method'=>'PATCH','route'=>['plan.update',$plan->id]])!!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombrePlan" class="form-control" value="{{$plan->nombre}}">
            </div>

            <div class="form-group">
                <label for="nombre">Fecha Inicial</label>
                <input type="date" name="fechaI" class="form-control"  value="{{$plan->fecha_inicio}}">
            </div>

             <div class="form-group">
                <label for="nombre">Fecha Final</label>
                <input type="date" name="fechaF" class="form-control" value="{{$plan->fecha_final}}">
            </div>
            
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <form>
                    <input type="button" class="btn btn-primary" value="Atrás" name="volver atrás2" onclick="history.back()" />    </form>
            </div>

            {!!Form::close()!!}     
            
        </div>
    </div>
@endsection

