<?php

namespace App\Application\Auth;

use App\Domain\User\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUserHandler
{
    public function __construct(
        private UserRepository $users
    ) {}

    public function handle(string $email, string $password): User
    {
        $user = $this->users->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales inválidas.'],
            ]);
        }

        return $user;
    }
}
