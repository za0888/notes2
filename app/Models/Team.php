<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'about',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function themes(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(User::class);

    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function name(): Attribute
    {
//        get set - named arguments https://www.php.net/manual/en/functions.arguments.php
        return Attribute::make(
            get: (fn($value)=>Str::replace('_',' ',$value)),
            set:(fn($value)=>Str::slug($value,'_'))
        );
    }
}
