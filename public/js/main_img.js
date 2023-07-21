var imagenes = document.querySelectorAll('.overlay');

imagenes.forEach((el, index) => {
	el.addEventListener('click', function () {
		var data = $(this).attr("data");
		var lightbox = '<div class="ligthbox">'+
						'<img src="'+data+'" alt="">'+
					'</div>';

		$("body").append(lightbox)
		$(".ligthbox").click(function(){
			$(".ligthbox").remove();
			$(".zoomContainer").remove();
			$(".zoomLens").remove();
			$(".zoomWindowContainer").remove();
		})
	});
});