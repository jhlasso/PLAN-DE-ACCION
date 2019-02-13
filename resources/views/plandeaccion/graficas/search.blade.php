{!! Form::open(array('url'=>'plandeaccion/graficas','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
	<div class="input-group">
		<select name="searchText" class="form-control">
		@foreach ($actividades as $ac)
		<option value="{{$ac->nombre}}">{{$ac->nombre}}</option>
		@endforeach	
		</select>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Graficar</button>
		</span>
	</div>
	
</div>

{{Form::close()}}