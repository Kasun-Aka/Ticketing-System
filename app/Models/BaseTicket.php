<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BaseTicket extends Model
{
    protected $table = 'tickets';

    protected $fillable = ['user_id', 'subject', 'description', 'type', 'status', 'sla_hours'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateSlaHours(): int
    {
        return 0;
    }

    public function markAsResolved(): void
    {
        $this->status = 'resolved';
        $this->save();
    }
}