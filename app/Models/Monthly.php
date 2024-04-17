<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monthly extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function finance() : HasOne{
        return $this->hasOne(Finance::class);
    }
    protected $fillable = [
        'finance_id',
        'year',
        'month',
    ];
}
