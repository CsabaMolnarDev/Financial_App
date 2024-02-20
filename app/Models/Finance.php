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
    public function category() : HasOne{
        return $this->hasOne(Category::class);
    }
    public function currency() : HasOne{
        return $this->hasOne(Currency::class);
    }
    protected $fillable = [
        'type',
        'name',
        'category_id',
        'price',
        'currency_id',
        'time'
    ];
}
