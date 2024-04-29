<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyInvitations extends Model
{
    use HasFactory;
    public function family():BelongsTo{
        return $this->belongsTo(Family::class);
    }

    public function sender(): BelongsTo{
        return $this->belongsTo(User::class, 'sender_id');
    }
    protected $fillable = [
        'recipient_email',
        'token',
        'family_id',
        'status',
        'sender_id'
    ];
}
