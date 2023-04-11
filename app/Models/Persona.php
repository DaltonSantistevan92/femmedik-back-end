<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Doctor;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = ['cedula','nombre','apellido','celular','telefono','direccion','estado'];


    public function doctor(){
        return $this->hasMany(Doctor::class);
    }

}
