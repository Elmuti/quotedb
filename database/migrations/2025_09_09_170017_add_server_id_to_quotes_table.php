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
        Schema::table('quotes', function (Blueprint $table) {
            $table->unsignedBigInteger('server_id')->nullable()->index();
            $table->index(['server_id', 'created_at'], 'quotes_server_id_created_at_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropIndex('quotes_server_id_created_at_idx');
            $table->dropIndex(['server_id']);
            $table->dropColumn('server_id');
        });
    }
};
