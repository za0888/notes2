<?php
namespace App\Models;

use App\Scopes\DomainScope;
use App\Scopes\OnlyUserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name',
        'created_by_user'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new DomainScope);

    }

    public function categories()
    {
        return $this->hasMany(Category::class)
            ->orderBy('name');
    }
}
