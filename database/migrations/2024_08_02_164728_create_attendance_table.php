<?php

use App\Traits\CommonMigrationColumns;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    use CommonMigrationColumns;

    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->boolean('present')->default(false);
            $table->date('date');

            $this->auditInfoColumns($table);
            $table->timestamps();
            $table->softDeletes();

            $this->auditInfoColumnsForeignKeys($table);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
