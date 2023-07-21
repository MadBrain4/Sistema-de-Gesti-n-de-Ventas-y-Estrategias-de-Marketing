<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User_Webfiltros;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class User_WebfiltrosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = User_Webfiltros::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'genero' => $this->faker->randomElement(['Femenino','Masculino']),
            'pais' => $this->faker->randomElement(["Venezuela","Ecuador","República Dominicana"]),
            'estado' => $this->faker->randomElement(["Aragua","Apure","Anzoategui","Amazonas","Bolivar","Barinas","Cojedes","Carabobo","Delta Amacuro","Distrito Capital","Falcon","Guarico","Lara","Merida","Miranda","Monagas","Nueva Esparta","Portuguesa","Sucre","Tachira","Trujillo","Vargar","Yaracuy","Zulia"]),
            'direccion' => fake()->sentence(),
            'telefono' => fake()->phoneNumber(),
            'fecha_nacimiento' => $this->faker->randomElement(['2003-02-28', '2005-03-26', '1998-09-18', '1965-05-26', '2000-02-02', '1988-12-04', '1995-09-10', '1968-03-15' ]),
        ];
    }
}
