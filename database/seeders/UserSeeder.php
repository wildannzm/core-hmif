<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default department if it doesn't exist
        $department = Department::firstOrCreate([
            'name' => 'HMIF'
        ]);

        // Create default position if it doesn't exist
        $position = Position::firstOrCreate([
            'name' => 'Administrator'
        ]);

        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create admin user
        $adminUser = User::create([
            'name' => 'Administrator HMIF',
            'nim' => 'ADMIN001',
            'email' => 'hmif@unma.ac.id',
            'password' => Hash::make('hmif12345'),
            'email_verified_at' => now(),
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);

        // Assign admin role to the user
        $adminUser->assignRole($adminRole);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: hmif@unma.ac.id');
        $this->command->info('Password: hmif12345');
    }
}
