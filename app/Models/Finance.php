<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Finance extends Model
{
    //Ha van xy_id akkor belongs to mert a másik tábla ezen keresztül birtokolja
    //Pl.:A birtoklásomat egy poló íránt úgy jelzem hogy bele írom a nevem (user_id) onnan tudom hogy az enyém (nem én a polóé)
    use HasFactory;
    public function users() : BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function category() : BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function currency() : BelongsTo{
        return $this->belongsTo(Currency::class,'currency_id','id');
    }
    public function monthly() : HasOne{
        return $this->hasOne(Monthly::class,'finance_id','id');
    }
    protected $fillable = [
        'type',
        'name',
        'category_id',
        'price',
        'currency_id',
        'user_id',
        'time'
    ];
}
