<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mecanico
 *
 * @property $id
 * @property $cedula
 * @property $nombre
 * @property $apellido
 * @property $direccion
 * @property $telefono
 * @property $email
 * @property $ciudad
 * @property $especialidad
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Mecanico extends Model
{

    static $rules = [
		'cedula' => 'required|numeric|digits:10',
        'nombre' => 'required|regex:/^[A-Za-z\s]+$/|max:20',
        'apellido' => 'required|regex:/^[A-Za-z\s]+$/|max:20',
		'direccion' => 'required|max:30|regex:/^[a-z A-Z 0-9 #-]*$/',
		'telefono' => 'required|numeric|digits:10',
		'email' => 'required|email|max:30',
		'ciudad' => 'required|alpha|max:10',
        'especialidad' => 'required|regex:/^[A-Za-z\s]+$/|max:20',
		
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cedula','nombre','apellido','direccion','telefono','email','ciudad','especialidad','desactivado'];

    public function tareas()
    {
        return $this->hasMany('App\Models\Mecanico', 'nombre_empleado_id', 'id');
        return $this->hasMany('App\Models\Mecanico', 'apellido_empleado_id', 'id');
        return $this->hasMany('App\Models\Mecanico', 'especialidad_id', 'id');
    }

    public function ventas()
    {
        return $this->hasMany('App\Models\Venta', 'nombre_empleado_id', 'id');
        return $this->hasMany('App\Models\Venta', 'apellido_empleado_id', 'id');
        return $this->hasMany('App\Models\Venta', 'especialidad_id', 'id');
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
