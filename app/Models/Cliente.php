<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\{Persona};


class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = ['persona_id','email','estado'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }
}
