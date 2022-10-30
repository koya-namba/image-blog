<?php

use Illuminate\Database\Seeder;

class TacticalBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tactical_boards')->insert([
            'title' => 'Sample1',
            'body' => 'This is sample. This is sample. This is sample. This is sample. ',
        ]);
        
        DB::table('tactical_boards')->insert([
            'title' => 'Sample2',
            'body' => 'this is test. this is test. this is test. this is test. ',
        ]);
        
        DB::table('tactical_boards')->insert([
            'title' => 'Sample3',
            'body' => 'this is magic. this is magic. this is magic. this is magic. this is magic. ',
        ]);
        
        DB::table('tactical_boards')->insert([
            'title' => 'Sample4',
            'body' => 'this is magic. this is magic. this is magic. this is magic. this is magic. ',
        ]);
    }
}
