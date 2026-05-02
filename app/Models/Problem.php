<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $guarded = [];

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

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function contests()
    {
        return $this->belongsToMany(Contest::class);
    }
}
