<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'first_name' => 'fahad',
        //     'last_name' => 'hoq',
        //     'full_name' => 'fahad hoq',
        //     'user_name' => 'fahad-hoq',
        //     'image' => 'image_5ef6de02e96871.61267442OaSfEpBtiI.jpg',
        //     'email' => 'fahadhoq2@gmail.com',
        //     'password' =>  '123456',
        //     'phone' => '01827537226',
        //     'remember_token' => Str::random(10),
        // ]);

        factory(User::class, 5)->create();
    }
}
