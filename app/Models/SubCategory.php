<?php

namespace App\Models;

use App\Scopes\TeamScope;
use App\Scopes\OnlyUserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TeamScope);

    }

    public function notes() : HasMany
    {
        return $this->hasMany(Note::class);

    }

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class)
            ->orderBy('name')
            ->withDefault('ANONIMOUS');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class)->withDefault();
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
