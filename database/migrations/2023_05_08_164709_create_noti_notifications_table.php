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
        Schema::create('noti_notifications', function (Blueprint $table) {
            $table->id();
            $table->text('body')->nullable();
            $table->string('title')->nullable();


            $table->unsignedBigInteger('type_id')->nullable();

            $table->string('url')->nullable();

            $table->foreignId('user_id')->nullable()->constrained(
                table: 'users'
            )->onUpdate('cascade')->nullOnDelete();

            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('noti_types')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noti_notifications');
    }
};
