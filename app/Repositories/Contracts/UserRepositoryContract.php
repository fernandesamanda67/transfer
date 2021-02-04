<?php

namespace App\Repositories\Contracts;

interface UserRepositoryContract
{
    public function isCommonUser($payerId);
    public function verifyWallet($payerId, $value);   
    public function getUser($id);
    public function updateUser($id, array $values);
    public function updateWallet($payerId, $payeeId, $value);
}