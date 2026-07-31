<?php

namespace App\Models;

class PriorityTicket extends BaseTicket
{
    public function calculateSlaHours(): int
    {
        return 4;
    }
}