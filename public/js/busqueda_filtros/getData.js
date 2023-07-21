function getData(pagina){
    let input = document.getElementById("texto").value;
    let registros = document.getElementById("registros").value;
    formData = new FormData();
    formData.append('campo', input);
    formData.append('id_aplicacion', document.getElementById('lista1').value );
    formData.append('id_marca', document.getElementById('lista2').value );
    formData.append('registros', registros);
    formData.append('pagina', pagina);

    fetch('/aplicaciones/tabla', {
        method: 'POST',
        body: formData,
    })
    .then( response => response.json() )
    .then(
        data => {
            document.getElementById('resultado').innerHTML = data.datos;
            if(data.totalFiltro != data.totalRegistros){
                document.getElementById('totalResultado').innerHTML = '<p>Mostrando ' + data.totalFiltro + ' de ' + data.totalRegistros + ' registros</p>';
            }
            else {
                document.getElementById('totalResultado').innerHTML = "";
            }
            document.getElementById('navegacion').innerHTML = data.paginacion;
        }
    )
    .catch(
        error => alert(error)
    )
}