<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('income_type')->insert([
            [
                'name' => 'sadaka ya jumamosi',
                'description' => 'Mapato yanayotokana na sadaka zilizotolewa na wanachama kila Jumamosi.',
                'identifier' => 'jumamosi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'vyanzo vingine',
                'description' => 'Mapato yanayotokana na vyanzo vingine.',
                'identifier' => 'vyanzovingine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
