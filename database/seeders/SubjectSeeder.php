<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'user_id' => 1,
            'name' => 'This is the firsts subject',
            'slug' => 'this-is-the-first-subject',
            'description' => 'It would be nice to have this working properly.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('subjects')->insert([
            'user_id' => 1,
            'name' => 'This is the second subject',
            'slug' => 'this-is-the-second-subject',
            'description' => 'It would be nice to have this working properly.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

    }
}
