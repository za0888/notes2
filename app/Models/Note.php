<?php

namespace App\Models;

use App\Scopes\TeamScope;
use App\Traits\TeamFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\OnlyUserScope;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;
    use TeamFilter;

    /**
     * The relationships that should always be loaded.
     * prevent N+1 problem
     * @var array
     */
    protected $with = [
        'subCategory',
        'team',
        'user'
    ];

    protected $fillable = [
        'title',
        'body',
        'html_block',
        'links',
        'user_id',
        'team_id',
        'sub_category_id'
    ];

    protected $casts = [
        'html_block' => 'array',
        'links' => 'array',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TeamScope);
//        if (Auth::user()) {
//            static::creating(function ($note) {
//                $note->team_id = \Auth::user()->team_id;
//
//            });
//        }

    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class)
            ->withDefault(['name' => 'ANONIMOUS subcat']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault('ANONIMOUS user');
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class)
            ->orderBy('media_type');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class)->withDefault('No TEAM');
    }


}
