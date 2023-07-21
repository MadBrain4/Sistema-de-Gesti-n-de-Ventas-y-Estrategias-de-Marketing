<template>
    <v-app>
        <div class="body">
            <div>
                <v-toolbar
                prominent
                color="red"
                >

                <v-img
                    src="/img/logo/web.png"
                    max-width="200"
                    max-height="60"
                    >
                </v-img>

                <v-toolbar-title><a href="/jetfilter/sesion">Jet-Filter</a></v-toolbar-title>
                <v-btn>
                    <a href="/jetfilter/marketing">Marketing</a>
                </v-btn>
                <v-btn>
                    <a href="/jetfilter/marketing/proyeccion">Proyecciones</a>
                </v-btn>
                <v-btn>
                    <a href="/jetfilter/marketing/presupuesto">Presupuesto</a>
                </v-btn>
                <v-btn>
                    <a href="/jetfilter/marketing/estrategias">Estrategias</a>
                </v-btn>
                <v-btn>
                    <a href="/jetfilter/catalogo">Catálogo</a>
                </v-btn>
                <v-btn>
                    <a href="/jetfilter/distribuidoras">Distribuidoras</a>
                </v-btn>

                <v-spacer></v-spacer>

                <v-btn icon>
                    <a href="/jetfilter/logout"><v-icon>mdi-export</v-icon></a>
                </v-btn>
                </v-toolbar>
            </div>

            <div>
                <v-tollbar class="subtitulo">
                    <v-app-bar-nav-icon height="35px" width="35px" @click.stop="filtro_resultados = !filtro_resultados">
                    </v-app-bar-nav-icon>
                    <h2 class="titulo">Dashboard de Ventas</h2>
                </v-tollbar>
            </div>

            <v-navigation-drawer
                v-model="filtro_resultados"
                persistent
            >
                <v-btn block color="red" class="mr-16" @click.stop="filtro_resultados = !filtro_resultados">Cerrar</v-btn>

                <v-radio-group v-model="form.fecha" label="Fecha" class="mt-3">
                    <v-radio label="Ultimo Año" name="fecha" :value="1" v-on:change="modificarFecha()" ></v-radio>
                    <v-radio label="Ultimos 3 Años" name="fecha" :value="2" v-on:change="modificarFecha()" ></v-radio>
                    <v-radio label="Ultimos 5 Años" name="fecha" :value="3" v-on:change="modificarFecha()" ></v-radio>
                    <v-radio label="Ultimos 10 Años" name="fecha" :value="4" v-on:change="modificarFecha()" ></v-radio>
                </v-radio-group>

                <div v-if="form.fecha > 4" class="ml-4" style="margin-top: -1.5em;">
                    <input type="date" name="" id="" style="border: 1px solid #000;">
                    <input type="date" name="" id="" style="border: 1px solid #000;">
                </div>

                <v-radio-group v-model="form.tipo_cliente" label="Tipo Cliente" class="mt-3">
                    <v-radio label="Ambos" name="tipo_cliente" :value="1" v-on:change="modificarCliente()" ></v-radio>
                    <v-radio label="Clientes" name="tipo_cliente" :value="2" v-on:change="modificarCliente()" ></v-radio>
                    <v-radio label="Distribuidoras" name="tipo_cliente" :value="3" v-on:change="modificarCliente()" ></v-radio>
                </v-radio-group>

                <p class="ml-2 mb-9">Categorias</p>
                <v-checkbox style="margin-top: -2.5em; margin-bottom: -2px" v-for="(item, index) in categorias" :key="index" :label="item" name="categoria[]" :value="categorias_valor[index]" v-on:change="enviar()" v-model="form.categoria"></v-checkbox>

                <p class="ml-2 mb-9">Estados</p>
                <v-checkbox style="margin-top: -2.5em; margin-bottom: -2px" v-for="(item, index) in estados" :key="index" :label="item" name="estado[]" :value="estados_valor[index]" v-on:change="enviar()" v-model="form.estado"></v-checkbox>
            </v-navigation-drawer>

            <div class="main pt-2" style="background-color: #D2D1D1;">
                <v-card class="tarjeta pt-2 ml-2" style="display: grid; place-items: center; width: 100%;">
                    <v-avatar size="75" style="border: 1px solid #000; padding: 0.5em;">
                        <v-img
                            src="/img_jetfilter/logo/jf.png"
                            alt="Jet-Filter"
                        ></v-img>
                    </v-avatar>
                    <v-card-text style="text-align: center;">
                        <b>Fuerza de Ventas</b>
                    </v-card-text>
                </v-card>
                <v-card class="grafica1 pt-4" style="display: grid; place-items: center;">
                    <v-title><h3>Ventas por Mes</h3></v-title>
                    <apexchart
                        type="bar"
                        class="graficador1"
                        :options = "options"
                        :series = "series"
                    ></apexchart>
                </v-card>
                <v-card class="grafica2 pt-4 mr-4" style="display: grid; place-items: center;">
                    <v-title><h3>Porcentaje de Ventas por Mes</h3></v-title>
                    <apexchart
                        class="graficador1"
                        type="bar"
                        :options = "options"
                        :series = "seriesGraficaPorcentaje"
                    ></apexchart>
                </v-card>
                <v-card class="grafica3 pt-4 ml-4" style="display: grid; place-items: center;">
                    <v-title><h3>Proyección de las Ventas por Mes</h3></v-title>
                    <apexchart
                        class="graficador1"
                        type="bar"
                        :options = "options"
                        :series = "seriesProyecciones"
                    ></apexchart>
                </v-card>
                <v-card class="grafica4" style="display: grid; ">
                    <img src="/img/Marketing/Dinero.png" style="place-self:center;" class="mt-16 ml-2 imagen">
                    <v-card-title class="texto mt-3" style="place-self: center; font-size: 1.5em;">Total Dinero</v-card-title>
                    <v-card-text class="texto2" style="place-self: center; font-size: 1.5em; color: red;"><b>${{ dinero_generado }}</b></v-card-text>
                    <v-card-text style="grid-row: 3 / 3; grid-column: 1 / 4; place-self: center; font-size: 0.75em; opacity: 0.5;">En un rango de 12 meses</v-card-text>
                    <v-card-text  style="grid-row: 4 / 4; grid-column: 1 / 4; place-self: center; font-size: 1.25em;">Volumen de Compras</v-card-text>
                    <v-card-text style="grid-row: 5 / 5; grid-column: 1 / 4; place-self: center; font-size: 1.75em; color: green;"><b>{{ ventas_realizadas }}</b></v-card-text>
                    <v-card-text style="grid-row: 6 / 6; grid-column: 1 / 4; place-self: center; font-size: 0.75em; opacity: 0.5;">Compras Despechadas</v-card-text>
                </v-card>
                <v-carousel
                    show-arrows="hover"
                    :continuous="true"
                    class="grafica5"
                >
                    <v-carousel-item
                        v-for="(top, i) in tops"
                        :key="i"
                    >
                        <v-sheet
                            :color="colors[i]"
                            height="100%"
                            tile
                            >
                            <div class="d-flex fill-height justify-center align-center">
                                <div class="text-h2">
                                    {{ top }}
                                </div>
                            </div>
                        </v-sheet>
                    </v-carousel-item>
                </v-carousel>
                <v-card class="grafica6" style="display: grid;">
                    <img src="/img/Marketing/Cliente.png" style="place-self: center;" class="mt-16 ml-2 imagen2">
                    <v-card-title class="mt-3 mr-3" style="place-self: center; font-size: 1.5em; grid-row: 1 / 2; grid-column: 2 / 4;">Clientes Únicos</v-card-title>
                    <v-card-text style="place-self: center; font-size: 1.5em; color: red; grid-row: 2 / 4; grid-column: 2 / 4;"><b>{{ clientes_unicos }}</b></v-card-text>
                    <v-card-title class="mt-3" style="place-self: center; font-size: 1.5em; grid-row: 4 / 5; grid-column: 1 / 4;">Clientes Totales</v-card-title>
                    <v-card-text style="place-self: center; font-size: 1.5em; color: green; grid-row: 5 / 7; grid-column: 1 / 4;"><b>{{ clientes_totales }}</b></v-card-text>
                </v-card>
                <v-card class="grafica7 ml-4" style="display: grid; place-items: center;">
                    <v-title class="mt-3"><h3>Ventas por Zona</h3></v-title>
                    <apexchart
                        class="graficador1"
                        type="donut"
                        :options = "options3"
                        :series = "seriesEstado"
                    ></apexchart>
                </v-card>
                <v-card class="grafica8" style="display: grid; place-items: center;">
                    <h2 style="text-align: center; color: #F54E4E;" class="mx-4">Filtros Vendidos</h2>
                    <h3 style="text-align: center;">{{ filtros_vendidos }}</h3>
                    <h2 style="text-align: center; color: #F54E4E;" class="mx-4">Promedio Filtros Vendidos por Venta</h2>
                    <h3 style="text-align: center;">{{ (filtros_vendidos/ventas_realizadas).toFixed(2) }}</h3>
                    <h2 style="text-align: center; color: #F54E4E;" class="mx-3">Dinero Promedio Generado por Venta</h2>
                    <h3 style="text-align: center;">{{ (dinero_generado/ventas_realizadas).toFixed(2) }}$</h3>
                </v-card>
                <v-card class="grafica9" style="display: grid; place-items: center;">
                    <v-title><h3>Ventas por Categoría</h3></v-title>
                    <apexchart
                        class="graficador2"
                        type="donut"
                        :series = "seriesCategoria"
                        :options = "options2"
                    ></apexchart>
                </v-card>
            </div>
        </div>
    </v-app>
</template>

<style>

    a {
            text-decoration: none;
            color: #fff;
            cursor: pointer;
        }

    .subtitulo {
        display: flex;
        widows: 100%;
        background-color: gray;
        padding: 0.10em 0;
    }

    .titulo {
        margin: auto;
        color: #fff;
    }

    .main {
        display: grid;
        grid-template-columns: repeat(9, minmax(9.8%, 9.8%));
        grid-template-rows: repeat(5, minmax(10em, 10em));
        column-gap: 1rem; /* 4px */
        row-gap: 1rem; /* 4px */
        padding-bottom: 1em;
    }

    .tarjeta {
        grid-row: 1 /  1;
        grid-column: 1 /  1;
    }

    .grafica1 {
        grid-row: 1 /  3;
        grid-column: 2 / 6;
    }

    .grafica2 {
        grid-row: 1 / 3;
        grid-column: 6 / 10;
    }

    .grafica3 {
        grid-row: 3 /  5;
        grid-column: 1 / 5;
    }

    .grafica4 {
        grid-row: 3 / 4;
        grid-column: 5 / 7;
        display: grid;
        grid-template-columns: repeat(3, minmax(33%, 33%));
        grid-template-rows: repeat(6, minmax(16.5%, 16.5%));
    }

    .grafica5 {
        grid-row: 3 / 5;
        grid-column: 7 / 10;
    }

    .grafica6 {
        grid-row: 4 / 5;
        grid-column: 5 / 7;
        display: grid;
        grid-template-columns: repeat(3, minmax(33%, 33%));
        grid-template-rows: repeat(6, minmax(16.5%, 16.5%));
    }

    .grafica7 {
        display: grid;
        place-items: center;
        grid-row: 5 / 7;
        grid-column: 1 / 5;
    }

    .grafica8 {
        display: grid;
        place-items: center;
        grid-row: 5 / 7;
        grid-column: 5 / 7;
    }

    .grafica9 {
        display: grid;
        place-items: center;
        grid-row: 6 / 7;
        grid-column: 7 / 10;
    }

    .graficador1{
        width: 90%;
    }

    .graficador2{
        height: 90%;;
        width: 100%;
    }

    .imagen {
        width: 5em;
        grid-row: 1 / 2;
        grid-column: 1 / 1;
    }

    .imagen2 {
        width: 90%;
        grid-row: 1 / 2;
        grid-column: 1 / 2;
    }

    .texto {
        grid-row: 1 /  2;
        grid-column: 2 /  4;
    }

    .texto2 {
        grid-row: 2 / 4;
        grid-column: 2 / 4;
    }
</style>

<script>

    export default {
        data () {
            return {
                colors: [
                    '#fff',
                    'green-lighten-2',
                    'green-lighten-2',
                    'green-lighten-2',
                    'green-lighten-2',
                    'green-lighten-2',
                    'red-darken-2',
                    'red-darken-2',
                    'red-darken-2',
                    'red-darken-2',
                    'red-darken-2',
                ],
                tops: ['Productos'],
                //Estados 
                estados: ['Amazonas', 'Anzoategui', 'Apure', 'Aragua', 'Barinas', 'Bolivar', 'Carabobo', 'Cojedes', 'Delta Amacuro', 'Distrito Capital', 'Falcon', 'Guarico', 'Lara', 'Merida', 'Miranda', 'Monagas', 'Nueva Esparta', 'Portuguesa', 'Sucre', 'Tachira', 'Trujillo', 'Vargas', 'Yaracuy', 'Zulia'],
                estados_valor: ['amazonas', 'anzoategui', 'apure', 'aragua', 'barinas', 'bolivar', 'carabobo', 'cojedes', 'delta_amacuro', 'distrito_capital', 'falcon', 'guarico', 'lara', 'merida', 'miranda', 'monagas', 'nueva_esparta', 'portuguesa', 'sucre', 'tachira', 'trujillo', 'vargas', 'yaracuy', 'zulia'],
                //Categorias
                categorias: ['Aire Automotriz', 'Aire Industrial', 'Combustible en Linea', 'Elemento', 'Panel', 'Sellado'],
                categorias_valor: ['aireautomotriz', 'aireindustrial', 'combustiblelinea', 'elemento', 'panel', 'sellado'],
                //Datos
                filtro_resultados: false,
                producto: {
                    codigo: '',
                },
                bandera: 0,
                datos: "",
                dato: "",
                datos_totales: "",
                datos_categorias: "",
                datos_estado: '',
                ventas_realizadas: 0,
                dinero_generado: 0,
                ventas_realizadas_filtros: 0,
                dinero_generado_filtros: 0,
                filtros_vendidos: 0,
                datos_proyecciones: 0,
                pronosticos: [],
                clientes_totales: 0,
                clientes_unicos: 0,
                max_productos: [
                    {
                        ventas: 0,
                        codigo: '',
                    },
                    {
                        ventas: 0,
                        codigo: '',
                    },
                    {
                        ventas: 0,
                        codigo: '',
                    },
                    {
                        ventas: 0,
                        codigo: '',
                    },
                    {
                        ventas: 0,
                        codigo: '',
                    },
                ],
                min_productos: [
                    {
                        ventas: 0,
                        codigo: '',
                    },
                    {
                        ventas: 0,
                        codigo: '',
                    },
                    {
                        ventas: 0,
                        codigo: '',
                    },
                    {
                        ventas: 0,
                        codigo: '',
                    },
                    {
                        ventas: 0,
                        codigo: '',
                    },
                ],

                meses: ["January","February","March","April","May","June","July","August","September","October","November","December"],
                estados: ['Amazonas', 'Anzoategui', 'Apure', 'Aragua', 'Barinas', 'Bolivar', 'Carabobo', 'Cojedes', 'Delta Amacuro', 'Distrito Capital', 'Falcon', 'Guarico', 'Lara', 'Merida', 'Miranda', 'Monagas', 'Nueva Esparta', 'Portuguesa', 'Sucre', 'Tachira', 'Trujillo', 'Vargas', 'Yaracuy', 'Zulia'],
                //Datos de Formulario 
                form: {
                    fecha: 1,
                    tipo_cliente: 1,
                    categoria: ["aireautomotriz", "aireindustrial", "combustiblelinea", "elemento", "panel", "sellado"],
                    estado: ['amazonas', 'anzoategui', 'apure', 'aragua', 'barinas', 'bolivar', 'carabobo', 'cojedes', 'delta_amacuro', 'distrito_capital', 'falcon', 'guarico', 'lara', 'merida', 'miranda', 'monagas', 'nueva_esparta', 'portuguesa', 'sucre', 'tachira', 'trujillo', 'vargas', 'yaracuy', 'zulia'],
                    codigo: '',
                },
                seriesCategoria: [],
                options2: {
                    labels: ['Aire Automotriz', 'Aire Industrial', 'Combustible', 'Elemento', 'Panel', 'Sellado'],
                },
                options3: {
                    colors : ['#245953', '#3C486B', '#F9D949', '#F45050', '#E49393', '#408E91', '#009FBD', '#210062', '#77037B', '#8F43EE', '#B3E5BE', '#A86464', '#FF6000', '#FFA559', '#CD1818', '#4E3636', '#0E2954', '#03C988', '#1C82AD', '#C69749', '#191825', '#FFA3FD', '#332FD0', '#46C2CB'],
                    labels: ['Amazonas', 'Anzoátegui', 'Apure', 'Aragua', 'Barinas', 'Bolívar', 'Carabobo', 'Cojedes', 'Delta Amacuro', 'Distrito Capital', 'Falcón', 'Guárico', 'Lara', 'Mérida', 'Miranda', 'Monagas', 'Nueva Esparta', 'Portuguesa', 'Sucre', 'Táchira', 'Trujillo', 'Vargas', 'Yaracuy', 'Zulia'],
                },
                //Datos de Grafica
                options: {
                    xaxis: {
                        type: 'category',
                        tickPlacement: 'between',
                        categories: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                    },
                    grid: {
                        row: {
                            colors: ['#3E91C9']
                        },
                        column: {
                            colors: ['#3E91C9']
                        }
                    },
                    theme: {
                        palette: 'palette5' // upto palette10
                    }

                },
                optionsHorizontal: {
                    plotOptions: {
                        bar: {
                            horizontal: true
                        }
                    },
                    xaxis: {
                        type: 'category',
                        tickPlacement: 'between',
                        categories: ["Aire Automotriz", "Aire Industrial", "Combustible", "Elemento", "Panel", "Sellado"],
                    },
                },
                series: [
                    {
                        data: []
                    }
                ],
                seriesGraficaPorcentaje: [
                    {
                        data: []
                    }
                ],
                seriesProyecciones: [
                    {
                        data: []
                    }
                ],
                seriesEstado: [],
            }
        },

        methods: {
            enviar(){
                axios.post('/jetfilter/marketing/graficas', this.form)
                    .then((response) => {
                        this.actualizarGraficas(response);
                        this.actualizarGraficasPorcentaje(response);
                        this.actualizarGraficasCategoria(response);
                        this.actualizarGraficasEstado(response);
                        this.actualizarGraficaProyecciones(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            modificarFecha(){
                console.log(this.form.fecha);
                axios.post('/jetfilter/marketing/graficas', this.form)
                    .then((response) => {
                        this.actualizarGraficas(response);
                        this.actualizarGraficasPorcentaje(response);
                        this.actualizarGraficasCategoria(response);
                        this.actualizarGraficasEstado(response);
                        this.actualizarGraficaProyecciones(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            modificarCliente(){
                axios.post('/jetfilter/marketing/graficas', this.form)
                    .then((response) => {
                        this.actualizarGraficas(response);
                        this.actualizarGraficasPorcentaje(response);
                        this.actualizarGraficasCategoria(response);
                        this.actualizarGraficasEstado(response);
                        this.actualizarGraficaProyecciones(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            modificarCategoria(){
                axios.post('/jetfilter/marketing/graficas', this.form)
                    .then((response) => {
                        this.actualizarGraficas(response);
                        this.actualizarGraficasPorcentaje(response);
                        this.actualizarGraficasCategoria(response);
                        this.actualizarGraficasEstado(response);
                        this.actualizarGraficaProyecciones(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            modificarEstado(){
                axios.post('/jetfilter/marketing/graficas', this.form)
                    .then((response) => {
                        this.actualizarGraficas(response);
                        this.actualizarGraficasPorcentaje(response);
                        this.actualizarGraficasCategoria(response);
                        this.actualizarGraficasEstado(response);
                        this.actualizarGraficaProyecciones(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            buscarCodigo(){
                axios.post('/jetfilter/marketing/graficas', this.form)
                    .then((response) => {
                        this.actualizarGraficas(response);
                        this.actualizarGraficasPorcentaje(response);

                    })
                    .catch((error) => {
                        console.log('error');
                    });
            },

            actualizarGraficas(response){
                console.log(response);
                this.series[0].data = [];
                this.datos = response.data[0];
                this.ventas_realizadas = response.data[2][0].ventas_realizadas;
                this.dinero_generado = response.data[2][0].dinero_generado;
                this.tops = ['Productos']; 

                for(let i = 0; i < response.data[6].length; i++){
                    this.max_productos[i].ventas = response.data[6][i].productos_vendidos
                    this.tops[i + 1] = response.data[6][i].codigo
                }
                for(let i = 0; i < response.data[7].length; i++){
                    this.min_productos[i].ventas = response.data[7][i].productos_vendidos
                    this.tops[i + response.data[6].length + 1] = response.data[7][i].codigo
                }
                this.clientes_totales = response.data[8];
                this.clientes_unicos = response.data[9];
                this.filtros_vendidos = response.data[10];

                //Llenamos la grafica de mes
                this.bandera = 0;
                if( this.datos == ""){
                    for(let i = 0; i < 12; i++){
                        let objeto = {
                            y: 0,
                            x: '',
                        };
                        this.series[0].data.push(objeto);
                    }
                }
                else {
                    for(let i = 0; i < 12; i++){

                        if( this.datos[this.bandera].nombre_mes == this.meses[i] ){
                            let objeto = {
                                y: parseInt(this.datos[this.bandera].precio),
                                x: '',
                            };
                            this.series[0].data.push(objeto);
                            if( (this.datos.length - 1) > this.bandera){
                                this.bandera++;
                            }
                        }

                        else {
                            let objeto = {
                                y: 0,
                                x: '',
                            };
                            this.series[0].data.push(objeto);
                        }
                    }
                }
            },

            actualizarGraficasPorcentaje(response){
                console.log(response.data[3][0]);
                this.seriesGraficaPorcentaje[0].data = [];
                this.datos = response.data[0];
                this.datos_totales = response.data[1];
                this.ventas_realizadas = response.data[3][0].ventas_realizadas;
                this.dinero_generado = response.data[3][0].dinero_generado;
                console.log(this.dinero_generado);
                this.bandera = 0;
                this.bandera2 = 0;

                if( this.datos_totales == ""){
                    for(let i = 0; i < 12; i++){
                        let objeto = {
                            y: 0,
                            x: '',
                        };
                        this.seriesGraficaPorcentaje[0].data.push(objeto);
                    }
                }
                else if( this.datos == ""){
                    for(let i = 0; i < 12; i++){
                        let objeto = {
                            y: 0,
                            x: '',
                        };
                        this.seriesGraficaPorcentaje[0].data.push(objeto);
                    }
                }
                else {
                    for(let i = 0; i < 12; i++){
                        console.log(this.datos_totales);
                        if( this.datos[this.bandera].nombre_mes == this.meses[i] && this.datos_totales[this.bandera2].nombre_mes == this.meses[i] ){
                            if( this.datos[this.bandera].precio != 0 ){
                                let objeto = {
                                    y: (( this.datos[this.bandera].precio * 100) / this.dinero_generado).toFixed(2),
                                    x: '',
                                };
                                this.seriesGraficaPorcentaje[0].data.push(objeto);
                                if( ( this.datos.length - 1) > this.bandera){
                                    this.bandera++;
                                }
                                this.bandera2++;
                            }
                            else {
                                let objeto = {
                                    y: 0,
                                    x: '',
                                };
                                this.seriesGraficaPorcentaje[0].data.push(objeto);
                            }
                        }
                        else {
                            let objeto = {
                                y: 0,
                                x: '',
                            };
                            this.seriesGraficaPorcentaje[0].data.push(objeto);
                        }
                    }
                }
            },

            actualizarGraficaProyecciones(response){
                this.seriesProyecciones[0].data = [];
                this.datos_proyecciones = response.data[0];
                let alpha = 0.7;
                this.pronosticos[0] = this.datos_proyecciones[0].precio;
                let objeto = {
                    y: parseInt(this.datos_proyecciones[0].precio),
                    x: '',
                };
                this.seriesProyecciones[0].data.push(objeto);

                if( this.datos_proyecciones == ""){
                    for(let i = 0; i < 12; i++){
                        let objeto = {
                            y: 0,
                            x: '',
                        };
                        this.seriesProyecciones[0].data.push(objeto);
                    }
                }
                else {
                    for(let i = 1; i < 13; i++){
                        if(i == 1){
                            this.pronosticos[i] = ( alpha * this.pronosticos[i - 1] ) + ( 1 - alpha )*( this.pronosticos[i - 1] );
                            let objeto = {
                                y: parseInt(this.pronosticos[i]),
                                x: '',
                            }
                            this.seriesProyecciones[0].data.push(objeto);
                        }
                        else if(i < 13) {
                            this.pronosticos[i] = ( alpha * this.datos_proyecciones[i - 1].precio ) + (( 1 - alpha )*(this.pronosticos[i - 1]));
                            let objeto = {
                                y: parseInt(this.pronosticos[i]),
                                x: '',
                            };
                            this.seriesProyecciones[0].data.push(objeto);
                        }
                    }
                }
            },

            actualizarGraficasCategoria(response){
                this.seriesCategoria = [];
                this.datos_categorias = response.data[4];
                this.bandera = 0;

                if( this.datos_categorias == "" ){
                    for(let i = 0; i < 6; i++){
                        this.seriesCategoria[i] = 0;
                    }
                }
                else{
                    for(let i = 0; i < 6; i++){

                        if( this.datos_categorias[this.bandera].clase == this.categorias[i] ){
                            this.seriesCategoria[i] = parseInt(this.datos_categorias[this.bandera].precio_total + (this.datos_categorias[this.bandera].precio_total * 0.15));
                            if( (this.datos_categorias.length - 1) > this.bandera){
                                this.bandera++;
                            }
                        }
                        else {
                            this.seriesCategoria[i] = 0;
                        }
                    }
                }

            },

            actualizarGraficasEstado(response){
                this.seriesEstado = [];
                this.datos_estado = response.data[5];

                this.bandera = 0;

                if( this.datos_estado == "" ){
                    for(let i = 0; i < 24; i++){
                        this.seriesEstado[i] = 0;
                    }
                }
                else{
                    for(let i = 0; i < 24; i++){

                        if( this.datos_estado[this.bandera].estado == this.estados[i] ){
                            this.seriesEstado[i] = parseInt( this.datos_estado[this.bandera].precio );
                            if( (this.datos_estado.length - 1) > this.bandera){
                                this.bandera++;
                            }
                        }
                        else {
                            this.seriesEstado[i] = 0;
                        }
                    }
                }
            },
        },

        mounted(){
            this.enviar();
        },
    }
</script>


