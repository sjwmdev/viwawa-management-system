<?php

use App\Traits\CommonMigrationColumns;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMfukoBalanceTable extends Migration
{
    use CommonMigrationColumns;

    public function up()
    {
        Schema::create('mfuko_balance', function (Blueprint $table) {
            $table->id();
            $table->decimal('contribution_balance', 15, 2)->default(0);
            $table->decimal('income_balance', 15, 2)->default(0);
            $table->decimal('expenditure_balance', 15, 2)->default(0);
            $table->decimal('total_balance', 15, 2)->default(0);
            $table->date('date')->index()->comment('Date of the balance entry');

            $this->auditInfoColumns($table);
            $table->timestamps();
            $table->softDeletes();

            $this->auditInfoColumnsForeignKeys($table);
        });
    }

    public function down()
    {
        Schema::dropIfExists('mfuko_balance');
    }
}
