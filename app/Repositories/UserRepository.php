<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryContract{

    private $model;

    public function __construct()
    {
        $this->model = new User;
    }

    public function isCommonUser($payerId)
    {
        $user = $this->model->where('id', $payerId)->first();
        if (!$user || $user->common_user !== 1) {
            return false;
        }        
        return true;
    }

    public function verifyWallet($id, $value) {
        $values = $this->model->select('wallet')->where('id', $id)->first();
        if (floatval($value) > $values->wallet) {
            return false;
        } 
        
        return true;        
    }

    public function getUser($id)
    {
        return $this->model->find($id);
    }

    public function updateUser($id, array $values)
    {
        $user = $this->getUser($id);
        $user->update($values);
        return $user;
    }

    public function updateWallet($payerId, $payeeId, $value)
    {
        DB::beginTransaction();
        try {
            $payer = $this->getUser($payerId);
            $payee = $this->getUser($payeeId);
            $this->updateUser($payerId, ['wallet' => $payer->wallet -= $value]);
            $this->updateUser($payeeId, ['wallet' => $payee->wallet += $value]);
            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }
}