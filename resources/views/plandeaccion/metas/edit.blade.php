@extends('layouts.admin')

@section('content')

<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3><b>Editar Meta: {{$meta->nombre}}</b></h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($meta,['method'=>'PATCH','route'=>['metas.update',$meta->id]])!!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombreMeta" class="form-control" required value="{{$meta->nombre}}">
            </div>

            <div class="form-group">
                <label for="nombre">Meta</label>
                <input type="text" name="meta" class="form-control" required value="{{$meta->meta}}">
            </div>

            <div class="form-group">
                <label for="nombre">Fecha Meta</label>
                <input type="date" name="fechaM" class="form-control" required value="{{$meta->fecha}}">
            </div>

            <div class="form-group">
                <label for="nombre">Cumplido</label>
                <input type="text" name="cumplido" class="form-control" value="{{$meta->cumplido}}" >
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

