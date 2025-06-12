<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('evaluacions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
    $table->string('titulo');
    $table->json('preguntas'); // JSON para guardar preguntas y respuestas
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacions');
    }
};
