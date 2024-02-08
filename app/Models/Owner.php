<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Owner extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    static function boot()
    {
        parent::boot();
        static::addGlobalScope('owner', function (Builder $builder) {
            $builder->where('role', 'owner');
        });
    }
}
