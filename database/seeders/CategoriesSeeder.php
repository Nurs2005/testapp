<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $categoryIds = [];

        foreach (range(1, rand(5, 10)) as $index) {
            $category = DB::table('categories')->insertGetId([
                'header' => $faker->word,
            ]);
            $categoryIds[] = $category;
        }
        return $categoryIds;
    }
}
