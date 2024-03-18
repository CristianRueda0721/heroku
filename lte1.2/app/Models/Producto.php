<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $nombre_producto
 * @property $cantidad_productos
 * @property $precio_producto
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{

    static $rules = [
        'nombre_producto' => 'required|regex:/^[A-Za-z\s]+$/|max:10',
        'cantidad_productos' => 'required|numeric|max:999999999999',
        'precio_producto' => 'required|numeric|max:999999999999999',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_producto', 'cantidad_productos', 'precio_producto', 'desactivado'];

    public function tareas()
    {
        return $this->hasMany('App\Models\Producto', 'precio_producto_id', 'id');
        return $this->hasMany('App\Models\Producto', 'cantidad_producto_id', 'id');
        return $this->hasMany('App\Models\Producto', 'nombre_producto_id', 'id');
    }

    public function ventas()
    {
        return $this->hasMany('App\Models\Venta', 'precio_producto_id', 'id');
        return $this->hasMany('App\Models\Venta', 'cantidad_producto_id', 'id');
        return $this->hasMany('App\Models\Venta', 'nombre_producto_id', 'id');
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
