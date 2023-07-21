<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Especificaciones</title>
    </head>

    <style>
        * {
            margin: 0.7em; 
            box-sizing: border-box;
        }

        
        table {
            width:100%;
            border-collapse: collapse;
            text-align: left;
        
        }

        th, td {
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 1px;
            font-size: 0.7em;
        }

        thead  {
            background-color: #C2C2C2;
        }

        h3{
            color: #E2001A;
        }

        .marca{
            background-color: #DDD;
            text-align: left
        }

        img{
            width:60%;
        }
        .titulo
        {
            border-style: none;
            background-color:#FFFFFF;
            padding: 2px;
            font-size: 1em;
            text-align: left;
        
        }
        .fecha
        {
            border-style: none;
            background-color:#FFFFFF;
            padding: 1px;
            font-size: 1em;
            text-align: right;
        
        }
        .tipo {
            text-align: left;
        }
    </style>

<body>
    <table>
        <thead>
            <tr>
                <th class="titulo"  colspan="7"><h3>Especificaciones</h3></th>
            </tr>

            <tr>
                <th colspan="5" class="fecha tipo">Filtros Sellados</th>
                <th class="fecha" colspan="4">{{ $fechaActual }}</th> 
            </tr>

            <th class="columna">Codigo</th>
            <th class="columna">Diametro Externo(mm)</th>
            <th class="columna">Rosca</th>
            <th class="columna">Altura</th>
            <th class="columna">Diametro Ext. (mm)</th>
            <th class="columna">Empacadura Dimetro Int. (mm)</th>
            <th class="columna">Espero (mm)</th>
            <th class="columna">Valvula de Alivio</th>
            <th class="columna">Valvula de Anti Drenaje</th>
        </thead>
        <tbody>
            @foreach($sellado as $sell)
                <tr>
                    <th class="columna">{{ $sell->codigo }}</th>
                    <th class="columna">{{ $sell->diametroext }}</th>
                    <th class="columna">{{ $sell->diametroint }}</th>
                    <th class="columna">{{ $sell->altura }}</th>
                    <th class="columna">{{ $sell->diametroempext }}</th>
                    <th class="columna">{{ $sell->diametroempint }}</th>
                    <th class="columna">{{ $sell->espesoremp }}</th>
                    @if( $sell->valvulaal == 1) 
                        <th class="columna">Si</th>  
                    @else 
                        <th class="columna">No</th> 
                    @endif
                    @if( $sell->valvulaad == 1) 
                        <th class="columna">Si</th>  
                    @else 
                        <th class="columna">No</th> 
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
               <tr>
                <th class="titulo"  colspan="3"><h3>Especificaciones</h3></th>
            </tr>

            <tr>
                <th colspan="4" class="fecha tipo">Filtros de Elemento Uso Automotriz y Comercial</th>
                <th class="fecha" colspan="1">{{ $fechaActual }}</th> 
            </tr>

  <tr>
            <th class="columna">Codigo</th>
            <th class="columna">Diametro Externo (mm)</th>
            <th class="columna">Diametro Interno 1 (mm)</th>
            <th class="columna">Diametro Interno 2 (mm)</th>
            <th class="columna">Altura (mm)</th>
            </tr>

        </thead>

        @foreach($elemento as $elem)
            <tr>
                <th>{{ $elem->codigo }}</th>
                <th>{{ $elem->diametroext1 }}</th>
                <th>{{ $elem->diametroint1 }}</th>
                <th>{{ $elem->diametroint2 }}</th>
                <th>{{ $elem->altura }}</th>
            </tr>
        @endforeach
    </table>
    <br>
    <br>

    <table>
        <thead> 

        <tr>
                <th class="titulo"  colspan="4"><h3>Especificaciones</h3></th>
            </tr>

            <tr>
                <th colspan="4" class="fecha tipo">Filtros de Aire Automotriz</th>
                <th class="fecha" colspan="2">{{ $fechaActual }}</th> 
            </tr>
           
  <tr>
            <th class="columna">Codigo</th>
            <th class="columna">Diametro Externo 1(mm)</th>
            <th class="columna">Diametro Externo 2(mm)</th>
            <th class="columna">Diametro Interno 1(mm)</th>
            <th class="columna">Diametro Interno 2(mm)</th>
            <th class="columna">Altura (mm)</th>
            </tr>

        </thead>

        @foreach($aire_automotriz as $automotriz)
            <tr>
                <td>{{ $automotriz->codigo }}</td>
                <td>{{ $automotriz->diametroext1 }}</td>
                <td>{{ $automotriz->diametroext2 }}</td>
                <td>{{ $automotriz->diametroint1 }}</td>
                <td>{{ $automotriz->diametroint2 }}</td>
                <td>{{ $automotriz->altura }}</td>
            </tr>
        @endforeach
    </table>
    <br>
    <br>
   
    <table>
        <thead>

         <tr>
                <th class="titulo"  colspan="4"><h3>Especificaciones</h3></th>
            </tr>

            <tr>
                <th colspan="4" class="fecha tipo">Filtros de Aire Industrial</th>
                <th class="fecha" colspan="2">{{ $fechaActual }}</th> 
            </tr>
             <tr>
                <th class="columna">Codigo</th>
                <th class="columna">Diametro Externo 1(mm)</th>
                <th class="columna">Diametro Externo 2(mm)</th>
                <th class="columna">Diametro Interno 1(mm)</th>
                <th class="columna">Diametro Interno 2 (mm)</th>
                <th class="columna">Altura (mm)</th>
            </tr>
        </thead>

        @foreach($aire_industrial as $industrial)
            <tr>
                <td>{{ $industrial->codigo }}</td>
                <td>{{ $industrial->diametroext1 }}</td>
                <td>{{ $industrial->diametroext2 }}</td>
                <td>{{ $industrial->diametroint1 }}</td>
                <td>{{ $industrial->diametroint2 }}</td>
                <td>{{ $industrial->altura }}</td>
            </tr>

        @endforeach
    </table>
    <br>
    <br>
  
    <table>
        <thead>
            <tr>
                <th class="titulo"  colspan="2"><h3>Especificaciones</h3></th>
            </tr>

            <tr>
                <th colspan="2" class="fecha tipo">Filtros de Aire Panel</th>
                <th class="fecha" colspan="2">{{ $fechaActual }}</th> 
            </tr>
            <tr>
                <th class="columna">Codigo</th>
                <th class="columna">Largo(mm)</th>
                <th class="columna">Ancho(mm)</th>
                <th class="columna">Altura(mm)</th>
            </tr>

        </thead>

        @foreach($panel as $panel)
            <tr>
                <td>{{ $panel->codigo }}</td>
                <td>{{ $panel->largo }}</td>
                <td>{{ $panel->ancho }}</td>
                <td>{{ $panel->altura }}</td>
            </tr>
        @endforeach
    </table>
   <br>
    
    <table>
        <thead>
             <tr>
                <th class="titulo"  colspan="3"><h3>Especificaciones</h3></th>
            </tr>

            <tr>
                <th colspan="3" class="fecha tipo">Filtros de Combustible</th>
                <th class="fecha" colspan="2">{{ $fechaActual }}</th> 
            </tr>
             <tr>

            <th class="columna">Codigo</th>
            <th class="columna">Diametro Externo(mm)</th>
            <th class="columna">Altura(mm)</th>
            <th class="columna">Entrada(mm)</th>
            <th class="columna">Salida(mm)</th>
            </tr>

        </thead>

        @foreach($combustible_linea as $combustible)
            <tr>
                <td>{{ $combustible->codigo }}</td>
                <td>{{ $combustible->diametroext }}</td>
                <td>{{ $combustible->altura }}</td>
                <td>{{ $combustible->entrada }}</td>
                <td>{{ $combustible->salida }}</td>
            </tr>
        @endforeach
        </table>
        <br>
        <br>
    </body>
</html>