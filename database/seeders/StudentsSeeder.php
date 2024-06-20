<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\DateFactory;
use Carbon\Carbon;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        DB::table('students')->insert([
            'roll_no' => rand(1, 60), // Generate a random number between 10 and 99
             'name' => Str::random(10),
             'total_fees' => rand(25000, 30000), // Generate a random number between 1000 and 5000
            'fees_paid' => rand(1000, 30000), // Generate a random number between 500 and 1000
            'date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            
        ]);
    }
}
