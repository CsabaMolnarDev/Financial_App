<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monthly extends Model
{
    use HasFactory;
    public function finance() : BelongsTo{
        return $this->belongsTo(Finance::class,'finance_id','id');
    }

    protected $fillable = [
        'finance_id',
        'year',
        'month',
    ];
}
