<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stacks')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'order' => 1,
            'name' => 'This is the firsts stack',
            'slug' => 'this-is-the-first-stack',
            'description' => 'First stack',
            'published' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('stacks')->insert([
            'user_id' => 1,
            'subject_id' => 1,
            'order' => 2,
            'name' => 'This is the second stack',
            'slug' => 'this-is-the-second-stack',
            'description' => 'Second stack',
            'published' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('stacks')->insert([
            'user_id' => 1,
            'subject_id' => 2,
            'order' => 1,
            'name' => 'This is the third stack',
            'slug' => 'this-is-the-third-stack',
            'description' => 'Third stack',
            'published' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('stacks')->insert([
            'user_id' => 1,
            'subject_id' => 2,
            'order' => 2,
            'name' => 'This is the fourth stack',
            'slug' => 'this-is-the-foruth-stack',
            'description' => 'Third stack',
            'published' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
