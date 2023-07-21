document.addEventListener("DOMContentLoaded", function(event) { 
    document.getElementById('precaucion_imagen-1').style.display = 'none';
    document.getElementById('precaucion_imagen-2').style.display = 'none';
    document.getElementById('precaucion_imagen-3').style.display = 'none';
    document.getElementById('precaucion_imagen-4').style.display = 'none';

    file1 = document.getElementById('file-1');
    file2 = document.getElementById('file-2');
    file3 = document.getElementById('file-3');
    file4 = document.getElementById('file-4');

    file1.addEventListener('change', function(){
        var imagen = document.getElementById("file-1").files;
        comprobarImagen(imagen, 1);
    });

    file2.addEventListener('change', function(){
        var imagen = document.getElementById("file-2").files;
        comprobarImagen(imagen, 2);
    });

    file3.addEventListener('change', function(){
        var imagen = document.getElementById("file-3").files;
        comprobarImagen(imagen, 3);
    });

    file4.addEventListener('change', function(){
        var imagen = document.getElementById("file-4").files;
        comprobarImagen(imagen, 4);
    });
  });