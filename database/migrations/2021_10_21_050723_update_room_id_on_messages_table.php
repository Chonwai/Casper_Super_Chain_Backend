<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoomIdOnMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->renameColumn('follow_id', 'room_id')->change();
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('recipient_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->renameColumn('room_id', 'follow_id')->change();
            $table->dropForeign('messages_room_id_foreign');
            $table->dropForeign('messages_sender_id_foreign');
            $table->dropForeign('messages_recipient_id_foreign');
        });
    }
}
