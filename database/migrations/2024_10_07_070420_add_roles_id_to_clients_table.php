<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('clients', function (Blueprint $table) {
        $table->unsignedBigInteger('roles_id')->nullable()->after('id'); // Ajout de la colonne roles_id
        $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade'); // Définir la clé étrangère
    });
}

public function down()
{
    Schema::table('clients', function (Blueprint $table) {
        $table->dropForeign(['roles_id']);
        $table->dropColumn('roles_id');
    });
}

};
