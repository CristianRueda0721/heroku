<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ciudad
 *
 * @property $id
 * @property $nombre_ciudad
 * @property $created_at
 * @property $updated_at
 *

 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ciudad extends Model
{


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_ciudad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente', 'ciudad', 'id');
    }

    public function mecanicos()
    {
        return $this->hasOne('App\Models\Mecanico', 'ciudad', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
}
