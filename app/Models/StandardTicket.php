<?php

namespace App\Models;


class StandardTicket extends BaseTicket
{
    public function calculateSlaHours(): int
    {
        return 24;
    }
}