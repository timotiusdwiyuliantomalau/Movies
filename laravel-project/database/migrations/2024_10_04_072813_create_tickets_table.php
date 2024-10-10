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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'tickets_user_id'
            );
            $table->json('detail_movie');
            $table->json('seat');
            $table->string('theater');
            $table->float('price');
            $table->string('date');
            $table->string('provider');
            $table->string('time');
            $table->integer('total_ticket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
