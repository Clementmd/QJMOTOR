<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->text('couleurs')->nullable();
            $table->json('images_carrousel')->nullable(); 
            $table->json('descriptions_carrousel')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn(['couleurs', 'images_carrousel', 'descriptions_carrousel']);
        });
    }
};
