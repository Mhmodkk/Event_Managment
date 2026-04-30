<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'slug',
        'description',
        'location',
        'excluded_days',
        'is_public',
        'qr_code',
        'start_date',
        'end_date',
        'image',
        'num_tickets',
        'user_id',
        'faculty_id',
        'attendance_token',
    ];

    protected $casts = [
        'start_date' => 'date:m/d/Y',
        'end_date' => 'date:m/d/Y',
        'excluded_days' => 'array',
        'is_public' => 'boolean',
    ];

    // ✅ توليد الرمز تلقائياً عند إنشاء فعالية جديدة
    protected static function booted()
    {
        static::creating(function ($event) {
            if (empty($event->attendance_token)) {
                $event->attendance_token = Str::random(32);
            }
        });
    }

    // ✅ التحقق من صلاحية وقت الحضور
    public function canRegisterAttendance(): bool
    {
        $now = now();
        $start = $this->start_date ? \Carbon\Carbon::parse($this->start_date)->subMinutes(30) : null;
        $end = $this->end_date ? \Carbon\Carbon::parse($this->end_date)->addHour() : ($this->start_date ? \Carbon\Carbon::parse($this->start_date)->addHour(2) : null);

        return $start && $end ? $now->between($start, $end) : false;
    }

    // ✅ رابط الحضور العام
    public function getPublicAttendanceUrlAttribute(): string
    {
        return route('events.attendance.public', ['token' => $this->attendance_token]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function averageRating()
    {
        return round($this->ratings()->avg('stars') ?? 0, 1);
    }
    public function ratingCount()
    {
        return $this->ratings()->count();
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }
    public function savedEvents(): HasMany
    {
        return $this->hasMany(SavedEvent::class);
    }
    public function attendings(): HasMany
    {
        return $this->hasMany(Attending::class);
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function hasTags($tags)
    {
        return $this->tags->contains($tags);
    }
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
