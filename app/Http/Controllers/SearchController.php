<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\PriorityService;
use App\Services\StatusService;
use App\Services\TicketService;
use App\Services\TypeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(TicketService $ticketService, TypeService $typeService, StatusService $statusService, UserService $userService, PriorityService $priorityService)
    {
        $this->ticketService = $ticketService;
        $this->typeService = $typeService;
        $this->statusService = $statusService;
        $this->userService = $userService;
        $this->priorityService = $priorityService;
    }

    public function search(Request $request)
    {
        $tickets = $this->ticketService->getList($request);
        return response()->json($tickets);
    }
}