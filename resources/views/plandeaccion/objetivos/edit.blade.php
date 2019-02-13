@extends('layouts.admin')

@section('content')

<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3><b>Editar Plan De Accion: {{$objetivo->nombre}}</b></h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($objetivo,['method'=>'PATCH','route'=>['objetivos.update',$objetivo->id]])!!}
            {{Form::token()}}

            <div class="form-group">
            	<label for="plan_id">Plan</label><br>

            	<select name="plan_id" class="form-control">
                    @foreach ($planes as $pl)
                        @if($pl->id==$objetivo->plan_id)
                        <option value="{{$pl->id}}" selected="$pl->id">{{$pl->nombre}}</option>
                        @else
                        <option value="{{$pl->id}}">{{$pl->nombre}}</option> 
                        @endif                
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombreObjetivo" class="form-control" value="{{$objetivo->nombre}}">
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

