<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noti_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained(
                table: 'users'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('notification_id')->nullable()->constrained(
                table: 'noti_notifications'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('read')->default(false);
            $table->boolean('delete')->default(false);
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
        Schema::dropIfExists('noti_users');
    }
};
