<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'starts_at',
        'venue',
        'maximum_capacity',
        'image_url',
        'is_cancelled',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'is_cancelled' => 'boolean',
        ];
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('registered_at')
            ->withTimestamps();
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('starts_at', '>=', now())
            ->where('is_cancelled', false);
    }

    public function getRemainingSlotsAttribute(): int
    {
        $count = $this->participants_count ?? $this->participants()->count();

        return max(0, $this->maximum_capacity - $count);
    }

    public function isFull(): bool
    {
        return $this->remaining_slots <= 0;
    }
}
