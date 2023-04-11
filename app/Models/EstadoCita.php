<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cita;

class EstadoCita extends Model
{
    use HasFactory;

    protected $table = 'estado_citas';
    protected $fillable = ['detalle','estado'];
    public $timestamps = false;

    public function cita(){
        return $this->hasMany(Cita::class);
    }


}
