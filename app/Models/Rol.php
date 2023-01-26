<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Menu;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rols';
    protected $fillable = ['cargo','estado'];


    public function menu(){
        return $this->hasMany(Menu::class);
    }
}
