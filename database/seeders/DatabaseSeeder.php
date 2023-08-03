<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if the 'admin' role does not exist before creating it
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        // Check if the 'editor' role does not exist before creating it
        if (!Role::where('name', 'editor')->exists()) {
            Role::create(['name' => 'editor']);
        }

        // Check if the 'member' role does not exist before creating it
        if (!Role::where('name', 'member')->exists()) {
            Role::create(['name' => 'member']);
        }

        // Check if the 'create-article' permission does not exist before creating it
        if (!Permission::where('name', 'create-article')->exists()) {
            Permission::create(['name' => 'create-article']);
        }

        // Check if the 'edit-article' permission does not exist before creating it
        if (!Permission::where('name', 'edit-article')->exists()) {
            Permission::create(['name' => 'edit-article']);
        }

        // Check if the 'delete-article' permission does not exist before creating it
        if (!Permission::where('name', 'delete-article')->exists()) {
            Permission::create(['name' => 'delete-article']);
        }

        // Assign permissions to roles
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(['create-article', 'edit-article', 'delete-article']);

        $editor = Role::findByName('editor');
        $editor->givePermissionTo(['create-article', 'edit-article']);

        // Assign roles to users (you can do this in the registration or in seeds)
        $user = User::find(1); // Replace 1 with the ID of an existing user
        $user->assignRole('admin');
    }
}
