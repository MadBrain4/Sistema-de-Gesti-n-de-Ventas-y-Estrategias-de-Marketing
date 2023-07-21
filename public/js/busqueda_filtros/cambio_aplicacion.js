document.addEventListener('DOMContentLoaded', function(){
    lista1 = document.getElementById('lista1');
    lista1.addEventListener('change', function(){
        formData = new FormData();
        valorCambiado = document.getElementById('lista1').value;
        formData.append('id_aplicacion', valorCambiado);

        fetch('/aplicaciones/marca', {
            method: 'POST',
            body: formData,
        })
        .then( response => response.json() )
        .then(
            data => {
                console.log(data);
                document.getElementById('lista2').style.display = "block";
                document.getElementById('label_lista2').style.display = "block";
                document.getElementById('lista2').innerHTML = data;
            }
        )
        .catch(
            error => alert(error)
        )
    })
})