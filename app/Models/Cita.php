<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{DoctorHorario,EstadoCita,Cliente,Doctor,User};

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $fillable = ['doctor_horario_id','estado_cita_id','cliente_id','doctor_id','user_id','codigo','fecha','pagado','progreso','estado'];

    public function doctor_horario(){
        return $this->belongsTo(DoctorHorario::class);
    }

    public function estado_cita(){
        return $this->belongsTo(EstadoCita::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
