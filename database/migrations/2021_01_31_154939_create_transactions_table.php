<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->float('value', 20, 2);
            $table->foreignId('payer_id')->constrained('users');
            $table->foreignId('payee_id')->constrained('users');            
            $table->boolean('processed')->default(false);
            $table->boolean('canceled')->default(false);
            $table->boolean('notified')->default(false);
            $table->boolean('authorized')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
