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
            $table->uuid('id')->index()->primary();
            $table->uuid('order_id')->index();
            $table->uuid('paid_by')->index();
            $table->uuid('received_by')->index();
            $table->unsignedDecimal('amount', 8, 2)->default(0);
            $table->string('source')->nullable()->index();
            $table->enum('status', ['ready', 'paying', 'completed'])->index();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('paid_by')->references('id')->on('users');
            $table->foreign('received_by')->references('id')->on('users');
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
