<?php

namespace App\Models;

use App\Scopes\OnlyUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by_user'
    ];

//    protected static function booted()
//    {
//        static::addGlobalScope(new OnlyUserScope());
//
//    }

    public function theme()
    {
        return $this->belongsTo(Theme::class)
            ->withDefault(['name' => 'ANONIMOUS']);
    }


    public function subCategories()
    {
        return $this->hasMany(SubCategory::class)
            ->orderBy('name');
    }

}
