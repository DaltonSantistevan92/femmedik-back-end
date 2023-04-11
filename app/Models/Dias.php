<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DoctorHorario;

class Dias extends Model
{
    use HasFactory;

    protected $table = 'dias';
    protected $fillable = ['dia','estado','orden'];

    public function doctorHorario(){
        return $this->hasMany(DoctorHorario::class);
    }
}
