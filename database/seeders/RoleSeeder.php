<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $admin=  Role::query()->updateOrCreate(
            [
                'title'=>'admin'
            ]
        );
        $permissions=Permission::all();
        $admin->permissions()->sync($permissions);

        Role::query()->updateOrCreate([
            'title'=>'user'
        ]);

    }
}
