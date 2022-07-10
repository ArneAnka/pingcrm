<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'stack_id' => 1,
            'order' => 1,
            'description' => 'First Question',
            'is_info' => false,
            'source' => '',
            'flagged' => false,
            'enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('questions')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'stack_id' => 1,
            'order' => 1,
            'description' => 'Second question',
            'is_info' => false,
            'source' => '',
            'flagged' => false,
            'enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('questions')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'stack_id' => 2,
            'order' => 1,
            'description' => 'Third question',
            'is_info' => false,
            'source' => '',
            'flagged' => false,
            'enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('questions')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'stack_id' => 2,
            'order' => 1,
            'description' => 'Foruth question',
            'is_info' => false,
            'source' => '',
            'flagged' => false,
            'enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('questions')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'stack_id' => 3,
            'order' => 1,
            'description' => 'Fifth question',
            'is_info' => false,
            'source' => '',
            'flagged' => false,
            'enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('questions')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'stack_id' => 3,
            'order' => 1,
            'description' => 'Sixth question',
            'is_info' => false,
            'source' => '',
            'flagged' => false,
            'enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('questions')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'stack_id' => 4,
            'order' => 1,
            'description' => 'Seventh question',
            'is_info' => false,
            'source' => '',
            'flagged' => false,
            'enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('questions')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'stack_id' => 4,
            'order' => 1,
            'description' => 'Eight question',
            'is_info' => false,
            'source' => '',
            'flagged' => false,
            'enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
