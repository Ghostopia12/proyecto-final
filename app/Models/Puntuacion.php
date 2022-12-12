<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntuacion extends Model
{
    use HasFactory;
    protected $table = 'puntuaciones';
    protected $fillable = [
        "id_equipo",
        "partidos_ganados",
        "partidos_perdidos",
        "partidos_empatados",
        "partidos_jugamos",
        "goles_favor",
        "goles_contra",
        "puntos"
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
