<div class="galeria">
    <div class="contenedor-imagenes">
        @for($i = 0; $i < 4; $i++)
            @if( $imagenes[$i] != '' )
                @if( file_exists( public_path() . '/images/fichas-filtros/web/' . $imagenes[$i] . '.jpg' ) )
                    <div class="imag">
                        <div id="precaucion_imagen-{{ $i + 1 }}" class="div_imagenes" style="background-color: white; height: 100%; color:red; justify-content: center; align-items: center">
                            <p>Esta imagen no tiene las dimensiones adecuadas</p>
                        </div>
                        <img src="/images/fichas-filtros/web/{{ $imagenes[$i] }}.jpg?t={{ $rann }}" id="img-{{ $i+1 }}" class="imagen" data="https://webfiltros.com/images/fichas-filtros/web/{{ $imagenes[$i] }}.jpg?t={{ $rann }}"></img>
                        <input type="file" accept="image/jpeg" name="imagen{{ $i + 1 }}" id="file-{{ $i + 1 }}" class="inputfile inputfile-1" data-multiple-caption="{count} archivos seleccionados" />
                        <label class="file-1" for="file-{{ $i + 1 }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                            <span class="iborrainputfile">Seleccionar archivo</span>
                        </label>
                    </div>
                @else
                    <div class="imag">
                        <div id="precaucion_imagen-{{ $i + 1 }}" class="div_imagenes" style="background-color: white; height: 100%; color:red; justify-content: center; align-items: center">
                            <p>Esta imagen no tiene las dimensiones adecuadas</p>
                        </div>
                        <img src="/images/fichas-filtros/web/no-img.jpg" class="imagen" id="img-{{ $i+1 }}"></img>
                        <input type="file" accept="image/jpeg" name="imagen{{ $i + 1 }}" id="file-{{ $i + 1 }}" class="inputfile inputfile-1" data-multiple-caption="{count} archivos seleccionados" />
                        <label class="file-1" for="file-{{ $i + 1 }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                            <span class="iborrainputfile">Seleccionar archivo</span>
                        </label>
                    </div>
                @endif
            @else
                <div class="imag">
                    <div id="precaucion_imagen-{{ $i + 1 }}" class="div_imagenes" style="background-color: white; height: 100%; color:red; justify-content: center; align-items: center">
                        <p>Esta imagen no tiene las dimensiones adecuadas</p>
                    </div>
                    <img src="/images/fichas-filtros/web/no-img.jpg" class="imagen" id="img-{{ $i+1 }}"></img>
                    <input type="file" accept="image/jpeg" name="imagen{{ $i + 1 }}" id="file-{{ $i + 1 }}" class="inputfile inputfile-1" data-multiple-caption="{count} archivos seleccionados" multiple />
                    <label class="file-1" for="file-{{ $i + 1 }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                        <span class="iborrainputfile">Seleccionar archivo</span>
                    </label>
                </div>
            @endif
        @endfor
    </div>
</div>