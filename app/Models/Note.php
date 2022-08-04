<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'blocks',
        'links',
    ];

    protected $casts=[
        'links'=>'array',
        'blocks'=>'array'
    ];
    protected static function booted()
    {
        static::addGlobalScope('onlyUser', function (Builder $builder) {
            $builder->where('created_by_user', auth()->id());
        });
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(SubCategory::class)
            ->withDefault(['name'=>'ANONIMOUS']);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withDefault('ANONIMOUS');
    }


}
