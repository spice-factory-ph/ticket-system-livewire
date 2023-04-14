<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Priority;

class PriorityRepository
{
    public function getList()
    {
        return Priority::all();
    }
}
