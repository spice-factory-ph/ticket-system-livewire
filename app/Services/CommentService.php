<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentService
{
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getList(Ticket $ticket)
    {
        return $this->commentRepository->getList($ticket);
    }

    public function create(Request $request, Ticket $ticket)
    {
        return $this->commentRepository->create($request, $ticket);
    }
}
