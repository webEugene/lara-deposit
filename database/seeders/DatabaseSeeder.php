<?php

namespace Database\Seeders;

use \App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        $user = [
//            [
//                'id' => 'f357dc50-195d-4b6d-a3a1-f53f7c14f997',
//                'login'=>'Admin',
//                'email'=>'eugene@it.com',
//                'password'=> bcrypt('123456'),
//            ],
//            [
//                'id' => '71496a36-89e9-469b-8cda-f0f4076f1abb',
//                'login'=>'User',
//                'email'=>'eugene2@it.com',
//                'is_admin'=>'0',
//                'password'=> bcrypt('123456'),
//            ],
//        ];
        User::factory()->create([
                                    'id' => 'f357dc50-195d-4b6d-a3a1-f53f7c14f997',
                                    'login'=>'Admin',
                                    'email'=>'eugene@it.com',
                                    'password'=> bcrypt('123456'),
                                ]);
//        foreach ($user as $key => $value) {
//            User::factory()->create([
//                                          'id' => 'f357dc50-195d-4b6d-a3a1-f53f7c14f997',
//                                          'login'=>'Admin',
//                                          'email'=>'eugene@it.com',
//                                          'password'=> bcrypt('123456'),
//                                      ]);
//        }
    }
}
