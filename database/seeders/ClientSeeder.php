<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $name = Str::random(10);

        DB::table('clients')->insert([
            'name' => $name,
            'email' => Str::random(10).'@gmail.com',
            'url' => Str::slug($name, '-'),
            'date_birth' => Carbon::now()->subYear()->subMonth(random_int(1,12))->subDays(random_int(0,365)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
