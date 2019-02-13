@extends('layouts.admin')

@section('content')

<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Objetivo</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'plandeaccion/objetivos','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

            <div class="form-group">
            	<label for="plan_id">Plan al que pertenece</label><br>

            	<select name="plan_id" class="form-control">
            		@foreach ($planes as $pl)
            		<option value="{{$pl->id}}">{{$pl->nombre}}</option>
            		@endforeach
            	</select>
            </div>

            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombreObjetivo" class="form-control" required placeholder="Nombre..." value="{{old ('nombreObjetivo')}}">
            </div>

           
            <div class="form-group">
                  <button class="btn btn-primary" type="submit">Guardar</button>
                  <button class="btn btn-danger" type="reset">Limpiar</button>
                <form>
                    <input type="button" class="btn btn-primary" value="Atrás" name="volver atrás2" onclick="history.back()" /> </form>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>

@endsection

