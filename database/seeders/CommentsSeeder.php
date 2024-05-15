<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CommentsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
    
        $userIds = DB::table('users')->pluck('id')->toArray();
        $postIds = DB::table('posts')->pluck('id')->toArray();
    
        foreach (range(1, 100) as $index) {
            $comment = [
                'user_id' => $faker->randomElement($userIds),
                'post_id' => $faker->randomElement($postIds),
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ];
    
            DB::table('comments')->insert($comment);
        }
    }
}
