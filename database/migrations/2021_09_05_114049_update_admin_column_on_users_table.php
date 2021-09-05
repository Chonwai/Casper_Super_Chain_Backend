<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateAdminColumnOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->boolean('is_admin')->default(false);
            DB::statement("ALTER TABLE `users` CHANGE `role` `role` ENUM('supplier','customer','admin') NOT NULL;");
            $table->boolean('is_active')->default(false);
            $table->string('auth_token');
            $table->string('reset_password_token')->nullable();
            $table->ipAddress('ip_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('is_admin');
            $table->dropColumn('is_active');
            $table->dropColumn('auth_token');
            $table->dropColumn('reset_password_token');
            $table->dropColumn('ip_address');
        });
    }
}
