<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   /*     Permission::query()->insert([
            [
                'title'=>'create-cat'
            ],
            [
                'title'=>'read-cat'
            ],
            [
                'title'=>'update-cat'
            ],
            [
                'title'=>'delete-cat'
            ],
        ]);

        Permission::query()->insert([
            [
                'title'=>'create-artist'
            ],
            [
                'title'=>'read-artist'
            ],
            [
                'title'=>'update-artist'
            ],
            [
                'title'=>'delete-artist'
            ],
        ]);

        Permission::query()->insert([
            [
                'title'=>'read-user'
            ],
            [
                'title'=>'update-user'
            ],
            [
                'title'=>'delete-user'
            ]
        ]);

        Permission::query()->insert([
            [
                'title'=>'create-role'
            ],
            [
                'title'=>'read-role'
            ],
            [
                'title'=>'update-role'
            ],
            [
                'title'=>'delete-role'
            ]
        ]);*/

        $permissions=[
  //cat permissions
            [
                'title'=>'create-cat'
            ],
            [
                'title'=>'read-cat'
            ],
            [
                'title'=>'update-cat'
            ],
            [
                'title'=>'delete-cat'
            ],

//artist permissions
            [
                'title'=>'create-artist'
            ],
            [
                'title'=>'read-artist'
            ],
            [
                'title'=>'update-artist'
            ],
            [
                'title'=>'delete-artist'
            ],

//user permissions
            [
                'title'=>'read-user'
            ],
            [
                'title'=>'update-user'
            ],
            [
                'title'=>'delete-user'
            ],

//role permissions
            [
            'title'=>'create-role'
        ],
            [
                'title'=>'read-role'
            ],
            [
                'title'=>'update-role'
            ],
            [
                'title'=>'delete-role'
            ]


        ];

        foreach($permissions as $permission){
            Permission::query()->updateOrCreate($permission);
        }
    }
}
