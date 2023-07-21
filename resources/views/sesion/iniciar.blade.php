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

@if( session()->has('correo_equivocado') )
    <script>
        Swal.fire({
            icon: 'error',
            title: `El correo no fue encontrado`,
            timer: 2000,
        })
    </script>
    @php
        session()->forget('correo_equivocado');
    @endphp
@endif
@if( session()->has('contraseña_equivocada') )
    <script>
        Swal.fire({
            icon: 'error',
            title: `La contraseña no es correcta`,
            timer: 2000,
        })
    </script>
    @php
        session()->forget('contraseña_equivocada');
    @endphp
@endif
@if( session()->has('registrado') )
    <script>
        Swal.fire({
            icon: 'success',
            title: `El usuario fue registrado satisfactoriamente`,
            confirmButtonText:
                '<i class="fa fa-thumbs-up""></i> Entendido',
        })
    </script>
    @php
        session()->forget('registrado');
    @endphp
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

    .footerr {
        position: fixed;
        bottom: 0px;
        width: 100%;
    }

</style>
    <title>Iniciar Sesión</title>
    <section class="formulario">
        <form action="{{route('ingresar_usuario')}}" method="POST" id="form" class="form_login">
            @csrf
            <div class="login">
                <h1>Acceso</h1>

                <div class="form-group col-md-6">
                    <label for="inputEmail" class="form-label" >Correo</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Correo">
                </div>

                <div  class="form-group col-md-6">
                    <label for="inputPassword" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                </div>

                <button type="submit" name="iniciar_sesion" class="boton mt-3">Acceso</button>
                <br>
            </div>
        </form>
    </section>
<x-Abajo />