<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facade\DB;
// use Illuminate\Support\Facade\Hash;
use Illuminate\Support\Str;
use Hash;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<50; $i++){    		
    		DB::table('users')->insert([
    			'name' => Str::random(10),
    			'email' => Str::random(10)."@gmail.com",
    			'password' => HASH::make('password'),
    			'role' => 'admin'
    		]);
    	}
    }
}
