<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Post::create([
        //     'user_id' => '2',
        //     'category_id' => '1',
        //     'tittle' => 'laravel',
        //     'content' => 'laravel is a intersting',
        //     'thumbnail_path' => 'image_5ef6de02e96871.61267442OaSfEpBtiI.jpg',
        //     'status' => 'active',
        // ]);

       //auto data entry
       
       factory(Post::class, 5)->create();
    }
}
