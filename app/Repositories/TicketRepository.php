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

    public function getList()
    {
        return Ticket::query()->with(['project', 'type', 'status', 'priority', 'assignee', 'reporter'])->search(request(['search', 'assignee']))->paginate(10);
    }

    public function create(TicketRequest $request)
    {
        $ticket = new Ticket;
        $ticket->title = $request->title;
        $ticket->project_id = $request->project_id;
        $ticket->type_id = $request->type_id;
        $ticket->status_id = $request->status_id;
        $ticket->description = $request->description;
        $ticket->priority_id = $request->priority_id;
        $ticket->assigned_to = $request->assigned_to;
        $ticket->created_by = Auth::user()->id;
        $ticket->save();

        return redirect(route('tickets.index'))->with(['success' => 'Ticket created successfully!']);
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket->title = $request->title;
        $ticket->project_id = $request->project_id;
        $ticket->type_id = $request->type_id;
        $ticket->status_id = $request->status_id;
        $ticket->description = $request->description;
        $ticket->priority_id = $request->priority_id;
        $ticket->assigned_to = $request->assigned_to;
        $ticket->created_by = Auth::user()->id;

        $this->commentService->create($request, $ticket);

        $ticket->save();

        return redirect(route('tickets.edit', $ticket->id))->with(['success' => 'Ticket updated successfully!']);
    }

    public function delete(Ticket $ticket)
    {
        $ticket->delete();

        return redirect(route('tickets.index'))->with(['success' => 'Ticket deleted successfully!']);
    }
}
