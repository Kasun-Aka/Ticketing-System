<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1. ABSTRACTION: Base class contract (made concrete to allow Eloquent instantiation).
class BaseTicket extends Model
{
    protected $table = 'tickets';

    // 2. ENCAPSULATION: Protect fields from direct arbitrary modification.
    protected $fillable = ['user_id', 'subject', 'description', 'type', 'status', 'sla_hours'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateSlaHours(): int
    {
        return 0; // Default SLA, overridden by child classes
    }

    // Encapsulated state transition method
    public function markAsResolved(): void
    {
        $this->status = 'resolved';
        $this->save();
    }
}