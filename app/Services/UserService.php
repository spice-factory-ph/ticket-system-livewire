<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $userService)
    {
        $this->userService = $userService;
    }

    public function getList()
    {
        return $this->userService->getList();
    }
}
