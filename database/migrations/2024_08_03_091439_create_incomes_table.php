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
        // tbl storing the 'mapato' records.
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('income_type_id')->constrained('income_type')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->date('date');
            $table->text('description')->nullable();

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
        Schema::dropIfExists('incomes');
    }
};
