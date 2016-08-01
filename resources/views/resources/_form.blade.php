    <div class="form-group">
    	{!! Form::label('name', 'Name *', ['class'=>'control-label']) !!}
    	{!! Form::text('name', $resource->name, ['id'=>'name', 'class'=>'form-control']) !!}
    </div>
    <div class="form-group">
    	{!! Form::label('inventory_tag', 'Inventory Tag *') !!}
    	{!! Form::text('inventory_tag', $resource->inventory_tag, ['id'=>'inventory_tag', 'class'=>'form-control']) !!}
    </div>
    <div class="form-group">
    	{!! Form::label('serial_number', 'Serial Number') !!}
    	{!! Form::text('serial_number', $resource->serial_number, ['id'=>'serial_number', 'class'=>'form-control']) !!}
    </div>

    <div class="form-group">
    	{!! Form::label('category_id', 'Category') !!}
    	{!! Form::select('category_id', $categories, $resource->category_id, ['class'=>'form-control']) !!}
    </div>
