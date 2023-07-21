function getAplicacion2(aplicacion, marca){
    formData = new FormData();
    formData.append('id_marca', marca);
    formData.append('id_aplicacion', aplicacion);
    formData.append('pagina', paginaActual);
    formData.append('regreso', 1);

    fetch("/aplicaciones/tabla", {
        method: 'POST',
        body: formData,
    })
    .then( response => response.json() )
    .then(
        data => { 
            document.getElementById('detalle').style.display = "block";
            document.getElementById('contenido2').style.display = "block";
            document.getElementById('lista2').style.display = "block";
            document.getElementById('label_lista2').style.display = "block";
            document.getElementById('tabla').style.display = "block";
            document.getElementById('vehiculo_seleccionado').style.display = "none";
            document.getElementById('boton_volver').style.display = "none";
            document.getElementById('resultado').innerHTML = data.datos;
            if( data.totalFiltro != data.totalRegistros ){
                document.getElementById('totalResultado').innerHTML = '<p>Mostrando ' + data.totalFiltro + ' de ' + data.totalRegistros + ' registros</p>';
            }
            else {
                document.getElementById('totalResultado').innerHTML = "";
            }
            document.getElementById('navegacion').innerHTML = data.paginacion;
            document.getElementById("lista1").value = data.tipo;
        }
    )
    .then(
        data => {
            formData2 = new FormData();
            formData2.append('id_aplicacion', aplicacion);
            formData2.append('id_marca', marca);

            fetch("/aplicaciones/marca", {
                method: 'POST',
                body: formData2,
            })
            .then( response => response.json() )
            .then(
                data2 => {
                    document.getElementById('texto').value = "";
                    document.getElementById('lista2').innerHTML = data2;
                }
            )
            .catch(
                error2 => alert(error2)
            )
        }
    )
    .catch(
        error => alert(error)
    )
}