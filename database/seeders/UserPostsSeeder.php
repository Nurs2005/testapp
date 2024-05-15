<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use Faker\Factory as Faker;

class UserPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_posts')->truncate();

        $faker = Faker::create();

        $userIds = DB::table('users')->pluck('id')->all();
        $postIds = DB::table('posts')->pluck('id')->all();

        $numberOfRecords = 100; 

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $userId = $faker->randomElement($userIds);
            $postId = $faker->randomElement($postIds);

            DB::table('user_posts')->insert([
                'user_id' => $userId,
                'post_id' => $postId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

