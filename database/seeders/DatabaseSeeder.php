<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\models\Provider;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Provider::factory(50)->create();

        $this->call(RoleSeeder::class);
 
        $this->call(UserSeeder::class);
    }
}
