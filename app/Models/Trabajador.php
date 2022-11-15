<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $fillable = ['cargo','personas_id'];
    use HasFactory;


    public function persona()
    {
        return $this->belongsTo(Persona::class, 'personas_id');
    }
}
