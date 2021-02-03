<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Services\Contracts\TransactionServiceContract;

class TransactionController extends Controller
{

    /**
     * @OA\PathItem(
     * 
     *     ref="",
     *     summary="Returns the transaction status",
     *     path="Controllers",
     *     @OA\Response(response="200", description="A transaction"),
     * ),
     * 
    */

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Transfer",
     *      description="Api for transaction between users",
     *      @OA\Contact(
     *          email="fernandes.amanda67@gmail.com"
     *      )
     * )
     */

     /**
     * @OA\Post(
     *      path="/api/transaction",
     *      tags={"Transaction"},
     *      summary="Send the transaction",
     *      description="Returns transaction",
     *     @OA\Parameter(
     *         name="payer_id",
     *         in="query",
     *         description="Who is going to send the money",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="payee_id",
     *         parameter = 1,
     *         in="query",
     *         description="Who is going to receive the money",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="value",
     *         in="query",
     *         description="The value of the transaction",
     *         required=true,
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *       content={
     *           @OA\MediaType(
     *                 mediaType="application/json"
     *             )
     *       }),
     *       @OA\Response(response=500, description="Error",
     *       content={
     *           @OA\MediaType(
     *                 mediaType="application/json"
     *             )
     *       })
     *     )
     * 
     */
    public function send(TransactionRequest $request, TransactionServiceContract $transactionServiceContract)
    {
        return $transfer = $transactionServiceContract->transfer($request->value, $request->payer_id, $request->payee_id);
    }
}