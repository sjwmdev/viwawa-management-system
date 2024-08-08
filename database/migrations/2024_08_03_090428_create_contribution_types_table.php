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
        Schema::create('contribution_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('goal')->nullable(); // What does the contribution is all about (it's goal)
            $table->decimal('goal_amount', 15, 2)->nullable();
            $table->string('identifier', 20)->unique();  // Unique identifier on name
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contribution_types');
    }
};
