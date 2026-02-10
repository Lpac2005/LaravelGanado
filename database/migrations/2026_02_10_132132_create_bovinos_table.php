<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bovinos', function (Blueprint $table) {
            $table->id();
            $table->string('arete')->unique();
            $table->string('nombre')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('raza');
            $table->enum('sexo', ['Macho', 'Hembra']);
            $table->decimal('peso_nacimiento', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bovinos');
    }
};
