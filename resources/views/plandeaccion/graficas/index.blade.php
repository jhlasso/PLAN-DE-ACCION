@extends('layouts.admin')

@section('content')

<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
  <h3><b>GRAFICAS
    @include('plandeaccion.graficas.search')
</div>
</div>


<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tiempo', 'Metas', 'Cumplido'],
          @foreach ($actividades as $ac)
          [  {{substr($ac->miFecha ,0,-6)}}, {{ $ac->meta}},{{ $ac->cumplido}}],
          @endforeach
        ]);

        var options = {
          title: 'Actividad',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>


@endsection
