<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    static $rules = [
        'vehiculo_marca' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:20',
        'vehiculo_modelo' => 'required|max:10|regex:/^[a-zA-Z0-9 ]+$/',
        'Vehiculo_matricula' => 'required|max:6|regex:/^[a-zA-Z0-9]+$/',
        'Vehiculo_color' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:20',
        
    ];

    protected $perPage = 20;

    protected $fillable = ['vehiculo_marca', 'vehiculo_modelo', 'Vehiculo_matricula', 'Vehiculo_color','desactivado'];

    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente', 'vehiculo_modelo_id', 'id');
        return $this->hasMany('App\Models\Cliente', 'vehiculo_color_id', 'id');
        return $this->hasMany('App\Models\Cliente', 'vehiculo_marca_id', 'id');
        return $this->hasMany('App\Models\Cliente', 'vehiculo_matricula_id', 'id');
    }

    public function tareas()
    {
        return $this->hasOne('App\Models\Vehiculo', 'vehiculo_marca_id', 'id');
        return $this->hasOne('App\Models\Vehiculo', 'vehiculo_matricula_id', 'id');
        return $this->hasOne('App\Models\Vehiculo', 'vehiculo_modelo_id', 'id');
        return $this->hasOne('App\Models\Vehiculo', 'vehiculo_color_id', 'id');
    }

    public function ventas()
    {
        return $this->hasOne('App\Models\Venta', 'vehiculo_marca_id', 'id');
        return $this->hasOne('App\Models\Venta', 'vehiculo_matricula_id', 'id');
        return $this->hasOne('App\Models\Venta', 'vehiculo_modelo_id', 'id');
        return $this->hasOne('App\Models\Venta', 'vehiculo_color_id', 'id');
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
