<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('products')->insert([
            ['name'=>'Hung','price'=>10000],
            ['name'=>'Long','price'=>20000],
            ['name'=>'Hung','price'=>30000],
            ['name'=>'Hung','price'=>40000]
        ]);
    }
}
