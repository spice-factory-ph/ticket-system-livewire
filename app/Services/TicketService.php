<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\TicketRequest;
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

    public function create(TicketRequest $request)
    {
        return $this->ticketRepository->create($request);
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        return $this->ticketRepository->update($request, $ticket);
    }

    public function destroy(Ticket $ticket)
    {
        return $this->ticketRepository->delete($ticket);
    }
}
