<?php

namespace App\Http\Livewire;

use App\Services\TicketService;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $users;
    public $assignee;
    public $types;
    public $type;
    public $priorities;
    public $priority;
    public $statuses;
    public $status;
    public $reporter;
    public $sortField;
    public $sortAsc = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = false;
        }
        
        $this->sortField = $field;
    }

    public function render()
    {
        $ticketService = app(TicketService::class);

        return view('livewire.data-table', [
            'tickets' => $ticketService->getList([
                'search' => $this->search,
                'assignee' => $this->assignee,
                'type' => $this->type,
                'priority' => $this->priority,
                'status' => $this->status,
                'reporter' => $this->reporter,
                'orderBy' => $this->sortField,
                'orderDirection' => $this->sortAsc,
            ]),
        ]);
    }
}
