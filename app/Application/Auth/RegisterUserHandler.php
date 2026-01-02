<?php

namespace App\Application\Auth;

use App\Domain\User\UserRepository;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class RegisterUserHandler
{
    public function __construct(
        private UserRepository $users
    ) {}

    public function handle(array $data): User
    {
        if ($this->users->findByEmail($data['email'])) {
            throw ValidationException::withMessages([
                'email' => ['El email ya está registrado'],
            ]);
        }

        $data['password'] = Hash::make($data['password']);

        return $this->users->create($data);
    }
}
