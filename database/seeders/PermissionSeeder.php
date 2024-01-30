<?php

declare(strict_types=1);

namespace Database\Seeders;

use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // create a role.
        Role::truncate();
        Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'name'        => 'Все права',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ]
        ]);

        Role::first()->permissions()->save(Permission::first());
    }
}
