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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('server_id')->index();
            $table->string('name');
        });
        Schema::create('user_servers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->foreignId('server_id')->constrained()->onDelete('cascade');
        });
        Schema::table('quotes', function (Blueprint $table) {
            $table->foreignId('server_id')->nullable()->index();
            $table->index(['server_id', 'created_at'], 'quotes_server_id_created_at_idx');
        });
    }
};
