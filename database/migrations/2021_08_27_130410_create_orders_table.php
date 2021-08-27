<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->index()->primary();
            $table->uuid('created_by')->index();
            $table->uuid('ordered_by')->index();
            $table->enum('status', ['created', 'updating', 'paying', 'delivering', 'finished'])->index();
            $table->string('remark');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('ordered_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
