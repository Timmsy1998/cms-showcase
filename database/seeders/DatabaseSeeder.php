<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /// Roles
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'editor']);
    Role::create(['name' => 'member']);

    // Permissions (e.g., 'create-article', 'edit-article', etc.)
    Permission::create(['name' => 'create-article']);
    Permission::create(['name' => 'edit-article']);
    Permission::create(['name' => 'delete-article']);

    // Assign permissions to roles
    $admin = Role::findByName('admin');
    $admin->givePermissionTo(['create-article', 'edit-article', 'delete-article']);

    $editor = Role::findByName('editor');
    $editor->givePermissionTo(['create-article', 'edit-article']);

    // Assign roles to users (you can do this in the registration or in seeds)
    $user = App\Models\User::find(1); // Replace 1 with the ID of an existing user
    $user->assignRole('admin');
    }
}
