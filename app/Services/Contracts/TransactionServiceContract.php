<?php

namespace App\Services\Contracts;

interface TransactionServiceContract
{
    public function transfer($value, $payerId, $payeeId);
}