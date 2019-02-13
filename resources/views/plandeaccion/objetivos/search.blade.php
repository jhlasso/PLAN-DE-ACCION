{!! Form::open(array('url'=>'plandeaccion/objetivos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
	<div class="input-group">
		<select name="searchText" class="form-control">
		@foreach ($planes as $p)
		<option value="{{$p->nombre}}">{{$p->nombre}}</option>
		@endforeach	
		</select>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
	
</div>

{{Form::close()}}