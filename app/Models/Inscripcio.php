<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripciones extends Model
{
    use HasFactory;

    public function curso()
    {
        return $this->hasMany(inscripcion::class);
    }
    public function estudiante()
    {
        return $this->hasMany(insccripcion::class);
    }
}
