<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;

class TicketService
{
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function getList()
    {
        return $this->ticketRepository->getList();
    }

    public function create(Request $request)
    {
        return $this->ticketRepository->create($request);
    }

    public function update(Request $request, Ticket $ticket)
    {
        return $this->ticketRepository->update($request, $ticket);
    }

    public function destroy(Ticket $ticket)
    {
        return $this->ticketRepository->delete($ticket);
    }
}
