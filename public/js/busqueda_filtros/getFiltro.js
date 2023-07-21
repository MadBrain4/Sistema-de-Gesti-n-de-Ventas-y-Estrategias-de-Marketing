function getFiltro(codigo){
    document.getElementById('detalle').style.display = 'none';
    document.getElementById('buscar').style.display = 'none';
    document.getElementById('busquedas').style.display = 'none';

    formData = new FormData();
    formData.append('codigo', codigo);
    fetch("/aplicaciones/filtro", {
        method: 'POST',
        body: formData,
    })
    .then( response => response.json() )
    .then(
        data => {
            document.getElementById('detalle_producto').style.display = "grid";
            document.getElementById('filtro_titulo').innerHTML = response.titulo;
            document.getElementById('filtro_carrusel').innerHTML = response.carrusel;
            document.getElementById('filtro_especificaciones').innerHTML = response.especificaciones;
            document.getElementById('filtro_aplicacion').innerHTML = response.aplicacion;
            document.getElementById('filtro_equivalencia').innerHTML = response.equivalencia;
        }
    )
    .catch(
        error => alert(error)
    )
}