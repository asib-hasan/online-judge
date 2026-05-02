<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function getRouteKey()
    {
        return \Illuminate\Support\Facades\Crypt::encryptString($this->getKey());
    }

    public function resolveRouteBinding($value, $field = null)
    {
        try {
            $id = \Illuminate\Support\Facades\Crypt::decryptString($value);
            return $this->where($field ?? $this->getRouteKeyName(), $id)->firstOrFail();
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function problems()
    {
        return $this->belongsToMany(Problem::class);
    }
}
