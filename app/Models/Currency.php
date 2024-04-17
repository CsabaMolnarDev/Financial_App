<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User;

class Currency extends Model
{
    use HasFactory;
    public function finance() : BelongsToMany{
        return $this->belongsToMany(Finance::class);
    }
    public function users() : BelongsToMany{
        return $this->belongsToMany(User::class);
    }
    protected $fillable = [
        'name',
        'code',
        'symbol',
    ];
}
