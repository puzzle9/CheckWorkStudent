<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public function School()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function Dorm()
    {
        return $this->belongsTo(Dorm::class, 'dorm_id', 'id');
    }

    public static function IdValue()
    {
        return self::pluck('name', 'id');
    }
}
