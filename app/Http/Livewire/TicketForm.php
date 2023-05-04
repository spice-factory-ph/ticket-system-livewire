<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;

class TicketForm extends Component
{
    public Ticket $ticket;
    public $projects;
    public $types;
    public $statuses;
    public $priorities;
    public $users;
    public $comment;

    protected $rules = [
        'ticket.title' => 'required',
        'ticket.description' => 'required',
        'ticket.project_id' => 'required',
        'ticket.type_id' => 'required',
        'ticket.priority_id' => 'required',
        'ticket.status_id' => 'required',
        'ticket.assigned_to' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();
        $this->ticket->save();

        session()->flash('success', 'Ticket updated successfully!');
    }

    public function render()
    {
        return view('livewire.ticket-form');
    }
}
