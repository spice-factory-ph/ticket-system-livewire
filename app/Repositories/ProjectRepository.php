<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function getList()
    {
        return Project::all();
    }
}
