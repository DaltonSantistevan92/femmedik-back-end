<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{Dias,Doctor,User,Cita};

class DoctorHorario extends Model
{
    use HasFactory;

    protected $table = 'doctor_horarios';
    protected $fillable = ['dia_id','doctor_id','user_id','h_entrada','h_salida','libre','estado'];

    public function dia(){
        return $this->belongsTo(Dias::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cita(){
        return $this->hasMany(Cita::class);
    }
}
