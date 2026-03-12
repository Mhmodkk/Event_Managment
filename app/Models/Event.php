<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'start_time',
        'image',
        'num_tickets',
        'user_id',
        'faculty_id',
    ];

    protected $casts = [
        'start_date' => 'date:m/d/Y',
        'end_date' => 'date:m/d/Y',
        'excluded_days' => 'array',
        'is_public' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
