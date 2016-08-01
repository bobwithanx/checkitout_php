    <div class="form-group">
    	{!! Form::label('first_name', 'First Name *', ['class'=>'control-label']) !!}
    	{!! Form::text('first_name', $student->first_name, ['id'=>'first_name', 'class'=>'form-control']) !!}
    </div>
    <div class="form-group">
    	{!! Form::label('last_name', 'Last Name *', ['class'=>'control-label']) !!}
    	{!! Form::text('last_name', $student->last_name, ['id'=>'last_name', 'class'=>'form-control']) !!}
    </div>
    <div class="form-group">
    	{!! Form::label('id_number', 'ID Number *', ['class'=>'control-label']) !!}
    	{!! Form::text('id_number', $student->id_number, ['id'=>'id_number', 'class'=>'form-control']) !!}
    </div>

    <input type="hidden" name="is_active" id="is_active" class="form-control" checked value=1>
