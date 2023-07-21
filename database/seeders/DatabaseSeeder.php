<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Seeders\VentaSeeder;
use App\Models\User_Webfiltros;
use Database\Seeders\PresupuestoSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      //  User_Webfiltros::factory(250)->create();
       /* Venta::factory(1000)->create();*/
        for($i = 0; $i < 12; $i++){
            $this->call(VentaSeeder::class);
        }
        
    }
}
