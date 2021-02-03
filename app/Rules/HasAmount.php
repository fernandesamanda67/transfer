<?php

namespace App\Rules;

use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Contracts\Validation\Rule;

class HasAmount implements Rule
{

    private $userRepository;
    private $payerId;

    public function __construct(UserRepositoryContract $userRepository, $payerId, $value)
    {
        $this->userRepository = $userRepository;
        $this->payer_id = $payerId;
        $this->value = $value;
    }

    public function passes($id, $value)
    {
        return $this->userRepository->verifyWallet($this->payer_id, $this->value);
    }

    public function message()
    {
        return 'Saldo insuficiente.';
    }
}
