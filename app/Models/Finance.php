<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Finance extends Model
{
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
