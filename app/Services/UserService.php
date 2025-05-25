<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected UserRepositoryInterface $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAll()
    {
        return $this->userRepo->all();
    }

    public function getById($id)
    {
        return $this->userRepo->find($id);
    }

    public function getByEmail($email)
    {
        return $this->userRepo->findByEmail($email);
    }

    public function create(UserDTO $data)
    {
        return $this->userRepo->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);
    }

    public function update($id, array $data)
    {
        return $this->userRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->userRepo->delete($id);
    }
}
