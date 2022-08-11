<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trusted extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
       'trusted_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault('name','no user');
    }
}
