<?php

namespace App\Http\Controllers\Api;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json($this->userService->getAll());
    }

    public function store(Request $request)
    {
        $dto = new UserDTO(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );

        return response()->json($this->userService->create($dto));
    }

    public function show($id)
    {
        return response()->json($this->userService->getById($id));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->userService->update($id, $request->all()));
    }

    public function destroy($id)
    {
        return response()->json($this->userService->delete($id));
    }
}
