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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade'); 
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->string('nom', 150);
            $table->integer('prix'); 
            $table->string('image_principale', 255);
            $table->string('image_fond', 255)->nullable(); 
            $table->longText('caracteristiques')->nullable(); 
            $table->integer('cylindree')->nullable(); 
            $table->decimal('puissance', 8, 2)->nullable(); 
            $table->decimal('poids', 8, 2)->nullable(); 
            $table->integer('couple')->nullable(); 
            $table->string('titre')->nullable(); 
            $table->string('description_courte', 5200)->nullable();
            $table->json('galeries_photos')->nullable();
            $table->text('description')->nullable(); 
            $table->boolean('actif')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
