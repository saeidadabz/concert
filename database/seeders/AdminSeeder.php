<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole=Role::query()->where('title','admin')->first();
        $adminUser=User::query()->create([
           'role_id'=>$adminRole->id,
            'name'=>'saeid',
            'email'=>'saeidadabzadeh20@gmail.com',
            'password'=>bcrypt('123')
        ]);

    }
}
