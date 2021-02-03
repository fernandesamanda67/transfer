<?php

namespace App\Rules;

use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Contracts\Validation\Rule;

class IsCommonUser implements Rule
{

    private $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function passes($attribute, $value)
    {
        return $this->userRepository->isCommonUser($value);
    }

    public function message()
    {
        return 'Lojistas apenas recebem transferências.';
    }
}
