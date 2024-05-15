<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class PostsSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->truncate();
        $faker = Faker::create();
        foreach (range(1, rand(100, 150)) as $index) {
            DB::table('posts')->insert([
                'header' => $faker->sentence,
                'description' => $faker->paragraph,
            ]);
        }
    }
}