<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'post1',
            'image_path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/4vEpdZIYfJ5iGmtGeLIErXNTbMIhyz4jEh371tSY.png',
            ]);
        DB::table('posts')->insert([
            'title' => 'post2',
            'image_path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/nZy6YWS8ldnaBkq7VFZmqicRVI0IljMTRFk30ZU0.jpg',
            ]);
    }
}
