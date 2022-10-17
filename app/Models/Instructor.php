<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructores extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
