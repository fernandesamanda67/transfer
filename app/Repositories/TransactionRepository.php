<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryContract;

class TransactionRepository implements TransactionRepositoryContract{

    private $model;

    public function __construct()
    {
        $this->model = new Transaction;
    }

    public function createTransaction($value, $payerId, $payeeId)
    {
        return $this->model->create(
            [
                'payer_id' => $payerId,
                'payee_id' => $payeeId,
                'value' => $value,
            ]
        );
    }

    public function updateTransaction($transactionId, $data)
    {
        $transaction = $this->model->find($transactionId);
        if ($transaction) {
            $transaction->authorized = $data['authorized'];
            $transaction->notified = $data['notified'];
            $transaction->canceled = $data['canceled'];
            $transaction->processed = $data['processed'];
            $transaction->save();
            return $transaction;
        }
        return false;
    }
}