<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vehiculos Comerciales</title>
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
            .marca{
                background-color: #DDD;
                text-align: left
            }


            h3{
            color: #E2001A;
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
                font-size: 0.7em;
                text-align: right;
            }
            .titulo_sub
            {
                border-style: none;
                background-color:#FFFFFF;
                padding: 2px;
                font-size: 1em;
                text-align: left;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr> 
                    <th  class="titulo" colspan="11">
                        <h3>Vehiculos Comerciales</h3>
                    </th>
                </tr>
                <tr>
                    <th class="fecha" colspan="15"><?php echo "$fechaActual";?></th>
                </tr>
                <tr>
                    <th>
                        <h6>Modelo</h6>
                    </th>
                    <th>
                        <h6>Motor</h6>
                    </th>
                    <th>
                        <h6>Año</h6>
                    </th>
                    @for($i = 0; $i < $numero_aplicaciones; $i++)
                        <th>
                            <h6>
                                {{ $nombres_aplicaciones[$i]->aplicacion }}
                            </h6>
                        </th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @php 
                    $marca = '';
                    $j = 0;
                @endphp
                @foreach( $aplicacion as $apl )
                    @if( $marca != $apl->marca )
                        <tr>
                            <td colspan="{{ $numero_aplicaciones + 3 }}" class="marca">
                                <h6>{{ $apl->marca }}</h6>
                            </td>
                        </tr>
                        @php
                            $marca = $apl->marca;
                        @endphp
                    @endif
                    <tr>
                        <td>
                            <h6>{{ $apl->modelo }}</h6>
                        </td>
                        <td>
                            <h6>{{ $apl->motor }}</h6>
                        </td>
                        <td>
                            <h6>{{ $apl->ano }}</h6>
                        </td>


                        @foreach( $nombres_aplicaciones as $nombres )
                            @if( $nombres->aplicacion == $apl->aplicacion )
                                <td>
                                    <h6>
                                        {{ $apl->codigo }}
                                    </h6>
                                </td>
                            @else
                                <td>
                                    
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table> 
    </body>
</html>