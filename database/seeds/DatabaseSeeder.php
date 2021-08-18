<?php

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
        printf("Seeding Dogs" . PHP_EOL);
        $seeder = new DogSeeder();
        $seeder->run();
    }
}
