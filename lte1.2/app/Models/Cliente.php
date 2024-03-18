<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * Class Cliente
 *
 * @property $id
 * @property $cedula_cliente
 * @property $nombre_cliente
 * @property $apellido_cliente
 * @property $direccion
 * @property $telefono
 * @property $email
 * @property $ciudad
 * @property $vehiculo_marca_id
 * @property $vehiculo_modelo_id
 * @property $vehiculo_matricula_id
 * @property $vehiculo_color_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Vehiculo $vehiculo
 * @property Vehiculo $vehiculo
 * @property Vehiculo $vehiculo
 * @property Vehiculo $vehiculo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{

    static $rules = [
        'cedula_cliente' => 'required|numeric|digits:10',
        'nombre_cliente' => 'required|regex:/^[A-Za-z\s]+$/|max:20',
        'apellido_cliente' => 'required|regex:/^[A-Za-z\s]+$/|max:20',
        'direccion' => 'required|regex:/^[a-zA-Z0-9#\s-]+$/|max:30',
        'telefono' => 'required|numeric|digits:10',
        'email' => 'required|email|max:30',
        'ciudad' => 'required|alpha|max:10',
        'vehiculo_marca_id' => 'required',
        'vehiculo_modelo_id' => 'required',
        'vehiculo_matricula_id' => 'required',
        'vehiculo_color_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula_cliente', 'nombre_cliente', 'apellido_cliente', 'direccion', 'telefono',
        'email', 'ciudad', 'vehiculo_marca_id', 'vehiculo_modelo_id', 'vehiculo_matricula_id', 'vehiculo_color_id', 'desactivado'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vehiculo()
    {
        return $this->hasOne('App\Models\Vehiculo', 'id', 'vehiculo_marca_id');
        return $this->hasOne('App\Models\Vehiculo', 'id', 'vehiculo_matricula_id');
        return $this->hasOne('App\Models\Vehiculo', 'id', 'vehiculo_modelo_id');
        return $this->hasOne('App\Models\Vehiculo', 'id', 'vehiculo_color_id');
    }

    public function ciudades()
    {
        return $this->hasMany('App\Models\Ciudad', 'id', 'ciudad');
    }

    public function tareas()
    {
        return $this->hasMany('App\Models\Tarea', 'nombre_cliente_id', 'id');
        return $this->hasMany('App\Models\Tarea', 'apellido_cliente_id', 'id');
    }

    public function scopeActivas($query)
    {
        return $query->where('desactivado', false);
    }

    public function desactivar()
    {
        $this->update(['desactivado' => true]);
    }

    public function activar()
    {
        $this->update(['desactivado' => false]);
    }
}
