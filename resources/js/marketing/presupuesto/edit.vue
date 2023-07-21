<template>
    <v-app>
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
            <v-toolbar>
                <h2 style="color: #000; text-align: center; width: 100%; ">{{ titulo_estrategia }}</h2>
                <p style="margin-right: 2em;" >Presupuesto de Estrategia: {{ presupuesto_total }}$</p>
                <v-btn
                    color="green-lighten-1"
                    variant="flat"
                    @click="cambiarProcedencia(0)"  
                >
                    Crear
                </v-btn>
            </v-toolbar>
        </div>

        <v-table>
            <thead>
                <tr>
                    <th class="text-left">
                        Actividad / Tarea
                    </th>
                    <th class="text-left">
                        Presupuesto
                    </th>
                    <th class="text-left">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody v-for="(item, index) in tareas" :key="index">
                <tr v-if="item.nivel == 0">
                    <td>
                        <h3 style="color: #3C5589;">
                            <v-btn @click="[dialog = !dialog, cambiarProcedencia(item.id)]" density="compact" icon="mdi-plus" class="ma-1">
                            </v-btn>
                            {{ item.tarea }}
                        </h3>
                        <v-divider></v-divider>
                    </td> 
                    <td>
                        <h3>
                            {{ item.valor }}$
                        </h3>
                        <v-divider></v-divider>
                    </td>
                    <td>
                        <v-btn
                            icon="mdi-delete-outline"
                            color="red"
                            @click="[seguro_eliminar = true, id_tarea = item.id]"
                        >
                        </v-btn>
                    </td>
                </tr>
                
                <tr v-else-if="item.nivel == 1">
                    <td>
                        <h3 style="margin-left: 2em;">
                            <v-btn @click="[dialog = !dialog, cambiarProcedencia(item.id)]" density="compact" icon="mdi-plus" class="ma-1">
                            </v-btn>
                            {{ item.tarea }}
                        </h3>
                        <v-divider></v-divider>
                    </td> 
                    <td>
                        <h3>
                            {{ item.valor }}$
                        </h3>
                        <v-divider></v-divider>
                    </td>
                    <td>
                        <v-btn
                            icon="mdi-delete-outline"
                            color="red"
                            @click="[seguro_eliminar = true, id_tarea = item.id]"
                        >
                        </v-btn>
                    </td>
                </tr>

                <tr v-else-if="item.nivel == 2">
                    <td>
                        <h3 style="margin-left: 4em;">
                            <v-btn @click="[dialog = !dialog, cambiarProcedencia(item.id)]" density="compact" icon="mdi-plus" class="ma-1">
                            </v-btn>
                            {{ item.tarea }}
                        </h3>
                        <v-divider></v-divider>
                    </td> 
                    <td>
                        <h3>
                            {{ item.valor }}$
                        </h3>
                        <v-divider></v-divider>
                    </td>
                    <td>
                        <v-btn
                            icon="mdi-delete-outline"
                            color="red"
                            @click="[seguro_eliminar = true, id_tarea = item.id]"
                        >
                        </v-btn>
                    </td>
                </tr>

                <tr v-else-if="item.nivel == 3">
                    <td>
                        <h3 style="margin-left: 6em;">
                            <v-btn @click="[dialog = !dialog, cambiarProcedencia(item.id)]" density="compact" icon="mdi-plus" class="ma-1">
                            </v-btn>
                            {{ item.tarea }}
                        </h3>
                        <v-divider></v-divider>
                    </td> 
                    <td>
                        <h3>
                            {{ item.valor }}$
                        </h3>
                        <v-divider></v-divider>
                    </td>
                    <td>
                        <v-btn
                            icon="mdi-delete-outline"
                            color="red"
                            @click="[seguro_eliminar = true, id_tarea = item.id]"
                        >
                        </v-btn>
                    </td>
                </tr>

                <tr v-else-if="item.nivel == 4">
                    <td>
                        <h3 style="margin-left: 8em;"> 
                            <v-btn @click="[dialog = !dialog, cambiarProcedencia(item.id)]" density="compact" icon="mdi-plus" class="ma-1">
                            </v-btn>
                            {{ item.tarea }}
                        </h3>
                        <v-divider></v-divider>
                    </td> 
                    <td>
                        <h3>
                            {{ item.valor }}$
                        </h3>
                        <v-divider></v-divider>
                    </td>
                    <td>
                        <v-btn
                            icon="mdi-delete-outline"
                            color="red"
                            @click="[seguro_eliminar = true, id_tarea = item.id]"
                        >
                        </v-btn>
                    </td>
                </tr>

                <tr v-else-if="item.nivel == 5">
                    <td>
                        <h3 style="margin-left: 10em;">
                            <v-btn @click="[dialog = !dialog, cambiarProcedencia(item.id)]" density="compact" icon="mdi-plus" class="ma-1">
                            </v-btn>
                            {{ item.tarea }}
                        </h3>
                        <v-divider></v-divider>
                    </td> 
                    <td>
                        <h3>
                            {{ item.valor }}$
                        </h3>
                        <v-divider></v-divider>
                    </td>
                    <td>
                        <v-btn
                            icon="mdi-delete-outline"
                            color="red"
                            @click="[seguro_eliminar = true, id_tarea = item.id]"
                        >
                        </v-btn>
                    </td>
                </tr>

                <tr v-else>
                    <td style="color: #3B3B3B; margin-left: 12em;">
                        <h3 style="margin-left: 12em;">
                            <v-btn @click="[dialog = !dialog, cambiarProcedencia(item.id)]" density="compact" icon="mdi-plus" class="ma-1">
                            </v-btn>
                            {{ item.tarea }}
                        </h3>
                        <v-divider></v-divider>
                    </td> 
                    <td>
                        <h3>
                            {{ item.valor }}$
                        </h3>
                        <v-divider></v-divider>
                    </td>
                    <td>
                        <v-btn
                            icon="mdi-delete-outline"
                            color="red"
                            @click="[seguro_eliminar = true, id_tarea = item.id]"
                        >
                        </v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <v-dialog
            v-model="form_crear"
            persistent
            width="1024"
        >
            <v-card>
                <v-form 
                    action="/jetfilter/marketing/actividades/store" 
                    method="POST"
                    id="form-tarea"
                >
                    <v-row>
                        <v-col
                            cols="6"
                        >
                            <v-text-field 
                                class="ma-5"
                                :rules="TareaReglas" 
                                placeholder="Tarea"
                                v-model="form.tarea"
                                name="tarea"
                            >
                            </v-text-field>
                        </v-col>
                        <input type="hidden" v-model="form.padre_id_creado" name="id_padre" />
                        <input type="hidden" v-model="id_estrategia" name="id_estrategia" />
                        <v-col
                            cols="6"
                        >
                            <v-text-field 
                                class="ma-5"
                                :rules="valorReglas"
                                placeholder="Presupuesto de la Tarea"
                                v-model="form.valor"
                                type="number"
                                name="presupuesto"
                            >
        
                            </v-text-field>
                        </v-col>
                    </v-row>
                </v-form>

                <v-card-actions>
                    <v-btn @click="submit" color="success">
                        Enviar
                    </v-btn>
                    <v-btn color="primary" @click="form_crear = false">Cerrar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog
            v-model="alerta"
            width="auto"
            >
            <v-card>
                <v-card-text>
                    {{ mensaje }}
                </v-card-text>
                <v-card-actions>
                <v-btn color="primary" block @click="alerta = false">Cerrar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog
            v-model="seguro_eliminar"
            width="auto"
            >
            <v-card>
                <v-card-text>
                    ¿Desea eliminarlo?
                </v-card-text>
                <v-card-actions>
                    <v-form
                        :action="'/jetfilter/marketing/actividades/delete/' + this.id_estrategia + '/' + this.id_tarea"
                        method="POST"
                        id="tarea-eliminar"
                    >
                        <v-btn
                            @click="eliminar()"
                        >
                            Confirmar
                        </v-btn>
                    </v-form>
                </v-card-actions>
            </v-card>
        </v-dialog>


    </v-app>
</template>

<script>
    export default {
        data () {
            return {
                TareaReglas: [
                    v => !!v || 'La Tarea es Requerida',
                ],
                valorReglas: [
                    v => !!v || 'El Presupuesto es Requerido',
                    v => (!isNaN(parseFloat(v)) && v >= 0) || 'La cantidad debe ser mayor o igual a 0',
                ],
                id_estrategia: '',
                id_tarea: 0,
                titulo_estrategia: '',
                presupuesto_total: 0,
                tareas: '',
                form_crear: false,
                seguro_eliminar: false,
                alerta: false,
                mensaje: '',
                form: {
                    padre_id_creado: 0,
                    tarea: '',
                    valor: '',
                }
            }
        },
        methods: {
            cargarDatos(){
                let actual = location.href;
                this.url = actual;
                axios.post(actual)
                    .then((response) => {
                        this.id_estrategia = response.data.id;
                        this.titulo_estrategia = response.data.titulo;
                        this.presupuesto_total = response.data.presupuesto;

                        axios.post('/jetfilter/marketing/actividades/tarea/' + this.id_estrategia)
                            .then((response) => {
                                this.tareas = response.data
                            });
                    });
            },

            cambiarProcedencia(id){
                this.form.padre_id_creado = id;
                this.form_crear = true;
            },

            eliminar(){
                let tarea_eliminar = document.getElementById('tarea-eliminar');
                tarea_eliminar.submit();
            },

            submit(){
                if( this.form.tarea == null || this.form.tarea == '' ){
                    this.mensaje = 'La tarea no puede estar vacia';
                    this.alerta = true;
                }
                else if( this.form.valor == null || this.form.valor == '' ){
                    this.mensaje = 'El presupuesto no puede estar vacio';
                    this.alerta = true;
                }
                else if( this.form.valor < 0 || isNaN(parseFloat(this.form.valor)) ){
                    this.mensaje = 'El presupuesto tiene que ser mayor o igual a 0';
                    this.alerta = true;
                }
                else{
                    let form_tarea = document.getElementById('form-tarea');
                    form_tarea.submit();
                }
            }
        },
        mounted(){
            this.cargarDatos();
        },
    }
</script>