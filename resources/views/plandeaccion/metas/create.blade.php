@extends('layouts.admin')

@section('content')

<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Meta</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'plandeaccion/metas','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre Meta</label>
            	<input type="text" name="nombreMeta" class="form-control" placeholder="Nombre..." value="{{old ('nombreMeta')}}">
            </div>

            <div class="form-group">
            	<label for="nombre">Meta</label>
            	<input type="text" name="meta" class="form-control" placeholder="Meta..." value="{{old ('meta')}}">
            </div>

            <div class="form-group">
            	<label for="nombre">Fecha Meta</label>
            	<input type="date" name="fechaM" class="form-control" placeholder="Fecha..." value="{{old ('fechaM')}}">
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

