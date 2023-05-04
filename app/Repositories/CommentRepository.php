<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepository
{
    public function getList(Ticket $ticket)
    {
        return Comment::whereHas('ticket', function (Builder $query) use ($ticket) {
            $query->where('id', $ticket->id);
        })->get();
    }

    public function create($text, Ticket $ticket)
    {
        if (!$text) {
            return;
        }

        $comment = new Comment();
        $comment->text = $text;
        $comment->ticket_id = $ticket->id;
        $comment->user_id = Auth::id();
        $comment->save();

        return $comment;
    }
}
