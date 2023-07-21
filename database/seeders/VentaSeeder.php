<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User_Webfiltros;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $año = rand(2011, 2023);
        $mes = rand(1, 12);
        $dia = rand(1, 28);

        $producto = [];
        $productos_comprados = rand(1, 5);
        $filtros = DB::table('filtro_codificacion')->select('id','codigo','precio')->orderByRaw("RAND()")->limit($productos_comprados)->get();
        for($i = 0; $i < $productos_comprados; $i++){
            $producto[$i] = DB::table('filtro_codificacion')->where('id',$filtros[0]->id)->get();
            $cantidad[$i] = rand(1, 7);
        }

        $precio_bruto  = 0;
        for($i = 0; $i < $productos_comprados; $i++){
            $precio_filtro[$i] = ($filtros[$i]->precio*$cantidad[$i]);
            $precio_bruto += ($filtros[$i]->precio*$cantidad[$i]);
        }

        DB::table('venta')->insert([
            'id_users' => User_Webfiltros::all()->random()->id,
            'tipo_cliente' => fake()->randomElement(["Cliente","Distribuidora"]),
            'num_comprobante' => fake()->unique()->numberBetween(1,10000000),
            'fecha' => $año . "-" . $mes . "-" . $dia,
            'estado' => fake()->randomElement(["Completado","Incompleto","Devuelto"]),
            'precio_bruto' => $precio_bruto,
            'precio_total' => $precio_bruto + ($precio_bruto * 0.15),
            'descuento' => 0,
        ]);

        for($i = 0; $i < count($cantidad); $i++){
            DB::table('detalle_venta')->insert([
                'id_venta' => Venta::max("id"),
                'id_filtro' => $filtros[$i]->id,
                'codigo' => $filtros[$i]->codigo,
                'cantidad' => $cantidad[$i],
                'precio_total' => $precio_filtro[$i],
                'descuento' => 0,
            ]);
        }
    }
}
