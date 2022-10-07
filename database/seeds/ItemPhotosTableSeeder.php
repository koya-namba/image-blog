<?php

use Illuminate\Database\Seeder;

class ItemPhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_photos')->insert([
            'item_id' => 1,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/8IhuOj3miqnHMC9VgMeAarVc6ypt5HqZNFIEUrQf.png',
            ]);
            
        DB::table('item_photos')->insert([
            'item_id' => 1,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/qVq6rToSsP9IRHyedhmeJ1IjmH9z0vgk27eMw1Hr.jpg',
            ]);
            
        DB::table('item_photos')->insert([
            'item_id' => 2,
            'path' => 'https://lev-backet.s3.ap-northeast-1.amazonaws.com/myprefix/WA0qU3HzFW1e9fWtQ9DGTfk5p2b5HqKSSXHBfF3c.jpg',
            ]);
    }
}
