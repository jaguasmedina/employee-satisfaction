<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        
        $companyIds = DB::table('companies')->pluck('id')->toArray();

        if (empty($companyIds)) {
            $this->command->info('No hay compañías en la base de datos. Por favor, crea algunas antes de ejecutar el seeder.');
            return;
        }

        foreach (range(1, 15) as $index) {
            DB::table('people')->insert([
                'nombre_completo' => $faker->name,
                'fecha' => $faker->date,
                'correo' => $faker->unique()->safeEmail,
                'area' => $faker->word,
                'categoria' => $faker->randomElement(['Empleado', 'Directivo', 'Contratista']),
                'nivel_de_satisfaccion' => $faker->numberBetween(0, 100),
                'company_id' => $faker->randomElement($companyIds), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
