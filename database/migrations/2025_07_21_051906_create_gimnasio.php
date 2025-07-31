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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // INT AUTO_INCREMENT PRIMARY KEY
            $table->string('nombre_usuario', 50)->unique(); // VARCHAR(50) NOT NULL UNIQUE
            $table->string('correo_electronico', 100)->unique(); // VARCHAR(100) NOT NULL UNIQUE
            $table->string('numero_telefono', 20)->nullable(); // VARCHAR(20) - nullable porque no tiene NOT NULL
            $table->date('fecha_nacimiento')->nullable(); // DATE - nullable porque no tiene NOT NULL
            $table->string('contrasena', 255); // VARCHAR(255) NOT NULL
            $table->timestamp('fecha_registro')->useCurrent(); // TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            
            // No incluimos $table->timestamps() porque usamos fecha_registro personalizado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
