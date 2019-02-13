@extends('layouts.admin')

@section('content')

<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3><b>Editar Actividad: {{$actividad->nombre}}</b></h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($actividad,['method'=>'PATCH','route'=>['actividades.update',$actividad->id]])!!}
            {{Form::token()}}

           <div class="row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                  <label>Objetivo</label>
                  <select name="objetivo_id" class="form-control">
                        @foreach ($objetivos as $ob)
                            @if ($ob->id==$actividad->objetivo_id)
                            <option value="{{$ob->id}}" selected="$ob->id">{{$ob->nombre}}</option>
                            @else
                            <option value="{{$ob->id}}">{{$ob->nombre}}</option>
                            @endif
                        @endforeach
                  </select>    
            </div>
      </div>

      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombreActividad" class="form-control" value="{{$actividad->nombre}}">
            </div>
      </div>

       <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
             <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" class="form-control" value="{{$actividad->estado}}" readonly="readonly">
          </div>
      </div>

      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
             <label for="indicador">Indicador</label>
             <input type="text" name="indicador" class="form-control" value="{{$actividad->indicador}}">
            </div>
      </div>

      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
             <label for="tipo">Tipo</label>
             <input type="text" name="tipo" class="form-control" value="{{$actividad->tipo}}">
            </div>
      </div>

      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
             <label for="presupuesto">Presupuesto</label>
             <input type="text" name="presupuesto" class="form-control" value="{{$actividad->presupuesto}}"">
            </div>
      </div>

</div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <form>
                    <input type="button" class="btn btn-primary" value="Atrás" name="volver atrás2" onclick="history.back()" />    </form>
                <button class="btn btn-primary" type="button" id="button">Cambiar Estado</button>
            </div>

            {!!Form::close()!!}     
            
        </div>
    </div>



@endsection



@push('scripts')
<script>

  $(document).ready(function(){
      $('#button').click(function(){
            agregar();
      });
 });
  function agregar()
  {
    if($("#estado").val()=="Iniciado")
    {
     $("#estado").val("En Ejecucion"); 
    }
    else 
    {
      $("#estado").val("Terminado");   
    }
  }

 </script>
 @endpush