<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicio
 *
 * @property $id
 * @property $nombre_servicio
 * @property $precio_servicio
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Servicio extends Model
{

    static $rules = [
        'nombre_servicio' => 'required|regex:/^[A-Za-z\s]+$/|max:25',
		'precio_servicio' => 'required|numeric|max:999999999999999999',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_servicio','precio_servicio','desactivado'];

    public function tareas()
    {
        return $this->hasMany('App\Models\Servicio', 'precio_servicio_id', 'id');
        return $this->hasMany('App\Models\Servicio', 'nombre_servicio_id', 'id');
    }

    public function ventas()
    {
        return $this->hasMany('App\Models\Venta', 'precio_servicio_id', 'id');
        return $this->hasMany('App\Models\Venta', 'nombre_servicio_id', 'id');
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
