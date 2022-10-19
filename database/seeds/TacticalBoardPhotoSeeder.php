<?php

use Illuminate\Database\Seeder;

class TacticalBoardPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tactical_board_photos')->insert([
            'tactical_board_id' => 1,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/hmws6bswbMqEb6nxocYSihFk6tEzDZs0snShLvX8.png',
        ]);
        
        DB::table('tactical_board_photos')->insert([
            'tactical_board_id' => 1,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/X7JEXB6yOJqtQAmOIBKo0U2JmqvTOGcTRGQFE1Ox.png',
        ]);
        
        DB::table('tactical_board_photos')->insert([
            'tactical_board_id' => 2,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/9xZQfebLJNPuAIFAW4ufspGu7akT1AZvtIEGkpFE.png',
        ]);
        
        DB::table('tactical_board_photos')->insert([
            'tactical_board_id' => 2,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/rW1HuYDliMGFg55mMiMH02inL0jG8uCRW849sQfj.png',
        ]);
        
        DB::table('tactical_board_photos')->insert([
            'tactical_board_id' => 3,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/HuNk45SxAPQo6aKO1WaDBkew25GSQZd3TGW3RSXi.png',
        ]);
        
        DB::table('tactical_board_photos')->insert([
            'tactical_board_id' => 3,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/A4KkhnKZW4HQCD9dN6e5mVEVOeSomGiTXZRb3At5.png',
        ]);
    }
}
