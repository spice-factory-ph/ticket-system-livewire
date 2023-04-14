<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\StatusRepository;

class StatusService
{
    public function __construct(StatusRepository $statusService)
    {
        $this->statusService = $statusService;
    }

    public function getList()
    {
        return $this->statusService->getList();
    }
}
