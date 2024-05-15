<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_categories')->truncate();

        $faker = Faker::create();

        $postIds = DB::table('posts')->pluck('id')->all();
        $categoryIds = DB::table('categories')->pluck('id')->all();

        $numberOfRecords = 100; 

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $postId = $faker->randomElement($postIds);
            $categoryId = $faker->randomElement($categoryIds);

            DB::table('post_categories')->insert([
                'post_id' => $postId,
                'category_id' => $categoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}