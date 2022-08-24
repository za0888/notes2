<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
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

    public function theme() :BelongsTo
    {
        return $this->belongsTo(Theme::class)
            ->withDefault(['name' => 'ANONIMOUS']);
    }


    public function subCategories():HasMany
    {
        return $this->hasMany(SubCategory::class)
            ->orderBy('name');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class)->withDefault();
    }

}
