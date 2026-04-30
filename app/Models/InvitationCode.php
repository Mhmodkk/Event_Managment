<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'faculty_id',
        'max_uses',
        'used_count',
        'expires_at',
        'is_active',
        'created_by',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
