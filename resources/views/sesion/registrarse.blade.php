<x-Arriba />

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            var error = {!! json_encode($error, JSON_HEX_TAG) !!}
            Swal.fire({
                icon: 'error',
                title: `${error}`,
                timer: 2000,
            })
        </script>
    @endforeach
@endif
    
<style>
    body {
        background-image: url("/img/pro/fondo3.png");
        background-size: 200%;
    }

    .formulario{
        margin: 1em auto;
        padding: 1.5em;
        border: 3px solid #000;
        border-radius: 5%;
        display: flex;
        justify-content: center;
        max-width: 50%;
        background-color: #fff;
    }

    .title
    {
        color: #000;
        font-family: Oswald;
        font-size: calc(1em + 1vw);
        line-height: 1.5em;
        text-align: center;
    }

    form {
        width: 100%;
        margin: 0 auto;
    }

    .form-label {
        color: #000;
        font-family: Oswald;
        font-size: calc(0.5em + 0.5vw);
        line-height: 1.5em;
        margin-top: 1.5em;
    }

    .form-control {
        width: 75vh;
    }

</style>
    <title>Registrarse</title>
    <section class="formulario">
        <form action="{{ route('crear_usuario') }}" method="POST" id="form" class="form_login">
            @csrf
            <h1 class="title">Registro</h1>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail" class="form-label" >Correo</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Correo">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputNombre" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" id="inputNombre" placeholder="Nombre">
                </div>
            </div>

            <div class="form-row">
                <div  class="form-group col-md-6">
                    <label for="inputPassword" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                </div>

                <div  class="form-group col-md-6">
                    <label for="inputPasswordConfirmation" class="form-label">Repetir Contraseña</label>
                    <input type="password" name="password_confirmation" id="inputPasswordConfirmation" class="form-control" placeholder="Repetir Contraseña" required>
                </div>
            </div>

                <div class="grupo">
                    <label for="FormControlSelect1" class="form-label">Género</label>
                    <select name="genero" class="form-control" id="FormControlSelect1" required>
                        <option value="0" disabled selected>Escoja el Género</option>
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                    </select>
                </div>

                <div class="grupo">
                    <label for="FormControlSelect2" class="form-label">País</label>
                    <select name="pais" class="form-control" id="FormControlSelect2" required>
                        <option value="" disabled selected>Escoja el País</option>
                        <option value="Venezuela">Venezuela</option>
                    </select>
                </div>

                <div class="grupo">
                    <label for="FormControlSelectEstado" class="form-label">Estado</label>
                    <select name="estado" class="form-control" id="FormControlSelectEstado" required>
                        <option value="" disabled selected>Escoja el Estado</option>
                        <option value="Amazonas">Amazonas</option>
                        <option value="Anzoategui">Anzoátegui</option>
                        <option value="Apure">Apure</option>
                        <option value="Aragua">Aragua</option>
                        <option value="Barinas">Barinas</option>
                        <option value="Bolivar">Bolívar</option>
                        <option value="Carabobo">Carabobo</option>
                        <option value="Cojedes">Cojedes</option>
                        <option value="Delta_Amacuro">Delta Amacuro</option>
                        <option value="Distrito_Capital">Distrito Capital</option>
                        <option value="Falcon">Falcón</option>
                        <option value="Guarico">Guárico</option>
                        <option value="Lara">Lara</option>
                        <option value="Merida">Mérida</option>
                        <option value="Miranda">Miranda</option>
                        <option value="Monagas">Monagas</option>
                        <option value="Nueva_Esparta">Nueva Esparta</option>
                        <option value="Portuguesa">Portuguesa</option>
                        <option value="Sucre">Sucre</option>
                        <option value="Tachira">Táchira</option>
                        <option value="Trujillo">Trujillo</option>
                        <option value="Vargas">Vargas</option>
                        <option value="Yaracuy">Yaracuy</option>
                        <option value="Zulia">Zulia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección">
                </div>

                <div class="form-group">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono">
                </div>

                <div class="form-group">
                    <label for="nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="nacimiento" id="nacimiento" class="input" required>
                </div>

                <button type="submit" name="registrarse" class="boton">Registrar</button>
                <br>
            </div>
        </form>
    </section>
<x-Abajo />