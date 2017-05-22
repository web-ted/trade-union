<?php

use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Developer', 'Database Analyst', 'Quality Assurance', 'Product Owner'] as $specialty) {
            factory(App\Specialty::class)->create([
                'name' => $specialty,
            ]);

        }
    }
}
