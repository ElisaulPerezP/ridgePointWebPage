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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('pending_matter_client_id')->nullable()->constrained('pending_matters');
            $table->foreignId('pending_matter_responsible_id')->nullable()->constrained('pending_matters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['pending_matter_client_id']);
            $table->dropForeign(['pending_matter_responsible_id']);
            $table->dropColumn(['pending_matter_client_id', 'pending_matter_responsible_id']);
        });
    }
};