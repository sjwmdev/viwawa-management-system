<?php

use App\Traits\CommonMigrationColumns;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use CommonMigrationColumns;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // tbl storing the 'michango' records.
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contribution_type_id')->constrained('contribution_types')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->decimal('paid_amount', 15, 2);
            $table->date('date');
            $table->decimal('remaining_amount', 15, 2)->nullable();
            $table->enum('status', ['pending', 'completed', 'partial'])->default('pending');

            $this->auditInfoColumns($table);
            $table->timestamps();
            $table->softDeletes();

            $this->auditInfoColumnsForeignKeys($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
