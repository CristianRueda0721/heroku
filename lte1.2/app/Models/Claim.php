<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['nombre', 'email', 'telefono', 'identificacion', 'asunto', 'mensaje', 'status'];
    
}


