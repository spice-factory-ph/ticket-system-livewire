<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Services\CommentService;
use App\Services\PriorityService;
use App\Services\ProjectService;
use App\Services\StatusService;
use App\Services\TicketService;
use App\Services\TypeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(TicketService $ticketService, ProjectService $projectService, TypeService $typeService, StatusService $statusService, UserService $userService, PriorityService $priorityService, CommentService $commentService)
    {
        $this->ticketService = $ticketService;
        $this->projectService = $projectService;
        $this->typeService = $typeService;
        $this->statusService = $statusService;
        $this->userService = $userService;
        $this->priorityService = $priorityService;
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = $this->ticketService->getList();
        $totalBugTickets = $this->ticketService->getTotal(1);
        $totalTaskTickets = $this->ticketService->getTotal(2);
        $totalStoryTickets = $this->ticketService->getTotal(3);
        $projects = $this->projectService->getList();
        $types = $this->typeService->getList();
        $statuses = $this->statusService->getList();
        $users = $this->userService->getList();
        $priorities = $this->priorityService->getList();

        return view('index', compact('tickets', 'projects', 'types', 'statuses', 'users', 'priorities', 'totalBugTickets', 'totalTaskTickets', 'totalStoryTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ticket = new Ticket;
        $tickets = $this->ticketService->getList();
        $projects = $this->projectService->getList();
        $types = $this->typeService->getList();
        $statuses = $this->statusService->getList();
        $users = $this->userService->getList();
        $priorities = $this->priorityService->getList();

        return view('form', compact('ticket', 'tickets', 'projects', 'types', 'statuses', 'users', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        return $this->ticketService->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $tickets = $this->ticketService->getList();
        $projects = $this->projectService->getList();
        $types = $this->typeService->getList();
        $statuses = $this->statusService->getList();
        $users = $this->userService->getList();
        $priorities = $this->priorityService->getList();

        return view('show', compact('ticket', 'tickets', 'projects', 'types', 'statuses', 'users', 'priorities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $tickets = $this->ticketService->getList();
        $projects = $this->projectService->getList();
        $types = $this->typeService->getList();
        $statuses = $this->statusService->getList();
        $users = $this->userService->getList();
        $priorities = $this->priorityService->getList();

        return view('form', compact('ticket', 'tickets', 'projects', 'types', 'statuses', 'users', 'priorities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        return $this->ticketService->update($request, $ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        return $this->ticketService->destroy($ticket);
    }
}
