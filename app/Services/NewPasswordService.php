<?php

namespace App\Services;

use App\Models\NewPassword;



class NewPasswordService
{
    public function __construct(protected NewPassword $newPassword) {}

    public function create(array $data)
    {
        return $this->newPassword->create([
            ...$data,
            'token' => get_uuid()
        ]);
    }

    public function checkToken(string $token)
    {
        return $this->newPassword->where(['token' => $token])->exists();
    }
}