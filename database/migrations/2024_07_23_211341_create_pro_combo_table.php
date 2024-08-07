<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProComboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_combo', function (Blueprint $table) {
            $table->id();
            $table->string('combo');
            $table->decimal('precio', 10, 2); // Ajusta la precisión y escala según tus necesidades
            $table->boolean('estado'); // Booleano para el estado
            $table->string('codigo')->unique(); // Código único para el combo
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
        Schema::dropIfExists('pro_combo');
    }
}
