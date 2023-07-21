function buscar(){
    if (document.getElementById("keywords").value != "") {
        input = document.getElementById("keywords").value;
        history.replaceState(null, "", `/codigo?codigo=${input}`);

        formData = new FormData();
        formData.append('codigo', input);
    
        fetch("/codigos/busqueda", {
            method: 'POST',
            body: formData,
        })
        .then( response => response.json() )
        .then( (data) => {
            console.log(data.clase);
            document.getElementById("resultados_busqueda").innerHTML = data.especificaciones;
            document.getElementById("resultados_busqueda_equivalencias").innerHTML = data.equivalencias;
            document.getElementById("resultados_busqueda").style.display = "block";
            document.getElementById("resultados_busqueda_equivalencias").style.display = "block";
            coincidencia = data.coincidencia;
        })
        .then(
            () => {
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

                if( coincidencia == 1 ){
                    Toast.fire({
                        icon: 'success',
                        title: '¡Busqueda Realizada!',
                        timer: 1250,
                    })
                }
                else {
                    Toast.fire({
                        icon: 'warning',
                        title: '¡No existen resultados!',
                        timer: 1250,
                    })
                }
            }
        )
        .catch(
            error => alert(error)
        )
    }
}