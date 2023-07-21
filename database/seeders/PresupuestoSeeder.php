<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Presupuesto;

class PresupuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $presupuesto = rand(1, 50000);
        DB::table('presupuesto')->insert([
            'tarea' => fake()->title(),
            'presupuesto' => $presupuesto,
            'procedencia' => Presupuesto::all()->random()->id,
        ]);
    }
}
