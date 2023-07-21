<div class="galeria">
    <div class="contenedor-imagenes">
        @for($i = 0; $i < 4; $i++)
            @if( $imagenes[$i] != '' )
                @if( file_exists( public_path() . '/images/fichas-filtros/web/' . $imagenes[$i] . '.jpg' ) )
                    <div class="imag">
                        <img src="/images/fichas-filtros/web/{{ $imagenes[$i] }}.jpg?t={{ $rann }}" class="imagen" data="https://webfiltros.com/images/fichas-filtros/web/<?php echo $imagenes[$i]; ?>.jpg?t=<?php echo $rann?>"></img>
                    </div>
                @else 
                    <div class="imag">
                        <img src="/images/fichas-filtros/web/no-img.jpg" class="imagen"></img>
                    </div>
                @endif
            @else 
            <div class="imag">
                <img src="/images/fichas-filtros/web/no-img.jpg" class="imagen"></img>
            </div>
            @endif
        @endfor
    </div>
</div>