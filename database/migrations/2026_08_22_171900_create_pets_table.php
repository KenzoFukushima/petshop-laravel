<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dono')->constrained()->cascadeOnDelete();
            $table->string('nome', 100);
            $table->string('especie', 50);
            $table->string('raça', 100)->nullable();
            $table->integer('idade')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};