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
        Schema::table('transports', function (Blueprint $table) {
            $table->unsignedBigInteger('villes_id')->nullable(); // Ajout de villes_id
            $table->foreign('villes_id')->references('id')->on('villes')->onDelete('cascade'); // Définir la clé étrangère
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropForeign(['villes_id']); // Supprimer la contrainte de clé étrangère
            $table->dropColumn('villes_id'); // Supprimer la colonne villes_id
        });
    }
};
