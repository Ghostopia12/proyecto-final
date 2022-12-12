<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;
    protected $fillable = [
        "equipo1_id",
        "equipo2_id",
        "inicio",
        "final",
        "marcador_equipo1",
        "marcador_equipo2",
        "estado"
    ];

//    public function equipo()
//    {
//        return $this->belongsTo(Equipo::class);
//    }
}
