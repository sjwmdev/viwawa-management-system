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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('table_name');
            $table->unsignedBigInteger('row_id');
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();

            $table->longText('request_url')->nullable();
            $table->longText('request_method')->nullable();
            $table->integer('status_code')->nullable();
            $table->longText('remote_address')->nullable();
            $table->longText('path')->nullable();
            $table->text('host')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
