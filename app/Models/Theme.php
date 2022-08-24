<?php
namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TeamScope);

    }

    public function categories()
    {
        return $this->hasMany(Category::class)
            ->orderBy('name');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class)->withDefault();
    }

}
