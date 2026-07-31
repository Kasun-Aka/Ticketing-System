<?php

namespace App\Models;

// INHERITANCE: Inherits core attributes and Eloquent functionality from BaseTicket
class StandardTicket extends BaseTicket
{
    // POLYMORPHISM: Overrides SLA calculation for standard tier (24 Hours)
    public function calculateSlaHours(): int
    {
        return 24;
    }
}