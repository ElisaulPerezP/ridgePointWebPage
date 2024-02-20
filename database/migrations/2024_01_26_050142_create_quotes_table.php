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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable(); 
            $table->string('email')->nullable(); 
            $table->text('description');
            $table->string('message')->nullable();
            $table->date('creation_date');
            $table->string('creation_place');
            $table->string('image_rights')->nullable();
            $table->date('response_date')->nullable(); 
            $table->text('response_message')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
