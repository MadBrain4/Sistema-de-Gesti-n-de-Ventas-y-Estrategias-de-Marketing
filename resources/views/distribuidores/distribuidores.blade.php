<link rel="stylesheet" href="{{ asset( 'css/distribuidoras/distribuidoras.css' )}}">

<x-Arriba />

    <title>Distribuidores</title>
    <section class="grid_d_vnz">
        <x-MapaVnzla />
        <div class="grid_distribuidor" id="grid_distribuidor">

        </div>
        <div id="paginacion" class="links linka">
        
        </div>
        
    </section>

<x-Abajo />

<script>
    paginaActual = 1;
    $( document ).ready(function() {
        formData = new FormData();
        formData.append('estado', "");
        fetch("/busqueda_distribuidores", {
            method: 'POST',
            body: formData,
        })
        .then( response => response.json() )
        .then(
            data => {
                document.getElementById("grid_distribuidor").innerHTML = data.distribuidoras;
                document.getElementById("titulo_distribuidores").innerHTML = data.titulo;
                document.getElementById("paginacion").innerHTML = data.paginacion;
            }
        )
        .catch(
            error => alert(error)
        )
    });

    function getData(pagina, estado){
        formData = new FormData();
        formData.append('estado', estado);
        formData.append('pagina', pagina);

        fetch("/busqueda_distribuidores", {
            method: 'POST',
            body: formData,
        })
        .then( response => response.json() )
        .then(
            data => {
                document.getElementById("grid_distribuidor").innerHTML = data.distribuidoras;
                document.getElementById("paginacion").innerHTML = data.paginacion;
            }
        )
        .catch(
            error => alert(error)
        )
    }

    document.querySelectorAll(".estado").forEach(el => {
        el.addEventListener("click", e => {
            const name = e.target.getAttribute("name");
            const id = e.target.getAttribute("id");

            $('.mapadiv_seleccionado').removeClass("mapadiv_seleccionado")
            document.getElementById(id).classList.add("mapadiv_seleccionado");

            formData = new FormData(); 
            formData.append('estado', name);

            fetch("/busqueda_distribuidores", {
                method: 'POST',
                body: formData,
            })
            .then( response => response.json() )
            .then(
                data => {
                    document.getElementById("grid_distribuidor").innerHTML = data.distribuidoras;
                    document.getElementById("titulo_distribuidores").innerHTML = data.titulo;
                    document.getElementById("paginacion").innerHTML = data.paginacion;
                    if( data.cantidad == 'Vacio' ){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'warning',
                            title: '¡No existen distribuidoras para ese estado!',
                            timer: 1250,
                        })
                    }
                }
            )
            .catch(
                error => alert(error)
            )
        });
    }, false);
</script>