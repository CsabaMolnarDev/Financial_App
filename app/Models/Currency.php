<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Currency extends Model
{
    use HasFactory;
    public function finance() : BelongsToMany{
        return $this->belongsToMany(Finance::class);
    }
    protected $fillable = [
        'name',
        'code',
        'symbol',
    ];
}
