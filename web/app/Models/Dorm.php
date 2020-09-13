<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dorm extends Model
{
    use HasFactory;

    public function Student()
    {
        return $this->hasMany(Student::class, 'dorm_id');
    }

    public function School()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public static function IdValue()
    {
        return self::pluck('name', 'id');
    }
}
