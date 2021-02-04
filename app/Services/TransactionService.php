<?php

namespace App\Services;

use App\Repositories\Contracts\TransactionRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\TransactionServiceContract;
use App\Services\Contracts\AuthorizationServiceContract;
use App\Services\Contracts\NotificationServiceContract;

class TransactionService implements TransactionServiceContract
{

    private $transactionRepositoryContract;
    private $userRepositoryContract;
    private $authorizationService;
    private $notificationService;

    public function __construct(
        TransactionRepositoryContract $transactionRepositoryContract, 
        UserRepositoryContract $userRepositoryContract,
        AuthorizationServiceContract $authorizationServiceContract, 
        NotificationServiceContract $notificationServiceContract) 
    {
        $this->transactionRepositoryContract = $transactionRepositoryContract;
        $this->userRepositoryContract = $userRepositoryContract;
        $this->authorizationServiceContract = $authorizationServiceContract;
        $this->notificationServiceContract = $notificationServiceContract;
    }

    public function transfer($value, $payerId, $payeeId)
    {
        try {            
            $values['authorized'] = 0;
            $values['notified'] = 0;
            $values['processed'] = 0;
            $values['canceled'] = 0;
            $message = '';
            $statud = 0;
            $transaction = [];
            $transfer = $this->transactionRepositoryContract->createTransaction($value, $payerId, $payeeId);
            if ($transfer) {
                
                if ($this->authorizationServiceContract->isAuthorized()) {
                    $values['authorized'] = 1;        
                    if ($this->notificationServiceContract->isNotified()) {
                        
                        $updateWallet = $this->userRepositoryContract->updateWallet($payerId, $payeeId, $value);

                        if ($updateWallet) {
                            $values['notified'] = 1;
                            $values['processed'] = 1;
                            $message = 'Transação enviada com sucesso.';
                            $status = 200;
                        } else {
                            $message = 'Erro ao atualizar carteira do usuário.';
                            $status = 500;
                        }
                    } else {
                        $values['canceled'] = 1;
                        $message = 'Erro ao enviar notificação ao usuário. Transação cancelada.';
                        $status = 203;
                    }
                } else {
                    $values['canceled'] = 1;
                    $message = 'Transação não autorizada.';
                    $status = 203;
                }

                $transaction = $this->transactionRepositoryContract->updateTransaction($transfer->id, $values);
            } else {
                $message = 'Erro ao enviar transação.';
                $status = 500;
            }

            return response()->json([
                "message" => $message,
                "result" => $transaction
            ], $status);

        } catch (Exception $e) {
            return response()->json([
                "message" => $e->getCode(),
                "result" => []
            ], 500);            
        }
    }

}