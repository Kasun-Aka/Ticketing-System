<?php

namespace App\Models;

// INHERITANCE: Inherits core attributes and Eloquent functionality from BaseTicket
class PriorityTicket extends BaseTicket
{
    // POLYMORPHISM: Overrides SLA calculation for priority tier (4 Hours)
    public function calculateSlaHours(): int
    {
        return 4;
    }
}