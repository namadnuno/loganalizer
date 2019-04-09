<?php

use App\Site;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'site_url' => 'test.test',
            'name' => 'test',
            'api_key' => '123123123',
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
