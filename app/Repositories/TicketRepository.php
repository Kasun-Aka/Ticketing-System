<?php

namespace App\Repositories;

use App\Models\BaseTicket;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository
{
    /**
     * Get all tickets with their associated users.
     */
    public function getAllTickets(): Collection
    {
        return BaseTicket::with('user')->get();
    }

    /**
     * Get tickets for a specific user.
     */
    public function getTicketsByUserId(int $userId): Collection
    {
        return BaseTicket::where('user_id', $userId)->get();
    }

    /**
     * Save a ticket to the database.
     */
    public function save(BaseTicket $ticket): bool
    {
        return $ticket->save();
    }

    /**
     * Find a ticket by ID.
     */
    public function findById(int $id): ?BaseTicket
    {
        return BaseTicket::find($id);
    }
}
