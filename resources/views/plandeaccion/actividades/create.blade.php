@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3><b>Nueva Actividad<b></h3>
   @if (count($errors)>0)
   <div class="alert alert-danger">
    <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
    </ul>
</div>
@endif

{!!Form::open(array('url'=>'plandeaccion/actividades','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}

<div class="row">
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                  <label>Objetivo</label>
                  <select name="objetivo_id" class="form-control">
                        @foreach ($objetivos as $ob)
                        <option value="{{$ob->id}}">{{$ob->nombre}}</option>
                        @endforeach
                  </select>    
            </div>
      </div>

      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombreActividad" class="form-control" required placeholder="Nombre..." value="{{old ('nombreActividad')}}">
            </div>
      </div>

      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
             <label for="estado">Estado</label>
               <input type="text" name="estado" class="form-control" required value="Iniciado" readonly="readonly"> 
            </div>
      </div>

      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
             <label for="indicador">Indicador</label>
             <input type="text" name="indicador" class="form-control" required placeholder="Indicador..." value="{{old ('indicador')}}">
            </div>
      </div>

      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
             <label for="tipo">Tipo</label>
             <input type="text" name="tipo" class="form-control" required placeholder="Tipo..." value="{{old ('tipo')}}">
            </div>
      </div>


      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
             <label for="presupuesto">Presupuesto</label>
             <input type="text" name="presupuesto" class="form-control" required placeholder="Presupuesto..." value="{{old ('presupuesto')}}">
            </div>
      </div>
</div>

<div class="row">
            <div class="panel panel-primary">
                  <div class="panel-body">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                              <div class="form-group">
                              <label>Responsable</label>
                              <select name="aux_responsable_id" class="form-control" id="aux_responsable_id">
                                   @foreach($responsables as $responsable)
                                   <option value="{{$responsable->id}}">{{$responsable->responsable}}</option>
                                   @endforeach 
                              </select>   
                              </div>
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                              <div class="form-group">
                               <button class="btn btn-primary" id="bt_add" type="button">Agregar</button>
                              </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                              <table id="list" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #A9D0F5">
                                    <th>Opciones</th>
                                    <th>Responsable</th>     
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                    
                              </table>
                        </div>
                  </div> 
            </div>

            

</div>


<div class="row">
            <div class="panel panel-primary">
                  <div class="panel-body">
                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                              <div class="form-group">
                              <label>Meta</label>
                              <select name="aux_meta_id" class="form-control" id="aux_meta_id">
                                   @foreach($metas as $meta)
                                   <option value="{{$meta->id}}">{{$meta->meta}}--{{$meta->fecha}}</option>
                                   @endforeach 
                              </select>   
                              </div>
                        </div>

                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                              <div class="form-group">
                               <button class="btn btn-primary" id="bt_add1" type="button">Agregar</button>
                              </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                              <table id="list1" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #A9D0F5">
                                    <th>Opciones</th>
                                    <th>Meta</th>  
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                    
                              </table>
                        </div>
                  </div> 
            </div>

            

</div>

<div class="form-group">
    <button class="btn btn-primary" type="submit">Guardar</button>
    <button class="btn btn-danger" type="reset">Limpiar</button>
    <form>
    <input type="button" class="btn btn-primary" value="Atrás" name="volver atrás2" onclick="history.back()" /></form>
</div>


{!!Form::close()!!}		

</div>
</div>

@push('scripts')
<script>
 $(document).ready(function(){
      $('#bt_add').click(function(){
            agregar();
      });
       $('#bt_add1').click(function(){
            agregar1();
      });
 });

 var cont=0;
 var cont1=0;

function agregar()
{
      aux_responsable_id = $("#aux_responsable_id").val();
      responsable=$("#aux_responsable_id option:selected").text();

      if(aux_responsable_id!="")
      {
            var fila = '<tr class=selected id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idresponsables[]" value="'+aux_responsable_id+'">'+responsable+'</td></tr>';
            cont++;
            $('#list').append(fila);
      }
      else
      {
            alert("Error al ingresar el responsable, revise los datos del responsable");
      }
}

function agregar1()
{
      aux_meta_id = $("#aux_meta_id").val();
      meta=$("#aux_meta_id option:selected").text();

      if(aux_meta_id!="")
      {
            var fila1 = '<tr class=selected id="fila1'+cont1+'"><td><button type="button" class="btn btn-warning" onclick="eliminar1('+cont1+');">X</button></td><td><input type="hidden" name="idmetas[]" value="'+aux_meta_id+'">'+meta+'</td></tr>';
            cont1++;
            $('#list1').append(fila1);
      }
      else
      {
            alert("Error al ingresar el responsable, revise los datos del responsable");
      }
}

function eliminar(index)
{
      $("#fila" + index).remove();
}

function eliminar1(index)
{
      $("#fila1" + index).remove();
}

</script>
@endpush

@endsection

