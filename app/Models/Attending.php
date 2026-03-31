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
        'qr_token',
        'qr_generated_at',
        'qr_token',
        'qr_path',
        'qr_generated_at'
    ];

    protected $casts = [
        'attended_at' => 'datetime',
        'num_tickets' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function scanner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'qr_scanned_by');
    }

    public function isGuest(): bool
    {
        return is_null($this->user_id);
    }

    public function hasAttended(): bool
    {
        return !is_null($this->attended_at);
    }

    public function getAttendeeNameAttribute(): ?string
    {
        if ($this->user) {
            return $this->user->name;
        }

        return $this->guest_name ?? 'ضيف غير مسجل';
    }

    public function getAttendeeTypeAttribute(): string
    {
        if ($this->user) {
            if ($this->user->isAdmin() || $this->user->isSuperAdmin()) {
                return 'مشرف';
            }
            return 'طالب';
        }
        return 'ضيف خارجي';
    }
}
