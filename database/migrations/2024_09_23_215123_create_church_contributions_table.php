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
    public function up()
    {
        Schema::create('church_contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contribution_type_id')->constrained('contribution_types')->onDelete('cascade');
            $table->string('family_name'); // Family name or member's name
            $table->decimal('amount', 15, 2); // Amount contributed
            $table->text('description')->nullable(); // Optional description
            $table->date('contribution_date')->useCurrent(); // Date of the contribution, defaut current date
            $table->string('month'); // Month of the contribution
            $table->year('year'); // Year of the contribution
            $table->enum('status', ['paid', 'not_paid', 'ahadi'])->default('not_paid'); // Status of the contribution

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
        Schema::dropIfExists('church_contributions');
    }
};
