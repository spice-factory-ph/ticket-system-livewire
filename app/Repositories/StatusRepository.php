<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Status;

class StatusRepository
{
    public function getList()
    {
        return Status::all();
    }
}
