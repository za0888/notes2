<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\OnlyUserScope;
class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'blocks',
        'links',
    ];

    protected $casts=[
        'blocks'=>'array',
        'links'=>'array',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TeamScope);

    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class)
            ->withDefault(['name'=>'ANONIMOUS subcat']);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault('ANONIMOUS user');
    }

    public function media():HasMany
    {
        return $this->hasMany(Media::class)
            ->orderBy('media_type');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class)->withDefault();
    }


}
