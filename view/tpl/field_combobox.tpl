<div class="mb-3">
	<label class="" for='id_{{$field.0}}' id='id_{{$field.0}}_label'>{{$field.1}}</label>
	<input class="form-control" id="id_{{$field.0}}" type="text" list="data_{{$field.0}}"{{if $field.5}} {{$field.5}}{{/if}}>
	<datalist id="data_{{$field.0}}" >
		{{foreach $field.4 as $opt=>$val}}
		<option value="{{$val}}">
		{{/foreach}}
	</datalist>
	{{**
	<input id="id_{{$field.0}}" class="form-control" type="text" value="{{$field.2}}">
	<select id="select_{{$field.0}}" class="form-control" onChange="$('#id_{{$field.0}}').val($(this).val())">
		<option value="">{{$field.5}}</option>
		{{foreach $field.4 as $opt=>$val}}<option value="{{$val}}">{{$val}}</option>{{/foreach}}
	</select>
	**}} 
	<span class='field_help'>{{$field.3}}</span>
</div>

