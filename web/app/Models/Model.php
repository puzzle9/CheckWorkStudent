<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Info;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends Info
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'deleted_at',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * scope
     */
    // 排序
    public function scopeSort($query, $name='sort', $type='desc')
    {
        return $query->orderBy($name, $type)->latest();
    }

    // 搜索
    public function scopeSearch($query, $name, $value=null, $is_like=true)
    {
        $value = $value ?: request()->input($name);

        if ($value) {
            $query = $is_like ? $query->where($name, 'like', "%$value%") : $query->where($name, $value);
        }

        return $query;
    }

    // other
    protected function serializeDate($date)
    {
        return $date ? $date->format('Y-m-d H:i:s') : null;
    }
}
