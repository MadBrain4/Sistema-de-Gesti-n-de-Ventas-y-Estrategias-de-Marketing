function getRegistro(id_vehiculo, id_aplicacion, id_marca){
    document.getElementById('tabla').style.display = 'none';
    formData = new FormData();
    formData.append('id_vehiculo', id_vehiculo);
    formData.append('id_aplicacion', id_aplicacion);
    formData.append('id_marca', id_marca);

    fetch("/aplicaciones/vehiculo", {
        method: 'POST',
        body: formData,
    })
    .then( response => response.json() )
    .then(
        data => {
            console.log(data);
            document.getElementById('vehiculo_seleccionado').style.display = 'block';
            document.getElementById('boton_volver').style.display = 'block';
            document.getElementById('navegacion').style.display = 'none';
            document.getElementById('vehiculo_seleccionado').innerHTML = data;
        }
    )

}