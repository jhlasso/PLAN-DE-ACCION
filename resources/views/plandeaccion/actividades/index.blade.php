@extends('layouts.admin')

@section('content')

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="chart_div"></div>

@if(session()->has('msj'))
	<div class="alert alert-danger" role="alert">{{session('msj')}}</div>
@else

@endif

<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	<h3><b>ACTIVIDADES <a href="actividades/create"><button class="btn btn-success">Nuevo</button></a></b></h3>
			@include('plandeaccion.actividades.search')

</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<th>Estado</th>
					<th>Indicador</th>
					<th>Tipo</th>
					<th>Metas</th>
					<th>Fecha</th>
					<th>Presupuesto</th>
					<th>Objetivo</th>
					<th>Responsable</th>
					<th>Opciones</th>
				</thead>
				@foreach ($actividades as $ac)
				<tr>
					<td>{{$ac->nombre}}</td>
					<td>{{$ac->estado}}</td>
					<td>{{$ac->indicador}}</td>
					<td>{{$ac->tipo}}</td>
					<td>{{$ac->meta}}</td>
					<td>{{$ac->fecha}}</td>
					<td>{{$ac->presupuesto}}</td>
					<td>{{$ac->objetivos}}
					<td>{{$ac->nr}}</td>
					<td>
						
						<a href="{{URL::action('ActividadController@edit',$ac->id)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$ac->acre}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>

				@include('plandeaccion.actividades.modal')
				@endforeach

				</tr>
				
			</table>
		</div>
		{{$actividades->render()}}
	</div>
<div>	
	@push('scripts')
	<script>
		 $(document).ready(function(){
      $("#a").click(function(){
        	alert("El texto del botón es --> " + $("#a").attr("value"));

      	if($("#a").attr("value")=="1")
	{
		google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1],
        [{v: [9, 0, 0], f: '9 am'}, 2],
        [{v: [10, 0, 0], f:'10 am'}, 3],
        [{v: [11, 0, 0], f: '11 am'}, 4],
        [{v: [12, 0, 0], f: '12 pm'}, 5],
        [{v: [13, 0, 0], f: '1 pm'}, 6],
        [{v: [14, 0, 0], f: '2 pm'}, 7],
        [{v: [15, 0, 0], f: '3 pm'}, 8],
        [{v: [16, 0, 0], f: '4 pm'}, 9],
        [{v: [17, 0, 0], f: '5 pm'}, 10],
      ]);

      var options = {
        title: 'Motivation Level Throughout the Day',
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Rating (scale of 1-10)'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }
	}
      });
 });

	</script>
	@endpush

</div>

@endsection


