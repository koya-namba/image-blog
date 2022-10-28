<?php

use Illuminate\Database\Seeder;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tweets')->insert([
            'content' => 'this is sample contents',
            'image_path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/BOv16NqHhsDYvEHdRnEGBnI2peHCJzT0FO23xZpA.png',
            ]);
        DB::table('tweets')->insert([
            'content' => 'this is sample contents' . PHP_EOL . 'this is test message',
            'image_path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/Ckl5D3nrfu7wV2dx5pbONQ0mwVJaMxFU3gaV6VHl.png',
            ]);
    }
}
