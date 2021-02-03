<?php

namespace App\Repositories\Contracts;

interface UserRepositoryContract
{
    public function isCommonUser($payerId);
    public function verifyWallet($payerId, $value);   
    public function updateUser($id, array $values);
}