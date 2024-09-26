<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable event listeners
        Event::fake();

        // Create roles
        $superRole = Role::firstOrCreate(['name' => 'superadmin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $viwawaRole = Role::firstOrCreate(['name' => 'viwawa']);

        // Fetch the roles based on the route name(value)
        $superPerm = Permission::where('name', 'like', 'superadmin.%')->get();
        $adminPerm = Permission::where('name', 'like', 'admin.%')->get();
        $commonPerm = Permission::where('name', 'like', 'common.%')->get();

        // Assign permissions to roles
        $superRole->syncPermissions([$superPerm, $commonPerm]);
        $adminRole->syncPermissions([$adminPerm, $commonPerm]);
        $viwawaRole->syncPermissions($commonPerm);

        // Create (owner) super user and assign roles
        $super = User::firstOrCreate(
            [
                'email' => 'sjwmatiko@gmail.com',
            ],
            [
                'first_name' => 'Stan',
                'last_name' => 'Mtete',
                'phone_number' => '255744597690',
                'password' => 'superadmin',
            ],
        );
        $super->assignRole($superRole);

        // Create (vms) admin user and assign roles
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@vms.massa.host',
            ],
            [
                'first_name' => 'Viwawa',
                'last_name' => 'Admin',
                'phone_number' => '255621741976',
                'password' => 'admin123',
            ],
        );
        $admin->assignRole($adminRole);

        // Enable event listeners again
        Event::fake(false);
    }
}
