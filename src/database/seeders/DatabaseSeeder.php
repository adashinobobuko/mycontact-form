<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    //public function run()
    //{
        // \App\Models\User::factory(10)->create();
        
    //}

    public function run()
    {
        $this->call(CategorySeeder::class);//なんかいっぱいCategoryできちゃったから後で消す
        Contact::factory(35)->create();
    }
}
