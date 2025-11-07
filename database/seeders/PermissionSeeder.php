<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 🧩 Define all permissions in your system
        $permissions = [
            // General
            'view dashboard',

            // Teacher-related
            'manage teachers',

            // Student-related
            'manage students',
            'view students',

            // Parent-related
            'manage parents',
            'view parents',

            // Class-related
            'manage classes',
            'view classes',

            // Bursar/Finance
            'manage payments',
            'view payments',
        ];

        // ✅ Create each permission if not already existing
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 🧩 Get the roles (must already exist)
        $superAdmin = Role::where('name', 'Super Admin')->first();
        $schoolAdmin = Role::where('name', 'School Admin')->first();
        $teacher = Role::where('name', 'Teacher')->first();
        $student = Role::where('name', 'Student')->first();
        $parent = Role::where('name', 'Parent')->first();
        $bursar = Role::where('name', 'Bursar')->first();

        // ✅ Assign permissions to each role
        $superAdmin?->syncPermissions(Permission::all());

        $schoolAdmin?->syncPermissions([
            'manage teachers',
            'manage students',
            'manage parents',
            'manage classes',
            'view dashboard',
        ]);

        $teacher?->syncPermissions([
            'view students',
            'view classes',
            'view dashboard',
        ]);

        $student?->syncPermissions([
            'view classes',
            'view dashboard',
        ]);

        $parent?->syncPermissions([
            'view students',
            'view payments',
        ]);

        $bursar?->syncPermissions([
            'manage payments',
            'view payments',
        ]);

        $this->command->info('✅ Permissions seeded and assigned to roles successfully!');
    }
}
