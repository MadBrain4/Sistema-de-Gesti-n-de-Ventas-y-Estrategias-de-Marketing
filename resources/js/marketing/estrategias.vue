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

                <v-toolbar-title><a href="/jetfilter/marketing">Jet-Filter</a></v-toolbar-title>
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
                <h2 class="titulo">Estrategias de Marketing</h2>
                <a href="/jetfilter/marketing/estrategias/nuevo"><v-btn style="postion: absolute;">Crear</v-btn></a>
            </v-tollbar>
        </div>

        <v-table style="overflow-x: scroll;">
            <thead>
            <tr>
                <th class="text-left">
                  Título
                </th>
                <th class="text-left">
                  Objetivos
                </th>
                <th class="text-left">
                  Inicio
                </th>
                <th class="text-left">
                  Final
                </th>
                <th class="text-left">
                  Fases
                </th>
                <th class="text-left">
                  Buyer Persona
                </th>
                <th class="text-left">
                  Responsable
                </th>
                <th class="text-left">
                  Recurso
                </th>
                <th class="text-left">
                  KPI
                </th>
                <th class="text-left">
                  Análisis
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="item in estrategias"
                :key="item.id"
            >
                <td>
                    <a style='color: #000;' :href="'/jetfilter/marketing/estrategias/edit/'+item.id" >
                        <v-btn variant="outlined">
                            {{ item.titulo }}
                        </v-btn>
                    </a>
                </td>
                <td>
                  {{ item.objetivo }}
                </td>
                <td>{{ item.fecha_inicio }}</td>
                <td>{{ item.fecha_final }}</td>
                <td>
                  <v-btn style="margin-left: 15%" icon="mdi-account" @click="mostrarFases(item.id)"></v-btn>
                </td>
                <td>{{ item.buyer_persona }}</td>
                <td><v-btn style="margin-left: 15%" icon="mdi-account" @click="mostrarResponsables(item.id)"></v-btn></td>
                <td><v-btn icon="mdi-folder-outline" @click="mostrarRecursos(item.id)"></v-btn></td>
                <td><v-btn icon="mdi-message-text" @click="mostrarkpi_method(item.id)"></v-btn></td>
                <td><v-btn icon="mdi-arrow-up-bold-box-outline" @click="mostrarAnalisis(item.id)"></v-btn></td>
            </tr>
            </tbody>
        </v-table>

        <v-dialog v-model="objetivosMostrar" width="auto">
          <v-card>
            <v-table>
              <thead>
                <tr>
                  <th style="text-align: center;">
                    Objetivos
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                    v-for="(objetivo, index) in objetivos"
                    :key="index"
                >
                  <td>{{ index + 1 }}) {{ objetivo }}</td>
                </tr>
              </tbody>
            </v-table>
            <v-btn @click="objetivosMostrar = false" color="red">
              Cerrar
            </v-btn>
          </v-card>
        </v-dialog>

        <v-dialog v-model="recursosMostrar" width="auto">
          <v-card>
            <v-table>
              <thead>
                <tr>
                  <th style="text-align: center;">
                    Recursos
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                    v-for="(recurso, index) in recursos"
                    :key="index"
                >
                  <td>{{ index + 1 }}) {{ recurso.recurso }} - Tipo:{{ recurso.tipo_recurso }}</td>
                </tr>
              </tbody>
            </v-table>
            <v-btn @click="recursosMostrar = false" color="red">
              Cerrar
            </v-btn>
          </v-card>
        </v-dialog>

        <v-dialog v-model="responsablesMostrar" width="auto">
          <v-card>
            <v-table>
              <thead>
                <tr>
                  <th style="text-align: center;">
                    Responsables
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                    v-for="(responsable, index) in responsables"
                    :key="index"
                >
                  <td>{{ index + 1 }}) {{ responsable.responsable }}</td>
                </tr>
              </tbody>
            </v-table>
            <v-btn @click="responsablesMostrar = false" color="red">
              Cerrar
            </v-btn>
          </v-card>
        </v-dialog>

        <v-dialog v-model="fasesMostrar" width="auto">
          <v-card>
            <v-table>
              <thead>
                <tr>
                  <th style="text-align: center;">
                    Fases
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                    v-for="(fase, index) in fases"
                    :key="index"
                >
                  <td>{{ fase.num_fase }}) {{ fase.fase }}</td>
                </tr>
              </tbody>
            </v-table>
            <v-btn @click="fasesMostrar = false" color="red">
              Cerrar
            </v-btn>
          </v-card>
        </v-dialog>

        <v-dialog v-model="mostrarKPI" style="width: 40em;" persistent>
            <v-card class="pa-3">
                <v-form @submit="actualizarKpi">
                    <v-text-field
                        v-model="form.kpi"
                        :rules='KPIReglas'
                        label="Descripción del KPI"
                        class="shrink"
                        append-inner-icon="mdi-help-circle-outline"
                        @click:append-inner="abrir()"
                    ></v-text-field>
                    <v-text-field
                        v-model="form.valor_referencia"
                        :rules='cantidadReglas'
                        label="Valor de Referencia"
                        class="shrink"
                        append-inner-icon="mdi-help-circle-outline"
                        @click:append-inner="abrir2()"
                    ></v-text-field>
                    <v-select
                        v-model="form.tipo_valor_referencia"
                        :items="tipo_cantidad_kpi"
                        name="tipo_valor_referencial"
                        label="Porcetaje o Valor Absoluto"
                        persistent-hint
                        return-object
                        single-line
                        style="margin-right: 1em;"
                        prepend-inner-icon="mdi-help-circle-outline"
                        @click:append-inner="abrir()"
                    ></v-select>
                    <v-text-field
                        v-model="form.valor_referencia_resultado"
                        :rules='cantidadReglas'
                        label="Resultado del Valor de Referencia"
                        class="shrink"
                        append-inner-icon="mdi-help-circle-outline"
                        @click:append-inner="abrir3()"
                    ></v-text-field>
                    <v-btn
                      type="submit"
                      :loading="loading"
                      @click="loading = !loading"
                    >
                      Guardar
                      <template v-slot:loader>
                        <v-progress-circular indeterminate></v-progress-circular>
                      </template>
                    </v-btn>
                    <v-btn @click="mostrarKPI = !mostrarKPI" color="red" class="ml-3" >Cerrar</v-btn>
                    <v-progress-linear class="mt-4" color="red-lighten-2" :model-value="lineal"></v-progress-linear>
                </v-form>
            </v-card>
        </v-dialog>

        <v-dialog v-model="mostrarAnalisisModel" persistent>
            <v-card class="pa-5">
                <v-form @submit="actualizarAnalisis">
                    <v-textarea label="Analisis" v-model="form_analisis.analisis" counter prepend-inner-icon="mdi-comment">
                        
                    </v-textarea>
                    <v-btn
                        type="submit"
                        :loading="loading"
                        @click="loading = !loading"
                    >
                        Guardar
                        <template v-slot:loader>
                        <v-progress-circular indeterminate></v-progress-circular>
                        </template>
                    </v-btn>
                    <v-btn @click="mostrarAnalisisModel = !mostrarAnalisisModel" color="red" class="ml-3" >Cerrar</v-btn>
                </v-form>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<style>
  .overflow {
    overflow: hidden !important; 
  }
</style>

<script>
  export default {
    data () {
      return {
        estrategias: '',
        objetivos: [],
        objetivosMostrar: false,
        recursos: [],
        recursosMostrar: false,
        responsables: [],
        responsablesMostrar: false,
        kpi: '',
        id_kpi: 0,
        id_analisis: 0,
        tipo_cantidad_kpi: ['Valor Absoluto', 'Porcentaje'],
        mostrarKPI: false,
        mostrarAnalisisModel: false,
        fasesMostrar: false,
        form_analisis: {
            analisis: '',
        },
        lineal: 0,
        loading: false,
        cantidadReglas: [
          v => !!v || 'La cantidad es Requerida',
          v => (!isNaN(parseFloat(v)) && v >= 0) || 'La cantidad debe ser mayor que 0'
        ],
        KPIReglas: [
          v => !!v || 'El KPI es Requerido',
        ],
        form: {
            kpi: '',
            valor_referencia: 0,
            valor_referencia_resultado: 0,
            tipo_valor_referencia: '',
        },
      }
    },

    methods: {
      abrir(){
        alert('Hola');
      },
      abrir2(){
        alert('Hola2');
      },
      abrir3(){
        alert('Hola2');
      },

      cargarDatos(){
        axios.post('/jetfilter/marketing/estrategias/datos')
          .then((response) => {
            this.estrategias = response.data;
          })
          .catch((error) => {
            console.log('error');
          });   
      },

      mostrarObjetivos(id){
        axios.post(`/jetfilter/marketing/estrategias/objetivos/${id}`)
          .then((response) => {
            this.objetivos = response.data;
            this.objetivosMostrar = true;
          })
          .catch((error) => {
            console.log('error');
          });  
      },

      mostrarRecursos(id){
        axios.post(`/jetfilter/marketing/estrategias/recursos/${id}`)
          .then((response) => {
            this.recursos = response.data;
            this.recursosMostrar = true;
          })
          .catch((error) => {
            console.log('error');
          });  
      },

      mostrarFases(id){
        axios.post(`/jetfilter/marketing/estrategias/fases/${id}`)
          .then((response) => {
            this.fases = response.data;
            this.fasesMostrar = true;
          })
          .catch((error) => {
            console.log(error);
          });  
      },

        mostrarkpi_method(id){
            this.id_kpi = id;
            axios.post(`/jetfilter/marketing/estrategias/kpi/${id}`)
            .then((response) => {
                console.log(response);
                this.form.kpi = response.data[0];
                this.form.valor_referencia = response.data[1];
                this.form.valor_referencia_resultado = response.data[2];
                this.form.tipo_valor_referencia = response.data[3];
                this.lineal = this.form.valor_referencia_resultado/ this.form.valor_referencia * 100;
                this.mostrarKPI = true;
            })
            .catch((error) => {
                console.log(error);
            }); 
        },

        mostrarResponsables(id){
            axios.post(`/jetfilter/marketing/estrategias/responsables/${id}`)
            .then((response) => {
                this.responsables = response.data;
                this.responsablesMostrar = true;
            })
            .catch((error) => {
                console.log('error');
            });  
        },

        actualizarKpi(e){
            if (!this.htmlSubmit) {
                e.preventDefault();
            }
            axios.post(`/jetfilter/marketing/estrategias/${this.id_kpi}/kpi/store`, this.form)
                .then((response) => {
                    this.mostrarKPI = false;
                    this.loading = false;
                    if(response.data == true){
                        Swal.fire({
                            icon: 'success',
                            title: `La información se ha actualizado`,
                            timer: 1250,
                        })
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        mostrarAnalisis(id){
            this.id_analisis = id,
            axios.post(`/jetfilter/marketing/estrategias/analisis/${id}`)
            .then((response) => {
                this.form_analisis.analisis = response.data[0];
                this.mostrarAnalisisModel = true;
            })
            .catch((error) => {
                console.log(error);
            });
        },

        actualizarAnalisis(e){
            if (!this.htmlSubmit) {
                e.preventDefault();
            }
            axios.post(`/jetfilter/marketing/estrategias/${this.id_analisis}/analisis/store`, this.form_analisis)
                .then((response) => {
                    this.mostrarAnalisisModel = false;
                    this.loading = false;
                    if(response.data == true){
                        Swal.fire({
                            icon: 'success',
                            title: `La información se ha actualizado`,
                            timer: 1250,
                        })
                    }
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },

    mounted() {
      this.cargarDatos();
    },
  }
</script>