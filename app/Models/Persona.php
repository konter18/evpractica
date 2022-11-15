<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['Nombre','Apellidos','Correo','Telefono','Foto'];
    use HasFactory;
}
