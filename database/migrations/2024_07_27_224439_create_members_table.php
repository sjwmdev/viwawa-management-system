<?php

use App\Traits\CommonMigrationColumns;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    use CommonMigrationColumns;

    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('gender', ['male', 'female']);
            $table->string('residence')->nullable();
            $table->string('occupation')->nullable();
            $table->enum('family_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->enum('presence_status', ['active', 'inactive']);

            $this->auditInfoColumns($table);
            $table->timestamps();
            $table->softDeletes();

            $this->auditInfoColumnsForeignKeys($table);
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
}
