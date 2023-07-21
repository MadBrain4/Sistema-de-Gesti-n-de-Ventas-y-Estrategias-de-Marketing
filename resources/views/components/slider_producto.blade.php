<link href="css/snadisplay.css" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('css/normalize_min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
<link rel="stylesheet" href="{{asset('css/estilos_slider_filtro.css')}}">

<div class="galerias">
	<div class="carousel">
		<h1 class="subtitle slider_tex">NUEVOS PRODUCTOS</h1>
		<br>
		<div class="carousel__contenedor slider_tex">
			<button aria-label="Anterior" class="carousel__anterior" >
				<i class="fas fa-chevron-left"></i>
			</button>

			<div class="carousel__lista" id="lista_producto">
				<div class="carousel__elemento">
					<div class="overlay" data="{{asset('img/n_esp/p1.jpg')}}">
						<img src="{{asset('img/p1.jpg')}}" id="li">
					    <div class="banda">
						    <h2 class="subtitle_slider">W-8910</h2>
						</div>	
					</div>
				</div>
				<div class="carousel__elemento">
					<div class="overlay" data="{{asset('img/n_esp/p2.jpg')}}" >
						<img src="{{asset('img/p2.jpg')}}" >
						<div class="banda">
							<h2 class="subtitle_slider">WRA-1208</h2>
					    </div>
					</div>
				</div>
				<div class="carousel__elemento">
					<div class="overlay" data="{{asset('img/n_esp/p3.jpg')}}" >
						<img src="{{asset('img/p3.jpg')}}" >
						<div class="banda">
							<h2 class="subtitle_slider">WRA-30238 sy5</h2>
						</div>
					</div>
				</div>
				<div class="carousel__elemento">
					<div class="overlay" data="{{asset('img/n_esp/p4.jpg')}}" >
						<img src="{{asset('img/p4.jpg')}}" >
						<div class="banda">
							<h2 class="subtitle_slider">WRA-10305</h2>
						</div>
					</div>
				</div>
				<div class="carousel__elemento">
					<div class="overlay" data="{{asset('img/n_esp/p5.jpg')}}" >
						<img src="{{asset('img/p5.jpg')}}" >
						<div class="banda">
							<h2 class="subtitle_slider">WPS-1103</h2>
						</div>
					</div>
				</div>
				<div class="carousel__elemento">
					<div class="overlay" data="{{asset('img/n_esp/p6.jpg')}}" >
						<img src="{{asset('img/p6.jpg')}}" >
						<div class="banda">
							<h2 class="subtitle_slider">WPS-8904</h2>
						</div>
					</div>
				</div>
				<div class="carousel__elemento">
					<div class="overlay" data="{{asset('img/n_esp/p7.jpg')}}" >
						<img src="{{asset('img/p7.jpg')}}" >
						<div class="banda">
							<h2 class="subtitle_slider">WC-9771</h2>
						</div>
					</div>
				</div>		
			</div>
			<button aria-label="Siguiente" class="carousel__siguiente"  >
				<i class="fas fa-chevron-right"></i>
			</button>
		</div>
	</div>
</div>

<script src="{{asset('js/main_img.js')}}"></script>
<script src="{{asset('js/glider_min.js')}}"></script>
<script src="{{asset('js/kit_fontawesome.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('js/app_slider_filtro.js')}}"></script>