<?php

namespace App\Models\Traits;

use App\Models\Scopes\ByUserScope;

trait HasByUserScope
{
    protected static function bootHasByUserScope()
    {
        static::addGlobalScope(new ByUserScope);
        static::creating(function ($model) {
            $model->user_id = get_user_id_scope();
        });
    }

    public function scopeWithoutByUser($builder)
    {
        return $builder->withoutGlobalScope(ByUserScope::class);
    }
}
