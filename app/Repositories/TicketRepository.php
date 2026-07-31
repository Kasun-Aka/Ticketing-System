<?php

namespace App\Repositories;

use App\Models\BaseTicket;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository
{

    public function getAllTickets(): Collection
    {
        return BaseTicket::with('user')->get();
    }


    public function getTicketsByUserId(int $userId): Collection
    {
        return BaseTicket::where('user_id', $userId)->get();
    }

    public function save(BaseTicket $ticket): bool
    {
        return $ticket->save();
    }

    public function findById(int $id): ?BaseTicket
    {
        return BaseTicket::find($id);
    }
}
