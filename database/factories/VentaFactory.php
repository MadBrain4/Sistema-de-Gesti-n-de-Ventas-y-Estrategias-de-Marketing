<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venta;
use App\Models\User_Webfiltros;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Venta::class;

    public function definition(): array
    {
        $venta_neta = rand(100, 800);
        $año = rand(2010, 2023);
        $mes = rand(1, 12);
        $dia = rand(1, 28);

        return [
            'id_users' => User_Webfiltros::all()->random()->id,
            'tipo_cliente' => $this->faker->randomElement(['cliente', 'distribuidora']),
            'num_comprobante' => $this->faker->unique()->numberBetween(1,10000000),
            'fecha' => $año . "-" . $mes . "-" . $dia,
            'estado' => $this->faker->randomElement(["Completado","Incompleto","Devuelto"]),
            'precio_bruto' => $venta_neta,
            'precio_total' => $venta_neta + $venta_neta * (0.2),
            'descuento' => 0,
        ];
    }
}
