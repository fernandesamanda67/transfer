<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TransactionTest extends TestCase
{

    public function testTransactionValidations()
    {

        // Invalid value
        $data = [
            "payer_id" => 1,
            "payee_id" => 2,
            "value" => 0,
        ];
        $response = $this->postJson(route('transaction'), $data);
        $response->assertStatus(422);


        // Payer is not a common user
        $data = [
            "payer_id" => 2,
            "payee_id" => 1,
            "value" => 100,
        ];
        $response = $this->postJson(route('transaction'), $data);
        $response->assertStatus(422);


        // Insufficient amount
        $data = [
            "payer_id" => 1,
            "payee_id" => 2,
            "value" => 100,
        ];
        $response = $this->postJson(route('transaction'), $data);
        $response->assertStatus(422);
    }
}
