<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre_producto') }}
            {{ Form::text('nombre_producto', $producto->nombre_producto, ['class' => 'form-control' . ($errors->has('nombre_producto') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Producto']) }}
            {!! $errors->first('nombre_producto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad_productos') }}
            {{ Form::text('cantidad_productos', $producto->cantidad_productos, ['class' => 'form-control' . ($errors->has('cantidad_productos') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Productos']) }}
            {!! $errors->first('cantidad_productos', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio_producto') }}
            {{ Form::text('precio_producto', $producto->precio_producto != 0 ? number_format($producto->precio_producto, 0, ',', '') : '', ['class' => 'form-control' . ($errors->has('precio_producto') ? ' is-invalid' : ''), 'placeholder' => 'Precio Producto']) }}
            {!! $errors->first('precio_producto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <a href="/productos" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
