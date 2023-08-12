<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        Category::create(['name'=>'Nature']);
        Category::create(['name'=>'Wildlife']);
        Category::create(['name'=>'People']);
        Category::create(['name'=>'Technology']);
        Category::create(['name'=>'Animals']);
        Category::create(['name'=>'Night']);
        Category::create(['name'=>'Creative']);
        Category::create(['name'=>'Landscape']);
        Category::create(['name'=>'Architecture']);
        // \App\Models\User::factory(10)->create();
    }
}
