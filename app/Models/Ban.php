<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ban extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason_for_ban',
        'banned_until',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
