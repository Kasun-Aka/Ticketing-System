<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController
{
    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }


    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $tickets = $this->ticketService->getTicketsForUser($user);

        return response()->json($tickets);
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($request->type === 'priority' && $user->role === 'customer') {
            return response()->json([
                'error' => 'Standard customers cannot create priority tickets.'
            ], 403);
        }

        $ticket = $this->ticketService->createTicket($user, $request->only(['subject', 'description', 'type']));

        return response()->json(['message' => 'Ticket created successfully!', 'ticket' => $ticket], 201);
    }
    
    public function resolve(int $ticketId)
    {
        $ticket = $this->ticketService->resolveTicket($ticketId);
        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found.'], 404);
        }
        return response()->json(['message' => 'Ticket resolved successfully!', 'ticket' => $ticket]);
    }
}