<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketRepository
{
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function getList($data)
    {
        $orderBy = $data['orderBy'] ?? 'created_at';

        if (isset($data['orderDirection'])) {
            $orderDirection = $data['orderDirection'] ? 'asc' : 'desc';
        } else {
            $orderDirection = $data['orderDirection'] ?? 'desc';
        }

        return Ticket::with(['project', 'type', 'status', 'priority', 'assignee', 'reporter'])->search($data)->orderBy($orderBy, $orderDirection)->paginate(10);
    }

    public function getTotal($data)
    {
        return Ticket::query()->total($data);
    }

    public function create(TicketRequest $request)
    {
        Ticket::create($request->validated());

        return redirect(route('tickets.index'))->with(['success' => 'Ticket created successfully!']);
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());

        $ticket->save();
    }

    public function delete(Ticket $ticket)
    {
        $ticket->delete();

        return redirect(route('tickets.index'))->with(['success' => 'Ticket deleted successfully!']);
    }
}
