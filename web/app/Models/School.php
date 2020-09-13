<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    public static function IdValue()
    {
        return self::pluck('name', 'id');
    }
}
