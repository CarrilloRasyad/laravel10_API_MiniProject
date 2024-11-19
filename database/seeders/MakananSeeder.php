<?php

namespace Database\Seeders;

use App\Models\Makanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i < 10; $i ++) {
            Makanan::create([
            'nama_makanan' => $faker->sentence,
            'jenis_makanan' => $faker->name,
            'harga' => $faker->number,
            'asal_negara' => $faker->name,
            'rasa_makanan' => $faker->name
            ]);

        }
    }
}
