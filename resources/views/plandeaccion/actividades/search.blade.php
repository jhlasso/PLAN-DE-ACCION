{!! Form::open(array('url'=>'plandeaccion/actividades','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
	<div class="input-group">
		<select name="searchText" class="form-control">
		@foreach ($objetivos as $o)
		<option value="{{$o->nombre}}">{{$o->nombre}}</option>
		@endforeach	
		</select>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
	
</div>

{{Form::close()}}