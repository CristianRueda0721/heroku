<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('vehiculo_marca') }}
            {{ Form::text('vehiculo_marca', $vehiculo->vehiculo_marca, ['class' => 'form-control' . ($errors->has('vehiculo_marca') ? ' is-invalid' : ''), 'placeholder' => 'Vehiculo Marca']) }}
            {!! $errors->first('vehiculo_marca', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('vehiculo_modelo') }}
            {{ Form::text('vehiculo_modelo', $vehiculo->vehiculo_modelo, ['class' => 'form-control' . ($errors->has('vehiculo_modelo') ? ' is-invalid' : ''), 'placeholder' => 'Vehiculo Modelo']) }}
            {!! $errors->first('vehiculo_modelo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Vehiculo_matricula') }}
            {{ Form::text('Vehiculo_matricula', $vehiculo->Vehiculo_matricula, ['class' => 'form-control' . ($errors->has('Vehiculo_matricula') ? ' is-invalid' : ''), 'placeholder' => 'Vehiculo Matricula']) }}
            {!! $errors->first('Vehiculo_matricula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Vehiculo_color') }}
            {{ Form::text('Vehiculo_color', $vehiculo->Vehiculo_color, ['class' => 'form-control' . ($errors->has('Vehiculo_color') ? ' is-invalid' : ''), 'placeholder' => 'Vehiculo Color']) }}
            {!! $errors->first('Vehiculo_color', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <a href="/vehiculos" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
