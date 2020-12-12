<?php

use App\Pizza;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=1; $i <= 12; $i++) { 
            Pizza::create([
                'name' => $faker->text(20),
                'price' => $faker->numberBetween(10000, 500000),
                'description' => $faker->paragraph,
                'img' => "$i.jpg"
            ]);
        }
    }
}
