<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    public function __construct(ProjectRepository $projectService)
    {
        $this->projectService = $projectService;
    }

    public function getList()
    {
        return $this->projectService->getList();
    }
}
