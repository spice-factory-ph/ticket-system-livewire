<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use App\Services\CommentService;

class CommentsSection extends Component
{
    public Ticket $ticket;
    public $comment;
    public $successMessage;

    protected $rules = [
        'comment' => 'required',
    ];

    public function addComment()
    {
        app(CommentService::class)->create($this->comment, $this->ticket);

        $this->ticket = Ticket::find($this->ticket->id);

        $this->comment = '';

        $this->successMessage = 'Comment was added successfully!';
    }

    public function render()
    {
        return view('livewire.comments-section');
    }
}
