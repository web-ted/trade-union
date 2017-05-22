<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Artisan::call("worker:import");
        factory(App\Worker::class, 200)->create();
    }
}
