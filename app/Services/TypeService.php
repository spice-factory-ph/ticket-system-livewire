<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TypeRepository;

class TypeService
{
    public function __construct(TypeRepository $typeService)
    {
        $this->typeService = $typeService;
    }

    public function getList()
    {
        return $this->typeService->getList();
    }
}
