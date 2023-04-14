<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PriorityRepository;

class PriorityService
{
    public function __construct(PriorityRepository $priorityService)
    {
        $this->priorityService = $priorityService;
    }

    public function getList()
    {
        return $this->priorityService->getList();
    }
}
