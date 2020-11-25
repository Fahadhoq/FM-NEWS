<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // manualy data entry
        // Category::create([
        //     'name' => 'laravel',
        //     'slug' => 'djnhskfafm',
        //     'status' => '1',

        // ]);
        

        //auto data entry
        factory(Category::class, 5)->create();
    }
}
