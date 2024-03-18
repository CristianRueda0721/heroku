<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre_servicio') }}
            {{ Form::text('nombre_servicio', $servicio->nombre_servicio, ['class' => 'form-control' . ($errors->has('nombre_servicio') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Servicio']) }}
            {!! $errors->first('nombre_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio_servicio') }}
            {{ Form::text('precio_servicio', number_format($servicio->precio_servicio,0, ',', '.'), ['class' => 'form-control' . ($errors->has('precio_servicio') ? ' is-invalid' : ''), 'placeholder' => 'Precio Servicio']) }}
            {!! $errors->first('precio_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <a href="/servicios" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
