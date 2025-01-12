<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            ['content' => '1.商品のお届けについて', 'created_at' => now(), 'updated_at' => now()],
            ['content' => '2.商品の交換について', 'created_at' => now(), 'updated_at' => now()],
            ['content' => '3.商品トラブル', 'created_at' => now(), 'updated_at' => now()],
            ['content' => '4.ショップへのお問い合わせ', 'created_at' => now(), 'updated_at' => now()],
            ['content' => '5.その他', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
