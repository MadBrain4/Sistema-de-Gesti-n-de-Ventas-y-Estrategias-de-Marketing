<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/sweetAlerta.js"></script>
    <title>Editar Estrategia</title>
</head>
<body>
    <div id="app_estrategias_edit"></div>

    @if ( session()->has('error') )
        <script>
            Swal.fire({
                icon: 'error',
                title: `No se pudo completar el proceso`,
                timer: 1250,
            })
        </script>
        @php
            session()->forget('error');
        @endphp
    @endif  
    
    @vite('resources/js/app.js')
</body>
</html>