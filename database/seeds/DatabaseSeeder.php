<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PostsTableSeeder::class,
            ItemsTableSeeder::class,
            ItemPhotosTableSeeder::class,
            TacticalBoardSeeder::class,
            TacticalBoardPhotoSeeder::class,
            TweetSeeder::class,
            ]);
    }
}
