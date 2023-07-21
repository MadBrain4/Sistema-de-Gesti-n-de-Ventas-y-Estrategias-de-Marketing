function getAplicacion3(aplicacion, marca, vehiculo){
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
            document.getElementById('contenido2').style.display = "none";
            document.getElementById('tabla').style.display = "none";
            document.getElementById('vehiculo_seleccionado').style.display = "block";
            document.getElementById('lista2').style.display = "block";
            document.getElementById('label_lista2').style.display = "block";
            document.getElementById('boton_volver').style.display = "block";
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
        data =>  {
            formData2 = new FormData();
            formData2.append('id_marca', marca);
            formData2.append('id_aplicacion', aplicacion);
            fetch("/aplicaciones/marca", {
                method: 'POST',
                body: formData2,
            })
            .then( response => response.json() )
            .then(
                data2 => {
                    document.getElementById('lista2').innerHTML = data2;
                }
            )
            .catch(
                error2 => alert(error2)
            )
        }
    )
    .then(
        data => {
            formData3 = new FormData();
            formData3.append('id_marca', marca);
            formData3.append('id_aplicacion', aplicacion);
            formData3.append('id_vehiculo', vehiculo);

            fetch("/aplicaciones/vehiculo", {
                method: 'POST',
                body: formData3,
            })
            .then( response => response.json() )
            .then(
                data3 => {
                    console.log(data3);
                    document.getElementById('vehiculo_seleccionado').style.display = 'block';
                    document.getElementById('contenido2').style.display = 'block';
                    document.getElementById('boton_volver').style.display = 'block';
                    document.getElementById('vehiculo_seleccionado').innerHTML = data3;
                }
            )
            .catch(
                error3 => alert(error3)
            )
        }
    )
    .catch(
        error => alert(error)
    )
}