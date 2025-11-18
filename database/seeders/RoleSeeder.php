<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $user = [
        [
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("admin1234!")
        ],
       [
            "name" => "member",
            "email" => "member@gmail.com",
            "password" => bcrypt("member1234!")
       ],
    ];
       $users = User::insert($user);
       $role = [
        [
"role_name" => "admin"
        ],
        [
"role_name" => "member"
        ],
        ];
        Role::insert($role);
        echo "CREATE USER SUCCESS: " . $users;
    //    foreach($users as $user) {
    //     if($user->id == 1) {
    //         RoleUser::create([
    //             "user_id" => $user->id,
    //             "role_id" => $user->id
    //         ]);
    //         return;
    //     }
    //     if($user->id == 2) {
    //         RoleUser::create([
    //             "user_id" => $user->id,
    //             "role_id" => $user->id
    //         ]);
    //   }
   // }
    }
}
