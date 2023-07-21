<link rel="stylesheet" href="{{ asset( 'css/jetfilter/estilos_especificaciones.css' ) }}">
<x-ArribaInicio>
    <x-slot name="title">
        Especificaciones
    </x-slot>
</x-ArribaInicio>

<table>
    <div>
        <h2 class="catalogo">Administración del Catálogo</h2>  
    </div>
    <tr>
        <td class="titulo">Cargar Especificaciones</td>
        <td class="titulo">Cargar Aplicaciones</td>
    </tr>
    <tr>
        <td>
            <ul class="lista">
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.aireautomotriz' ) }}">Aire Automotriz</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.aireindustrial' ) }}">Aire Industrial</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.combustiblelinea' ) }}">Combustible en Línea</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.elemento' ) }}">Elemento</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.panel' ) }}">Panel</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.sellado' ) }}">Sellado</a></li>
            </ul>
        </td>
        <td>
            <ul class="lista">
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.aplicacion_comercial' ) }}">Cargar Aplicaciones Comerciales</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.aplicacion_liviano' ) }}">Cargar Aplicaciones Liviano</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.aplicacion_agricola' ) }}">Cargar Aplicaciones Agrícola</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.aplicacion_carretera' ) }}">Cargar Aplicaciones Fuera de Carretera</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.vehiculos' ) }}">Vehículos</a></li>
                <li class="espe"><a href="{{ route( 'jet-filter.catalogo.marcas' ) }}">Marcas</a></li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class="titulo">Cargar Equivalencias</td>
        <td class="titulo">Menú de Reportes</td>
    </tr>
    <tr>
        <td>  
            <ul class="lista">          
                <li class="espe"><a href="{{ route('jet-filter.catalogo.equivalencias') }}">Cargar Datos de Equivalencias</a></li>
            </ul>
        </td>
        <td>
            <ul class="lista">          
                <li class="espe">
                    <form action="" method="POST">
                        <input type="hidden" name="generar-catalogo">
                        <input type="" value="Generador de Catálogo Impreso" id="boton" class="g_pdf button">
                    </form>
                </li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class="titulo">Productos</td>
    </tr>
    <tr>
        <td>
            <ul class="lista">          
                <li class="espe"><a href="{{ route('jet-filter.catalogo.categorias.index') }}">Categorías</a></li>
                <li class="espe"><a href="{{ route('jet-filter.catalogo.tipos.index') }}">Tipos</a></li>
            </ul>
        </td>
    </tr>
</table>

<x-Abajo_JetFilter />

<script>
    const controller = new AbortController();

    function abortando(){
        Swal.fire({
            imageUrl: '/img/icono/loading.gif',
            imageWidth: 100,
            imageHeight: 75,
            imageAlt: 'Custom image',
            padding: '2em 1em 1em 1em',
            title: 'Su proceso está cancelándose',
            text: '¡Cancelando!',
            showConfirmButton: false,
            timer: 20000,
            allowOutsideClick: false,
        }).then(
            () => {
                window.location.href = "/jetfilter/catalogo";
            } 
        );
    }

    function error(){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡Hubo un error en la generación del PDF!',
            timer: 2000
        })
    }

    function cargando(string, int){
        Swal.fire({
            title: 'Pendiente',
            text: `El PDF de ${string} se está generando ${int}/7`,
            imageUrl: '/img/icono/loading.gif',
            imageWidth: 100,
            imageHeight: 75,
            imageAlt: 'Custom image',
            padding: '2em 1em 1em 1em',
            allowOutsideClick: false,
            showConfirmButton: true,
            confirmButtonText: "Cancelar",
        }).then((result) => {
            if(result.isConfirmed){
                ctr = controller;
                ctr.abort();
            }
        })
    }
    
    boton = document.getElementById('boton');
    boton.addEventListener('click', function(){
        let signal = controller.signal;
        //1er PDF
        cargando('vehículos agrícolas', 1),
        fetch('/jetfilter/generarpdf/especificaciones', 
            {
                signal,
                method: 'POST',
            }
        )
        .then(
            data => {
                //2do PDF
                cargando('vehículos livianos', 2);
                fetch('/jetfilter/generarpdf/vehiculos_livianos', {
                    signal,
                    method: 'POST',
                })
                .then(
                    data => {
                        //3.1 PDF
                        cargando('vehículos comerciales', 3.1);
                        fetch('/jetfilter/generarpdf/vehiculos_comerciales1', {
                            signal,
                            method: 'POST',
                        })
                        .then(
                            data => {
                                //3.2 PDF
                                cargando('vehículos comerciales', 3.2);
                                fetch('/jetfilter/generarpdf/vehiculos_comerciales2', {
                                    signal,
                                    method: 'POST',
                                })
                                .then(
                                    data => {
                                        //3.3 PDF
                                        cargando('vehiculos comerciales', 3.3);
                                        fetch('/jetfilter/generarpdf/vehiculos_comerciales3', {
                                            signal,
                                            method: 'POST',
                                        })
                                        .then(
                                            data => {
                                                //3.4 PDF
                                                cargando('vehículos comerciales', 3.4);
                                                fetch('/jetfilter/generarpdf/vehiculos_comerciales', {
                                                    signal,
                                                    method: 'POST',
                                                })
                                                .then(
                                                    data => {
                                                        //4.1 PDF
                                                        cargando('vehículos fuera de carretera', 4.1);
                                                        fetch('/jetfilter/generarpdf/vehiculos_carretera1', {
                                                            signal,
                                                            method: 'POST',
                                                        })
                                                        .then(
                                                            data => {
                                                                //4.2 PDF
                                                                cargando('vehículos fuera de carretera', 4.2);
                                                                fetch('/jetfilter/generarpdf/vehiculos_carretera2', {
                                                                    signal,
                                                                    method: 'POST',
                                                                })
                                                                .then(
                                                                    data => {
                                                                        //4.3 PDF
                                                                        cargando('vehículos fuera de carretera', 4.3);
                                                                        fetch('/jetfilter/generarpdf/vehiculos_carretera3', {
                                                                            signal,
                                                                            method: 'POST',
                                                                        })
                                                                        .then(
                                                                            data => {
                                                                                //4.4 PDF
                                                                                cargando('vehículos fuera de carretera', 4.4);
                                                                                fetch('/jetfilter/generarpdf/vehiculos_carretera4', {
                                                                                    signal,
                                                                                    method: 'POST',
                                                                                })
                                                                                .then(
                                                                                    data => {
                                                                                        //4.5 PDF
                                                                                        cargando('vehículos fuera de carretera', 4.5);
                                                                                        fetch('/jetfilter/generarpdf/vehiculos_carretera', {
                                                                                            signal,
                                                                                            method: 'POST',
                                                                                        })
                                                                                        .then(
                                                                                            data => {
                                                                                                //5 PDF
                                                                                                cargando('equivalencias', 5);
                                                                                                fetch('/jetfilter/generarpdf/equivalencias', {
                                                                                                    signal,
                                                                                                    method: 'POST',
                                                                                                })
                                                                                                .then(
                                                                                                    data => {
                                                                                                       //6 PDF
                                                                                                        cargando('especificaciones', 6);
                                                                                                        fetch('/jetfilter/generarpdf/especificaciones', {
                                                                                                            signal,
                                                                                                            method: 'POST',
                                                                                                        })
                                                                                                        .then(
                                                                                                            data => {
                                                                                                                //6 PDF
                                                                                                                cargando('catalogo completo', 7);
                                                                                                                fetch('/jetfilter/generarpdf/catalogo_completo', {
                                                                                                                    signal,
                                                                                                                    method: 'POST',
                                                                                                                })
                                                                                                                .then(
                                                                                                                    data => {
                                                                                                                        Swal.fire({
                                                                                                                            icon: 'success',
                                                                                                                            title: 'Listo',
                                                                                                                            text: '¡Se han generado los catalogos!',
                                                                                                                            timer: 2000
                                                                                                                        }).then(
                                                                                                                            () => {
                                                                                                                                window.location.href = "/jetfilter/catalogo";
                                                                                                                            }
                                                                                                                        )
                                                                                                                    }
                                                                                                                )
                                                                                                                .catch((err) => {
                                                                                                                    abortando();
                                                                                                                });
                                                                                                            }
                                                                                                        )
                                                                                                        .catch((err) => {
                                                                                                            abortando();
                                                                                                        });
                                                                                                    }
                                                                                                )
                                                                                                .catch((err) => {
                                                                                                    abortando();
                                                                                                });
                                                                                            }
                                                                                        )
                                                                                        .catch((err) => {
                                                                                            abortando();
                                                                                        });
                                                                                    }
                                                                                )
                                                                                .catch((err) => {
                                                                                    abortando();
                                                                                });
                                                                            }
                                                                        )
                                                                        .catch((err) => {
                                                                            abortando();
                                                                        });
                                                                    }
                                                                )
                                                                .catch((err) => {
                                                                    abortando();
                                                                });
                                                            }
                                                        )
                                                        .catch((err) => {
                                                            abortando();
                                                        });
                                                    }
                                                )
                                                .catch((err) => {
                                                    abortando();
                                                });
                                            }
                                        )
                                        .catch((err) => {
                                            abortando();
                                        });
                                    }
                                )
                                .catch((err) => {
                                    abortando();
                                });
                            }
                        )
                        .catch((err) => {
                            abortando();
                        });
                    }
                )
                .catch((err) => {
                    abortando();
                });
            }
        )
        .catch((err) => {
            abortando();
        });
    });
</script>