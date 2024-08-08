<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SetupViwawa extends Command
{
    protected $signature = 'project:setup';
    protected $description = 'Setup the project by running initial commands';

    public function handle()
    {
        if ($this->confirm('Do you wish to continue with the project setup?', true)) {
            // $this->info('generating VMS application key...');
            // $this->call('key:generate');
            // $this->info('VMS application key generated successfully.');

            $this->info('Dropping all existing tables...');
            $this->dropAllTables();
            $this->info('All tables dropped successfully.');

            $this->info('Running migrations...');
            $this->call('migrate:fresh');
            $this->info('Migrations completed successfully.');

            $this->info('Creating permission routes...');
            $this->call('permission:create-permission-routes');
            $this->info('Permission routes created successfully.');

            $this->info('Seeding the database...');
            $this->call('db:seed', ['--class' => 'DatabaseSeeder']);
            $this->info('Database seeded successfully.');

            // $this->info('Starting the server...');
            // $this->call('serve', ['--port' => 8081]);
            // $this->info('Server started successfully on port 8081.');
        } else {
            $this->info('Setup aborted.');
        }
    }

    protected function dropAllTables()
    {
        Schema::disableForeignKeyConstraints();

        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE');

        foreach ($tables as $table) {
            $tableName = $table->{"Tables_in_$dbName"};
            Schema::dropIfExists($tableName);
        }

        Schema::enableForeignKeyConstraints();
    }
}
