<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

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

    public function updateUser($id, array $values)
    {
        $user = $this->model->find($user_id);
        $user->update($values);
        return $user;
    }
}