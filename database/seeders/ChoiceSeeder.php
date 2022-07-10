<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 1,
            'choice' => 'Choice q 1',
            'correct' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 1,
            'choice' => 'Choice for question 1',
            'correct' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // 2
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 2,
            'choice' => 'Choice for q 2',
            'correct' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 2,
            'choice' => 'Second choice for q2',
            'correct' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // 3
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 3,
            'choice' => 'Q 3',
            'correct' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 3,
            'choice' => 'Second q3',
            'correct' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // 4
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 4,
            'choice' => 'Q4 ',
            'correct' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 4,
            'choice' => 'qqqq4',
            'correct' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // 5
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 5,
            'choice' => 'q5',
            'correct' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 5,
            'choice' => 'q555555',
            'correct' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // 6
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 6,
            'choice' => 'q6',
            'correct' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 6,
            'choice' => 'q666666',
            'correct' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // 7
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 7,
            'choice' => 'q7',
            'correct' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 7,
            'choice' => 'q777777',
            'correct' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // 8
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 8,
            'choice' => 'q8',
            'correct' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('choices')->insert([
            'user_id' => 1,
            'question_id' => 8,
            'choice' => 'qqqqq 8',
            'correct' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
