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
        // factory(App\Worker::class, 50)->create();
        Artisan::call("worker:import");
    }
}
