<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attending extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'num_tickets',
        'guest_name',
        'guest_phone',
        'guest_email',
        'attended_at',
        'qr_scanned_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
