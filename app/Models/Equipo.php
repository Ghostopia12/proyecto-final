<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "grupo_id"
    ];
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
    public function puntuacion()
    {
        return $this->hasMany(Puntuacion::class);
    }
//    public function partido()
//    {
//        return $this->hasMany(Partido::class);
//    }

    public function getFotoForDisplay()
    {
        $foto = $this->imagen;
        if ($foto == null || $foto == "") {
            $foto = "0.webp";
        }

        return $foto;
    }
}
