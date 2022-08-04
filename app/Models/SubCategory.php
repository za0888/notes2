<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        static::addGlobalScope('onlyUser', function (Builder $builder) {
            $builder->where('created_by_user', auth()->id());
        });
    }
    public function notes()
    {
        return $this->hasMany(Note::class);

    }

    public function category()
    {
        return $this->belongsTo(Category::class)
            ->orderBy('name')
            ->withDefault('ANONIMOUS');
    }
}
