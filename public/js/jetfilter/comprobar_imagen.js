function comprobarImagen(imagen, i){
   var img = new Image();                
      img.src = URL.createObjectURL(imagen[0]);
      img.addEventListener('load', function () {
         var ancho = img.width;
         var alto = img.height
         console.log(ancho + ' ' + alto);
          if(ancho <= 1600 && ancho >= 1400 && alto >= 1200 && alto <= 1300 ){
            document.getElementById('precaucion_imagen-'+i).style.display = 'none';
            var reader = new FileReader(); //Leemos el contenido

            reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
               document.getElementById('img-'+i).setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(document.getElementById("file-"+i).files[0]);
         }
         else{
            document.getElementById('precaucion_imagen-'+i).style.display = "block";
         }
      }) 
 }