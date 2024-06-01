<?php

namespace App\Http\Controllers;

use App\Business\Contracts\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected readonly UserServiceInterface $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->$userService = $userService;
    }
}
