<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;
    public function instructor()
    {
        return $this->belongsTo(curso::class);
    }
    public function categoria()
    {
        return $this->belongsTo(curso::class);
    }
}
