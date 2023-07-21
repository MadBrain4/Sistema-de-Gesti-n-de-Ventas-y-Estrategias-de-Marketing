document.addEventListener('DOMContentLoaded', function(){
    lista2 = document.getElementById('lista2');
    lista2.addEventListener('change', function(){
        formData = new FormData();
        valorCambiado = document.getElementById('lista1').value;
        formData.append('id_marca', document.getElementById('lista2').value);
        formData.append('id_aplicacion', document.getElementById('lista1').value );
        formData.append('pagina', paginaActual);

        fetch('/aplicaciones/tabla', {
            method: 'POST',
            body: formData,
        })
        .then( response => response.json() )
        .then(
            data => {
                console.log(data);
                document.getElementById('contenido2').style.display = "block";
                document.getElementById('tabla').style.display = "block";
                document.getElementById('vehiculo_seleccionado').style.display = "none";
                document.getElementById('resultado').innerHTML = data.datos;
                document.getElementById('registros').value = "10";
                document.getElementById('texto').value = "";
                document.getElementById('totalResultado').innerHTML = "";
                document.getElementById('navegacion').innerHTML =  data.paginacion;
                document.getElementById('boton_volver').style.display = "none";
            }
        )
        .catch(
            error => alert(error)
        )
    })
})