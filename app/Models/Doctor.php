<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{Persona,DoctorHorario,Cita};

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    protected $fillable = ['persona_id','estado'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function doctorHorario(){
        return $this->hasMany(DoctorHorario::class);
    }

    public function cita(){
        return $this->hasMany(Cita::class);
    }

}
