<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDF - Equivalencias</title>

        <style>
            * {
                margin: 0.2em; 
                box-sizing: border-box;
            }
            .titulo
            {
                border-style: none;
                background-color:#FFFFFF;
                padding: 2px;
                font-size: 1em;
                text-align: left;
                
            }

            img{
                width:60%;
            }
            .marca{
                background-color: #DDD;
                text-align: left
            }
            .fecha
            {
                border-style: none;
                background-color:#FFFFFF;
                padding: 1px;
                font-size: 0.7em;
                text-align: right;
                
            }

            h3{
                color: #E2001A;
            }
            table {
                width:100%;
                text-align: left;
                border-collapse: collapse;
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
        </style>
    </head>

    <body>
        <div style="page-break-after:always;">
            <table>
                <thead>
                    <tr>
                        <th class="titulo" colspan="6"><h3>Equivalencias</h3></th>
                    </tr>
                    <tr>
                        <th class="fecha" colspan="10">{{ $fechaActual }}</th> 
                    </tr>
                    <tr>
                    @foreach($marca as $mar)
                        <tr>
                            <th class="marca"  colspan="2">{{ $mar->marca }}</th>                   
                        </tr>
                        <tr>
                            <th><h6>Codigo WEB</h6></th>
                            <th><h6>Codigo Marca</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equivalencias as $equivalencia) 
                            @if( $equivalencia->id_marca == $mar->id )
                                <tr>
                                    <td>
                                        {{ $equivalencia->codigo }}
                                    </td>
                                    <td>
                                        {{ $equivalencia->codigo_marca }}
                                    </td>
                                </tr>
                            @endif 
                        @endforeach
                    </tbody>
                @endforeach
            </table>
        </div>
    </body>
</html>