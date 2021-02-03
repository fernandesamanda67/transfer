<?php

namespace App\Repositories\Contracts;

interface TransactionRepositoryContract
{
    public function createTransaction($value, $payerId, $payeeId);
}