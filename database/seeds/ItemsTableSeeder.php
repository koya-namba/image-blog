<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => 'item1',
            ]);
        
        DB::table('items')->insert([
            'name' => 'item2',
            ]);
    }
}
