<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->uuid('id')->index()->primary();
            $table->uuid('requester_id')->index();
            $table->uuid('addressee_id')->index();
            $table->enum('status', ['requesting', 'followed', 'blocked'])->index()->default('requesting');
            $table->timestamps();
            $table->foreign('requester_id')->references('id')->on('users');
            $table->foreign('addressee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
