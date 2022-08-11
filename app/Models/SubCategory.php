<?php

namespace App\Models;

use App\Scopes\OnlyUserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by-user'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OnlyUserScope());

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
}
