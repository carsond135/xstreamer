<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call(UserTableSeeder::class);

        // Model::reguard();

        DB::unprepared(File::get('database/xstreamer_lite.sql'));
    }
}
