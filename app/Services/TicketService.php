<?php

namespace App\Services;

use App\Models\BaseTicket;
use App\Models\PriorityTicket;
use App\Models\StandardTicket;
use App\Models\User;
use App\Repositories\TicketRepository;
use Illuminate\Database\Eloquent\Collection;

class TicketService
{
    protected TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Get tickets for a user based on their role.
     */
    public function getTicketsForUser(User $user): Collection
    {
        if ($user->role === 'admin') {
            return $this->ticketRepository->getAllTickets();
        }

        return $this->ticketRepository->getTicketsByUserId($user->id);
    }

    /**
     * Create a new ticket.
     */
    public function createTicket(User $user, array $data): BaseTicket
    {
        // Instantiating concrete class based on type selection
        $ticket = $data['type'] === 'priority' ? new PriorityTicket() : new StandardTicket();
        
        $ticket->user_id = $user->id;
        $ticket->subject = $data['subject'];
        $ticket->description = $data['description'];
        $ticket->type = $data['type'];
        
        // Polymorphic SLA calculation
        $ticket->sla_hours = $ticket->calculateSlaHours(); 
        
        $this->ticketRepository->save($ticket);

        return $ticket;
    }

    /**
     * Resolve a ticket.
     */
    public function resolveTicket(int $ticketId): ?BaseTicket
    {
        $ticket = $this->ticketRepository->findById($ticketId);
        if ($ticket) {
            $ticket->markAsResolved();
        }
        return $ticket;
    }
}
