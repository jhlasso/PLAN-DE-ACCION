@extends('layouts.admin')

@section('content')

<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Plan de accion</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'plandeaccion/plan','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombrePlan" class="form-control" required placeholder="Nombre..." value="{{old ('nombrePlan')}}">
            </div>

             <div class="form-group">
            	<label for="fechaI">Fecha Inicial</label>
            	<input type="date" name="fechaI" class="form-control" required value="{{old ('fechaI')}}">
            </div>

             <div class="form-group">
            	<label for="fechaF">Fecha Final</label>
            	<input type="date" name="fechaF" class="form-control" required value="{{old ('fechaF')}}">
            </div>

        
           
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Limpiar</button>
                <form>
                    <input type="button" class="btn btn-primary" value="Atrás" name="volver atrás2" onclick="history.back()" />    </form>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>

@endsection

