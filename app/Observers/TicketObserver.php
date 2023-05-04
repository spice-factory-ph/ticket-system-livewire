<?php

namespace App\Observers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketObserver
{
    public function creating(Ticket $ticket)
    {
        $ticket->created_by = Auth::user()->id;
    }
}
