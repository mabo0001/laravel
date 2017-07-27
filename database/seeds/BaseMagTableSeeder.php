<?php

use Illuminate\Database\Seeder;

class BaseMagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('base_mags')->insert([
            'basevalue'=>544345.23,
            'time'=>'10:25:00',
            'date'=>'2017-05-14',
            'ext'=>'88',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

    }
}
