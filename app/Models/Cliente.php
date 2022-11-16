<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['rut','direccion','personas_id'];


    public function persona()
    {
        return $this->belongsTo(Persona::class, 'personas_id');
    }
}
