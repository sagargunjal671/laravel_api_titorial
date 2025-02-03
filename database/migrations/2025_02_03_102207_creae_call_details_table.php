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
        Schema::create('call_details', function (Blueprint $table) {
            $table->id();
            $table->string('call_id')->uniqid();
            $table->integer('duration');
            $table->timestamp('call_time');
            $table->string('caller');
            $table->string('receiver');
            $table->enum('status', ['completed', 'missed', 'ongoing']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_details');
    }
};
