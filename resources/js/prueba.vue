<template>
    <div>
        <h2>Grafica</h2>
        <form>
            <label for="fecha">Fecha: </label>
            <input type="radio" name="fecha" value="0" v-model="form.fecha" @click="diasPersonalizado()" id="fecha1">Personalizado<br>
            <input type="radio" name="fecha" value="1" v-model="form.fecha" @click="noDiasPersonalizado()" id="fecha2" >Ultimo Año<br>
            <input type="radio" name="fecha" value="2" v-model="form.fecha" @click="noDiasPersonalizado()" id="fecha3"> Ultimos 3 Años<br>
            <input type="radio" name="fecha" value="3" v-model="form.fecha" @click="noDiasPersonalizado()" id="fecha4"> Ultimos 5 Años<br>

            <div id="fechas" v-if="fechas_aparecer">
                <input type="date" v-model="form.fecha_minima" name="fecha_minimo" max="2023-03-05" min="2010-01-01" id="fecha_minimo"><br>
                <input type="date" v-model="form.fecha_maxima" name="fecha_maximo" max="2023-03-05" min="2010-01-01" id="fecha_maximo"><br>
            </div>

            <br>

            <label for="fecha_seleccion">Tiempo para Selección: </label>
            <input type="radio" name="fecha_seleccion" v-model="form.fecha_mostrar" value="0" checked>Meses<br>
            <input type="radio" name="fecha_seleccion" v-model="form.fecha_mostrar" value="1">Días<br>
            <input type="radio" name="fecha_seleccion" v-model="form.fecha_mostrar" value="2">Semanas<br>
            <input type="radio" name="fecha_seleccion" v-model="form.fecha_mostrar" value="3">Años<br>

            <select name="tipo_clientes" v-model="form.tipo_clientes" id="">
                <option value="0" >Todos</option>
                <option value="1" >Cliente</option>
                <option value="2">Distribuidoras</option>
            </select>

            <label for="precio_minimo">Precio Minimo: </label>
            <input type="range" name="precio_minimo" id="precio_minimo" min="0" max="99999" step="5" v-model="form.precio_minimo"> 
            {{ form.precio_minimo }}

            <label for="precio_maximo">Precio Maximo: </label>
            <input type="range" name="precio_maximo" id="precio_maximo" min="0" max="100000" step="5" v-model="form.precio_maximo"> 
            {{ form.precio_maximo }}

            <p v-if="comprobar_errores">
                {{ error_precios }}
            </p>


            <input type="button" @click="enviar()" value="Enviar">
        </form>

        <h2>Ventas con esas Caracteristicas</h2>
        <apexchart
            width="1200"
            type="area"
            :options = "options"
            :series = "series"
        ></apexchart>

        <h2>Porcentaje de las ventas totales que representas estas Ventas</h2>
        <apexchart
            width="1200"
            type="area"
            :options = "optionsPorcentajes"
            :series = "seriesPorcentajes"
        ></apexchart>

        <h2>Proyeccion de la Cantidad de Ventas</h2>
        <apexchart
            width="1200"
            type="area"
            :options = "optionsPrediccion"
            :series = "seriesPrediccion"
        ></apexchart>

        <h2>Top 5 Productos más Vendidos</h2>
        {{ ventas_con_parametros }}
        <br>
        {{ ventas_totales }}
        <br>
        {{ fecha_mostrar }}
    </div>
</template>

<script>
import * as tf from '@tensorflow/tfjs';

    export default {
        data () {
            return {
                fecha: [],
                ventas_con_parametros: '',
                fecha_mostrar: '',
                ventas_totales: '',
                resultado: [],
                
                prediccion1: [], 
                xaxisGrafica: [],
                xaxisPorcentaje: [],

                fechas_aparecer: false,
                error_precios: 'El precio minimo no puede ser mayor ni igual que el máximo',
                comprobar_errores: false,
                total_ventas: 0,
                bandera: 0,
                bandera2: 0,
                //Formulario a pasar
                form: {
                    tipo_clientes: 0,
                    precio_minimo: 50,
                    precio_maximo: 100,
                    fecha: 1,
                    fecha_minima: 0,
                    fecha_maxima: 0,
                    fecha_mostrar: 0,
                },
                //Options
                optionsPrediccion: {},
                optionsPorcentajes: {
                    xaxis: {
                        type: 'category',
                        tickPlacement: 'between',
                        categories: [],
                    },
                },
                options: {
                    xaxis: {
                        type: 'category',
                        tickPlacement: 'between',
                        categories: [],
                    },
                    fill: {
                        colors: ['#F44336', '#E91E63', '#9C27B0']
                    },
                    markers: {
                        colors: ['#F44336', '#E91E63', '#9C27B0']
                    },
                    grid: {
                        row: {
                            colors: ['#3078B4',]
                        },
                    }
                },
                //Graficas
                series: [
                    {
                        name: "Series A",
                        data: [],
                    },
                ],
                seriesPrediccion: [
                    {
                        name: "Series A",
                        data: [],
                    },
                ],
                seriesPorcentajes: [
                    {
                        name: "Series A",
                        data: [],
                    },
                ],
            }
        },

        methods: {
            enviar(){
                if(this.form.precio_maximo > this.form.precio_minimo){
                    axios.post('/jetfilter/marketing/graficas', this.form)
                        .then((response) => {
                            //Llenar las variavles de los datos
                            this.ventas_con_parametros = response.data[0];
                            this.fecha_mostrar = response.data[1];
                            this.ventas_totales = response.data[2];

                            this.series[0].data = [];
                            this.seriesPrediccion[0].data = [];
                            this.seriesPorcentajes[0].data = [];

                            this.xaxisGrafica = [];
                            this.xaxisPorcentaje = [];

                            //Llenar las graficas
                            for (var i = 0; i < this.ventas_con_parametros.length; i++) {
                                //Llenas las series de Grafica 1
                                this.series[0].data[i] =  parseInt(this.ventas_con_parametros[i].suma_precio);
                                //Dependiendo de la manera de mostrar los datos, se muestran los parametros
                                //Si es por mes
                                if( this.fecha_mostrar == 0){
                                    this.options.xaxis.categories[i] = this.ventas_con_parametros[i].month + '-' + this.ventas_con_parametros[i].year;
                                    this.optionsPorcentajes.xaxis.categories[i] = this.ventas_con_parametros[i].month + '-' + this.ventas_con_parametros[i].year;
                                }
                                //Si es por dia
                                if( this.fecha_mostrar == 1){
                                    this.options.xaxis.categories[i] = this.ventas_con_parametros[i].day + '-' + this.ventas_con_parametros[i].month + '-' + this.ventas_con_parametros[i].year;
                                    this.optionsPorcentajes.xaxis.categories[i] = this.ventas_con_parametros[i].day + '-' + this.ventas_con_parametros[i].month + '-' + this.ventas_con_parametros[i].year;
                                }
                                //Si es por semana
                                if( this.fecha_mostrar == 2){
                                    this.options.xaxis.categories[i] = 'Semana ' + this.ventas_con_parametros[i].week + " del " + this.ventas_con_parametros[i].year;
                                    this.optionsPorcentajes.xaxis.categories[i] = 'Semana ' + this.ventas_con_parametros[i].week + " del " + this.ventas_con_parametros[i].year;
                                }
                                //Si es por año
                                else if ( this.fecha_mostrar == 3 ){
                                    this.options.xaxis.categories[i] = this.ventas_con_parametros[i].year;
                                    this.optionsPorcentajes.xaxis.categories[i] = this.ventas_con_parametros[i].year;
                                }
                                //Llenamos los xaxis de las graficas
                                this.xaxisGrafica[i] = (i + 1);
                                this.xaxisPorcentaje[i] = (i + 1);
                                //Series Preccion
                                this.seriesPrediccion[0].data[i] = parseInt(this.ventas_con_parametros[i].suma_precio);
        
                            }
                            //Se llena la grafica de porcentaje y predicciones
                            this.bandera2 = 0;
                            for (var i = 0; i < this.ventas_totales.length; i++) {
                                if(this.fecha_mostrar == 0){

                                    if(this.ventas_con_parametros[this.bandera2].month == this.ventas_totales[i].month && this.ventas_con_parametros[this.bandera2].year == this.ventas_totales[i].year){
                                        this.seriesPorcentajes[0].data[i] = parseInt((parseInt(this.ventas_con_parametros[this.bandera2].suma_precio)/parseInt(this.ventas_totales[i].suma_precio)) * 100);
                                        
                                        this.optionsPorcentajes.xaxis.categories[i] = this.ventas_totales[i].month + '-' + this.ventas_totales[i].year;
                                        
                                        this.bandera2++;
                                    }
                                    else {
                                        this.seriesPorcentajes[0].data[i] = 0;

                                        this.optionsPorcentajes.xaxis.categories[i] = this.ventas_totales[i].month + '-' + this.ventas_totales[i].year;
                                    }

                                }
                                else if(this.fecha_mostrar == 1){

                                    if(this.ventas_con_parametros[this.bandera2].day == this.ventas_totales[i].day && this.ventas_con_parametros[this.bandera2].month == this.ventas_totales[i].month && this.ventas_con_parametros[this.bandera2].year == this.ventas_totales[i].year){
                                        this.seriesPorcentajes[0].data[i] = parseInt((parseInt(this.ventas_con_parametros[this.bandera2].suma_precio)/parseInt(this.ventas_totales[i].suma_precio)) * 100);
                                        
                                        this.optionsPorcentajes.xaxis.categories[i] = this.ventas_totales[i].day + '-' + this.ventas_totales[i].month + '-' + this.ventas_totales[i].year;
                                        
                                        this.bandera2++;
                                    }
                                    else {
                                        this.seriesPorcentajes[0].data[i] = 0;

                                        this.optionsPorcentajes.xaxis.categories[i] = this.ventas_totales[i].day + '-' + this.ventas_totales[i].month + '-' + this.ventas_totales[i].year;
                                    }

                                }
                            }

                            this.comprobar_errores = false;
                            this.prediccion(this.xaxisGrafica, this.seriesPrediccion[0].data, this.ventas_con_parametros.length);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
                else {
                    this.comprobar_errores = true;
                }
            },

            diasPersonalizado(){
                this.fechas_aparecer = true;
            },
            noDiasPersonalizado(){
                this.fechas_aparecer = false;
            },
            async prediccion(z1, z2, k){
                //async function learnLinear() {
                    for(let j = 0; j < 6; j++){
                        const model = tf.sequential();
                        model.add(tf.layers.dense({
                            units: 1,
                            inputShape: [1]
                        }));
                        model.compile({
                            loss: 'meanSquaredError',
                            optimizer: 'sgd',
                        });
                        // Creamos los tensores para x y para y
                        const xs = tf.tensor2d(z1, [k + j, 1]);
                        const ys = tf.tensor2d(z2, [k + j, 1]);
                        var epocas = 400;
                        // Obtenemos el valor de x
                        var nuevoValX = k + j;

                        for (let i = 0; i < epocas; i++) {
                            // Entrenamos el modelo una sola vez (pero como esta dentro de un ciclo se va ir entrenando por cada bucle)
                            await model.fit(xs, ys, {
                                epochs: 1
                            });
                            // Obtenemos el valor de Y cuando el valor de x sea
                            var prediccionY = model.predict(tf.tensor2d([nuevoValX], [1, 1])).dataSync()[0];
                            console.log(prediccionY);
                        }

                        z2[k + j] = parseInt(prediccionY);
                        z1[k + j] = k + j;
                }
            },
        }
    }


    
</script>