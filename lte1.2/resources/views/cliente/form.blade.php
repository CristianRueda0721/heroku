<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('cedula_cliente') }}
            {{ Form::text('cedula_cliente', $cliente->cedula_cliente, ['class' => 'form-control' . ($errors->has('cedula_cliente') ? ' is-invalid' : ''), 'placeholder' => 'Cedula Cliente']) }}
            {!! $errors->first('cedula_cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre_cliente') }}
            {{ Form::text('nombre_cliente', $cliente->nombre_cliente, ['class' => 'form-control' . ($errors->has('nombre_cliente') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Cliente']) }}
            {!! $errors->first('nombre_cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('apellido_cliente') }}
            {{ Form::text('apellido_cliente', $cliente->apellido_cliente, ['class' => 'form-control' . ($errors->has('apellido_cliente') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Cliente']) }}
            {!! $errors->first('apellido_cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $cliente->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $cliente->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $cliente->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="form-group">
            {{ Form::label('ciudad') }}
            {{ Form::text('ciudad', $cliente->ciudad, ['class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''), 'placeholder' => 'Ciudad']) }}
            {!! $errors->first('ciudad', '<div class="invalid-feedback">:message</div>') !!}
        </div>




        <div class="form-group">
            {{ Form::label('vehiculo_marca') }}
            {{ Form::select('vehiculo_marca_id', $vehiculos, $cliente->vehiculo_marca_id, ['class' => 'form-control' . ($errors->has('vehiculo_marca_id') ? ' is-invalid' : ''), 'placeholder' => 'Vehiculo Marca ']) }}
            {!! $errors->first('vehiculo_marca_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('vehiculo_modelo') }}
            {{ Form::select('vehiculo_modelo_id', $vehiculos2, $cliente->vehiculo_modelo_id, ['class' => 'form-control' . ($errors->has('vehiculo_modelo_id') ? ' is-invalid' : ''), 'placeholder' => 'Vehiculo Modelo ']) }}
            {!! $errors->first('vehiculo_modelo_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('vehiculo_matricula') }}
            {{ Form::select('vehiculo_matricula_id', $vehiculos1, $cliente->vehiculo_matricula_id, ['class' => 'form-control' . ($errors->has('vehiculo_matricula_id') ? ' is-invalid' : ''), 'placeholder' => 'Vehiculo Matricula']) }}
            {!! $errors->first('vehiculo_matricula_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('vehiculo_color') }}
            {{ Form::select('vehiculo_color_id', $vehiculos3, $cliente->vehiculo_color_id, ['class' => 'form-control' . ($errors->has('vehiculo_color_id') ? ' is-invalid' : ''), 'placeholder' => 'Vehiculo Color ']) }}
            {!! $errors->first('vehiculo_color_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <a href="/clientes" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
