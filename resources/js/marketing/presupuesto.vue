<template>
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
            <h2 class="titulo">Presupuesto</h2>
        </v-tollbar>
    </div>


    <v-table>
        <thead>
            <tr>
                <th class="text-left">
                    Estrategias
                </th>
                <th class="text-left">
                    Presupuesto
                </th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="(item) in presupuesto"
                :key="item.name"
            >
                <td><a :href="'/jetfilter/marketing/presupuesto/edit/' + item.id"><v-btn color="green" >{{ item.titulo }}</v-btn></a></td>
                <td>{{ item.presupuesto }}</td>
            </tr>
        </tbody>
    </v-table>
</template>

<style>
    .verde {
        color: #7AC574;
    }

    .orange {
        color: #EF8F3F;
    }

    .azul {
        color: #4389F2;
    }

    .red {
        color: #FC594A;
    }

    .purpura {
        color: #B45AF4;
    }

    .gris {
        color: #A5A4A5;
    }

    .amarillo {
        color: #B0A52B;
    }
</style>

<script>
    export default {
        data () {
            return {
                dialog: false,
                presupuesto: "",
                presupuesto_precedencia: '',
                mostrar_presupuesto: '',
                pre: '',
                max: 5000,
            }
        },

        methods: {
            enviar(){
                axios.post('/jetfilter/marketing/presupuesto')
                    .then((response) => {
                        this.presupuesto = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            agregarTarea(){
                alert(this.form.presupuesto);
            },

            cambiarProcedencia(id){
                this.form.procedencia = id;
            }
        },


        mounted(){
            this.enviar();
        },

    }
</script>