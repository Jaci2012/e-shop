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
        Schema::create('vendeurs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Retirez `column:`
            $table->string('adresse');
            $table->string('numero')->unique(); // Assurez-vous que cela est unique si nécessaire
            $table->string('email')->unique(); // Assurez-vous que cela est unique si nécessaire
            $table->foreignId('roles_id')->constrained()->onDelete('cascade'); // Ajoutez cette ligne
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendeurs');
    }
};
