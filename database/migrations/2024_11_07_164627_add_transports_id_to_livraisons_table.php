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
        Schema::table('livraisons', function (Blueprint $table) {
            $table->unsignedBigInteger('transports_id')->nullable(); // Ajout de transports_id
            $table->foreign('transports_id')->references('id')->on('transports')->onDelete('cascade'); // Définir la clé étrangère
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livraisons', function (Blueprint $table) {
            $table->dropForeign(['transports_id']); // Supprimer la contrainte de clé étrangère
            $table->dropColumn('transports_id'); // Supprimer la colonne transports_id
        });
    }
};
