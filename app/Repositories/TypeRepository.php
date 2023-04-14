<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Type;

class TypeRepository
{
    public function getList()
    {
        return Type::all();
    }
}
