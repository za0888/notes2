<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\enums\Media_types;

class Media extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'media_type' => Media_types::class,
    ];

    protected $fillable = [
        'title',
        'media_type',
        'description'
    ];

    public function note()
    {

        return $this->belongsTo(Note::class)
            ->withDefault(['title' => 'empty note']);
    }

    protected static function booted()
    {
        static::addGlobalScope(new TeamScope);
    }
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class)->withDefault();
    }
}
