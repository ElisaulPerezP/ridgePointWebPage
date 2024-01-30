<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingMattersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pending_matters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('message');
            $table->date('creation_date');
            $table->string('creation_place');
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('responsible_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_matters');
    }
}