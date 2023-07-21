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
                <h2 class="titulo">Editar Estrategia de Marketing</h2>
            </v-tollbar>
        </div>

        <div class="mb-4" style="width: 100%; display:grid; 	justify-items: center; grid-template-columns: repeat(6, 16.66%); grid-template-rows: repeat(12, 3em);">
            <h2 style="text-align: center; color: black; grid-column: 1 / 7; grid-row: 1 / 2;">{{ estrategia.titulo }}</h2>
            <v-progress-circular
                style="grid-column: 1 / 4; grid-row: 2 / 4;"
                :rotate="360"
                :size="150"
                :width="25"
                :model-value="form.resultado / form.cantidad_kpi * 100"
                color="teal"
                class="mt-3"
            >
                <h2>{{ form.resultado / form.cantidad_kpi * 100 }}%</h2>
            </v-progress-circular>
            <v-card
                style="grid-column: 4 / 7; grid-row: 2 / 5;"
            >
                <h2 class="mx-5 my-3">Valor de Referencia: {{ form.cantidad_kpi }}</h2>
                <h2 class="mx-5 my-3" v-if="form.resultado != null">Resultado: {{ form.resultado }}</h2>
                <h2 class="mx-5 my-3" v-else >Resultado: 0</h2>
                <h3 v-if="form.resultado >= form.cantidad_kpi" class="mx-5 my-3">
                    Objetivo Logrado
                </h3>
                <h3 v-else class="mx-5 my-3">
                    Faltan {{ form.cantidad_kpi - form.resultado }}
                    para llegar al objetivo
                </h3>
            </v-card>
            <v-card>

            </v-card>
            <v-form 
                @submit.prevent="submit"
                style="grid-column: 1 / 7; grid-row: 6 / 12; margin-left: 4em; margin-right: 5em; width: 70%"
                method="POST" 
                id="formulario"
                :action="'/jetfilter/marketing/estrategias/update/' + estrategia.id" 
                class="my-2"
            >
                <v-textarea
                    style="grid-column: 1 / 7; grid-row: 6 / 8;"
                    variant="filled"
                    label="Descripción de la Estrategia"
                    name="descripcion_estrategia"
                    :rules="buyerPersonaReglas"
                    auto-grow
                    v-model="form.descripcion_estrategia"
                ></v-textarea>
                <div 
                    style="grid-column: 1 / 7; grid-row: 9 / 9;"
                    class="mt-5"
                >
                    <v-text-field 
                        v-model="form.objetivo"
                        :rules="ObjetivoReglas"
                        label="Objetivos"
                        name="objetivos"
                    ></v-text-field>
                </div>
                <div class="mb-3" style="display: grid; grid-template-columns: repeat(2, 50%);">
                    <h3 style="text-align: center;">Fecha Inicio de Estrategia</h3>
                    <h3 style="text-align: center;">Fecha Final de Estrategia</h3>
                    <input type="date" name="fecha_inicio" required v-model="form.fecha_inicio" style="width: 100%; border: 2px solid #000" class="mr-2">
                    <input type="date" name="fecha_final" required v-model="form.fecha_final" style="width: 100%; border: 2px solid #000" class="ml-2">
                </div>

                <h2 style="grid-column: 1 / 11; text-align: center;" >Fases</h2>
                <div class="mx-2 px-16 mb-5 pt-3" 
                    style="width: 100%; border: 2px solid #000"
                    v-for="n in cantidad_fases"
                    :key="n"
                >
                    <div v-if="n == 1" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.primera_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.primera_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.primera_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.primera_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 2" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.segunda_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.segunda_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.segunda_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.segunda_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 3" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.tercera_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.tercera_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.tercera_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.tercera_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 4" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.cuarta_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.cuarta_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.cuarta_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.cuarta_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 5" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.quinta_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.quinta_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.quinta_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.quinta_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 6" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.sexta_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.sexta_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.sexta_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.sexta_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 7" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.septima_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.septima_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.septima_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.septima_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 8" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.octava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.octava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.octava_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.octava_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 9" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.novena_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.novena_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.novena_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.novena_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 10" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.decima_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.decima_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.decima_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.decima_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 11" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.onceava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.onceava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.once_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.once_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 12" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.doceava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.doceava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.doce_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.doce_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 13" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.treceava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.treceava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.trece_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.trece_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 14" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.catorceava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.catorceava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.catorce_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.catorce_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 15" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.quinceava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.quince_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.quince_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.quince_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 16" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.dieciseisava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.dieciseisava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.dieciseis_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.dieciseis_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 17" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.diecisieteava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.diecisieteava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.diecisiete_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.diecisiete_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 18" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.dieciochoava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.dieciochoava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.dieciocho_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.dieciocho_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 19" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.diecinueveava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.diecinueveava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.diecinueve_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.diecinueve.fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                    <div v-if="n == 20" class="mb-3" style="display: grid; grid-template-columns: repeat(10, 10%);">
                        <input type="hidden" v-model="form.fases.veinteava_fase_id" name="fases_id[]" />
                        <h3 style="grid-column: 1 / 11; text-align: center;" >Fase {{ n }}</h3>
                        <v-text-field 
                            v-model="form.fases.veinteava_fase"
                            :rules="fasesReglas"
                            :label="'Fase ' + n"
                            name="fase[]"
                            style="grid-column: 1 / 10;"
                        ></v-text-field>
                        <div style="display: flex;"> 
                            <v-btn icon="mdi-plus" class="ml-3" @click="aumentarFases()"></v-btn> 
                        </div>       
                        <h3 style="text-align: center; grid-column: 1 / 6;">Fecha Inicio de Fase</h3>
                        <h3 style="text-align: center; grid-column: 6 / 11;">Fecha Final de Fase</h3> 
                        <input type="date" name="fases_fecha_inicio[]" required v-model="form.fases.veinte_fecha_inicio" style="width: 100%; border: 2px solid #000; grid-column: 1 / 6;" class="mr-2">
                        <input type="date" name="fases_fecha_final[]" required v-model="form.fases.veinte_fecha_final" style="width: 100%; border: 2px solid #000; grid-column: 6 / 11;" class="ml-2" >
                    </div>
                </div>

                <h2 style="text-align: center;" >Buyer Persona</h2>
                <div 
                    style="border: 2px solid #000" 
                    class="pa-3 my-3"
                >
                    <v-textarea
                        variant="filled"
                        label="Buyer Persona"
                        name="buyerPersona"
                        :rules="buyerPersonaReglas"
                        auto-grow
                        v-model="form.buyer_persona.descripcion"
                    ></v-textarea>
                    <h3 style="text-align: center;" >Datos Demográficos</h3>
                    <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                        <div class="w-25 mx-2"
                            v-for="n in cantidad_demograficos"
                            :key="n"
                        >
                        <input v-if="n == 1" type="hidden" v-model="form.buyer_persona.demograficos.primer_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 1"
                                v-model="form.buyer_persona.demograficos.primer_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 2" type="hidden" v-model="form.buyer_persona.demograficos.segundo_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 2"
                                v-model="form.buyer_persona.demograficos.segundo_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 3" type="hidden" v-model="form.buyer_persona.demograficos.tercer_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 3"
                                v-model="form.buyer_persona.demograficos.tercer_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 4" type="hidden" v-model="form.buyer_persona.demograficos.cuarto_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 4"
                                v-model="form.buyer_persona.demograficos.cuarto_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 5" type="hidden" v-model="form.buyer_persona.demograficos.quinto_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 5"
                                v-model="form.buyer_persona.demograficos.quinto_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 6" type="hidden" v-model="form.buyer_persona.demograficos.sexto_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 6"
                                v-model="form.buyer_persona.demograficos.sexto_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 7" type="hidden" v-model="form.buyer_persona.demograficos.septimo_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 7"
                                v-model="form.buyer_persona.demograficos.septimo_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 8" type="hidden" v-model="form.buyer_persona.demograficos.octavo_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 8"
                                v-model="form.buyer_persona.demograficos.octavo_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 9" type="hidden" v-model="form.buyer_persona.demograficos.noveno_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 9"
                                v-model="form.buyer_persona.demograficos.noveno_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="responsable[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 10" type="hidden" v-model="form.buyer_persona.demograficos.decimo_demografico_id" name="demografico_id[]" />
                            <v-combobox
                                v-if="n == 10"
                                v-model="form.buyer_persona.demograficos.decimo_demografico"
                                label="Demográfico"
                                :loading="loading"
                                name="demografico[]"
                                class="shrink"
                            ></v-combobox>
                        </div>
                        <v-btn icon="mdi-plus" class="ml-3" @click="aumentarDemografico()"></v-btn>
                    </div>
                    <h3 style="text-align: center;" >Datos Psicológicos</h3>
                    <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                        <div class="w-25 mx-2"
                            v-for="n in cantidad_psicologicos"
                            :key="n"
                        >
                        <input v-if="n == 1" type="hidden" v-model="form.buyer_persona.psicologicos.primer_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 1"
                                v-model="form.buyer_persona.psicologicos.primer_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 2" type="hidden" v-model="form.buyer_persona.psicologicos.segundo_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 2"
                                v-model="form.buyer_persona.psicologicos.segundo_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 3" type="hidden" v-model="form.buyer_persona.psicologicos.tercer_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 3"
                                v-model="form.buyer_persona.psicologicos.tercer_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 4" type="hidden" v-model="form.buyer_persona.psicologicos.cuarto_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 4"
                                v-model="form.buyer_persona.psicologicos.cuarto_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 5" type="hidden" v-model="form.buyer_persona.psicologicos.quinto_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 5"
                                v-model="form.buyer_persona.psicologicos.quinto_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 6" type="hidden" v-model="form.buyer_persona.psicologicos.sexto_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 6"
                                v-model="form.buyer_persona.psicologicos.sexto_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 7" type="hidden" v-model="form.buyer_persona.psicologicos.septimo_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 7"
                                v-model="form.buyer_persona.psicologicos.septimo_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 8" type="hidden" v-model="form.buyer_persona.psicologicos.octavo_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 8"
                                v-model="form.buyer_persona.psicologicos.octavo_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 9" type="hidden" v-model="form.buyer_persona.psicologicos.noveno_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 9"
                                v-model="form.buyer_persona.psicologicos.noveno_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="psicologico[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 10" type="hidden" v-model="form.buyer_persona.psicologicos.decimo_psicologico_id" name="psicologico_id[]" />
                            <v-combobox
                                v-if="n == 10"
                                v-model="form.buyer_persona.psicologicos.decimo_psicologico"
                                label="Psicológico"
                                :loading="loading"
                                name="responsable[]"
                                class="shrink"
                            ></v-combobox>
                        </div>
                        <v-btn icon="mdi-plus" class="ml-3" @click="aumentarPsicologico()"></v-btn>
                    </div>
                    <h3 style="text-align: center;" >Metas del Cliente</h3>
                    <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                        <div class="w-25 mx-2"
                            v-for="n in cantidad_metas"
                            :key="n"
                        >
                        <input v-if="n == 1" type="hidden" v-model="form.buyer_persona.metas.primera_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 1"
                                v-model="form.buyer_persona.metas.primera_meta"
                                label="Meta"
                                :loading="loading"
                                name="meta[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 2" type="hidden" v-model="form.buyer_persona.metas.segunda_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 2"
                                v-model="form.buyer_persona.metas.segunda_meta"
                                label="Meta"
                                :loading="loading"
                                name="meta[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 3" type="hidden" v-model="form.buyer_persona.metas.tercera_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 3"
                                v-model="form.buyer_persona.metas.tercera_meta"
                                label="Meta"
                                :loading="loading"
                                name="meta[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 4" type="hidden" v-model="form.buyer_persona.metas.cuarta_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 4"
                                v-model="form.buyer_persona.metas.cuarta_meta"
                                label="Meta"
                                :loading="loading"
                                name="responsable[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 5" type="hidden" v-model="form.buyer_persona.metas.quinta_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 5"
                                v-model="form.buyer_persona.metas.quinta_meta"
                                label="Meta"
                                :loading="loading"
                                name="meta[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 6" type="hidden" v-model="form.buyer_persona.metas.sexta_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 6"
                                v-model="form.buyer_persona.metas.sexta_meta"
                                label="Meta"
                                :loading="loading"
                                name="meta[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 7" type="hidden" v-model="form.buyer_persona.metas.septima_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 7"
                                v-model="form.buyer_persona.metas.septima_meta"
                                label="Meta"
                                :loading="loading"
                                name="meta[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 8" type="hidden" v-model="form.buyer_persona.metas.octava_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 8"
                                v-model="form.buyer_persona.metas.octava_meta"
                                label="Meta"
                                :loading="loading"
                                name="responsable[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 9" type="hidden" v-model="form.buyer_persona.metas.novena_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 9"
                                v-model="form.buyer_persona.metas.novena_meta"
                                label="Meta"
                                :loading="loading"
                                name="meta[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 10" type="hidden" v-model="form.buyer_persona.metas.decima_meta_id" name="meta_id[]" />
                            <v-combobox
                                v-if="n == 10"
                                v-model="form.buyer_persona.metas.decima_meta"
                                label="Meta"
                                :loading="loading"
                                name="meta[]"
                                class="shrink"
                            ></v-combobox>
                        </div>
                        <v-btn icon="mdi-plus" class="ml-3" @click="aumentarMetas()"></v-btn>
                    </div>
                    <h3 style="text-align: center;" >Miedos del Cliente</h3>
                    <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                        <div class="w-25 mx-2"
                            v-for="n in cantidad_miedos"
                            :key="n"
                        >
                            <input v-if="n == 1" type="hidden" v-model="form.buyer_persona.miedos.primer_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 1"
                                v-model="form.buyer_persona.miedos.primer_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 2" type="hidden" v-model="form.buyer_persona.miedos.segundo_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 2"
                                v-model="form.buyer_persona.miedos.segundo_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 3" type="hidden" v-model="form.buyer_persona.miedos.tercer_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 3"
                                v-model="form.buyer_persona.miedos.tercer_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 4" type="hidden" v-model="form.buyer_persona.miedos.cuarto_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 4"
                                v-model="form.buyer_persona.miedos.cuarto_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 5" type="hidden" v-model="form.buyer_persona.miedos.quinto_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 5"
                                v-model="form.buyer_persona.miedos.quinto_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 6" type="hidden" v-model="form.buyer_persona.miedos.sexto_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 6"
                                v-model="form.buyer_persona.miedos.sexto_resp"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 7" type="hidden" v-model="form.buyer_persona.miedos.septimo_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 7"
                                v-model="form.buyer_persona.miedos.septimo_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 8" type="hidden" v-model="form.buyer_persona.miedos.octavo_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 8"
                                v-model="form.buyer_persona.miedos.octavo_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 9" type="hidden" v-model="form.buyer_persona.miedos.noveno_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 9"
                                v-model="form.buyer_persona.miedos.noveno_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                            <input v-if="n == 10" type="hidden" v-model="form.buyer_persona.miedos.decimo_miedo_id" name="miedo_id[]" />
                            <v-combobox
                                v-if="n == 10"
                                v-model="form.buyer_persona.miedos.decimo_miedo"
                                label="Miedo"
                                :loading="loading"
                                name="miedo[]"
                                class="shrink"
                            ></v-combobox>
                        </div>
                        <v-btn icon="mdi-plus" class="ml-3" @click="aumentarMiedos()"></v-btn>
                    </div>
                </div>

                <h2 style="text-align: center;" >Responsables de la Estrategia</h2>
                <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                    <div class="w-25 mx-2"
                        v-for="n in cantidad_responsables"
                        :key="n"
                    >
                    <input v-if="n == 1" type="hidden" v-model="form.responsables.primer_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 1"
                            v-model="form.responsables.primer_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 2" type="hidden" v-model="form.responsables.segundo_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 2"
                            v-model="form.responsables.segundo_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 3" type="hidden" v-model="form.responsables.tercer_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 3"
                            v-model="form.responsables.tercer_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 4" type="hidden" v-model="form.responsables.cuarto_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 4"
                            v-model="form.responsables.cuarto_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 5" type="hidden" v-model="form.responsables.quinto_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 5"
                            v-model="form.responsables.quinto_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 6" type="hidden" v-model="form.responsables.sexto_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 6"
                            v-model="form.responsables.sexto_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 7" type="hidden" v-model="form.responsables.septimo_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 7"
                            v-model="form.responsables.septimo_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 8" type="hidden" v-model="form.responsables.octavo_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 8"
                            v-model="form.responsables.octavo_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 9" type="hidden" v-model="form.responsables.noveno_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 9"
                            v-model="form.responsables.noveno_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <input v-if="n == 10" type="hidden" v-model="form.responsables.decimo_resp_id" name="responsable_id[]" />
                        <v-combobox
                            v-if="n == 10"
                            v-model="form.responsables.decimo_resp"
                            label="Responsable"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                    </div>
                    <v-btn icon="mdi-plus" class="ml-3" @click="aumentarResponsables()"></v-btn>
                </div>

                <h2 style="text-align: center;" >Recursos de la Estrategia</h2>
                <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                    <div class="mx-2" 
                        style="width: 90%;"
                        v-for="n in cantidad_recursos"
                        :key="n"
                    >
                        <div v-if="n == 1" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.primer_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.primer_recurso"
                                :rules="RecursoReglas"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.primer_tipo_recurso"
                                :items="tipos_recursos"
                                :rules="tiposRecursosReglas"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 2" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.segundo_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.segundo_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.segundo_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 3" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.tercer_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.tercer_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.tercer_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 4" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.cuarto_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.cuarto_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.cuarto_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 5" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.quinto_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.quinto_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.quinto_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 6" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.sexto_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.sexto_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.sexto_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 7" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.septimo_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.septimo_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.septimo_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 8" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.octavo_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.octavo_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.octavo_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 9" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.noveno_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.noveno_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.noveno_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                        <div v-if="n == 10" style="display: flex;">
                            <input type="hidden" v-model="form.recursos.decimo_recurso_id" name="recurso_id[]" />
                            <v-combobox
                                v-model="form.recursos.decimo_recurso"
                                label="Recurso"
                                name="recurso[]"
                                class="shrink"
                                style="margin-right: 1.5em;"
                            ></v-combobox>
                            <v-select
                                v-model="form.recursos.decimo_tipo_recurso"
                                :items="tipos_recursos"
                                name="tipo_recurso[]"
                                label="Tipo de Recurso"
                                persistent-hint
                                return-object
                                single-line
                                style="margin-right: 1em;"
                            ></v-select>
                        </div>
                    </div>
                    <v-btn icon="mdi-plus" class="ml-3" @click="aumentarRecursos()"></v-btn>
                </div>

                <h2 style="text-align: center;" >Presupuesto de la Estrategia</h2>
                <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                        <v-text-field
                            v-model="form.presupuesto"
                            label="Presupuesto ($)"
                            :rules="presupuestoReglas"
                            name="presupuesto"
                            class="shrink"
                        ></v-text-field>
                    </div>

                <h2 style="text-align: center;" >Descripción del KPI</h2>
                <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                    <div class="mx-2"
                        style="display: flex; width: 100%;"
                    >
                        <v-text-field
                            v-model="form.cantidad_kpi"
                            :rules='cantidadReglas'
                            label="Ganancia Esperada ($)"
                            name="valor_referencial"
                            class="shrink"
                            append-inner-icon="mdi-help-circle-outline"
                            @click:append-inner="abrir2()"
                            style="margin-right: 1em;"
                        ></v-text-field>
                        <v-select
                            v-model="form.frecuencia_kpi"
                            :items="frecuencia_kpi"
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
                            v-model="form.kpi"
                            :rules='KPIReglas'
                            label="Descripción o Nombre del KPI"
                            class="shrink"
                            name="kpi"
                            append-inner-icon="mdi-help-circle-outline"
                            @click:append-inner="abrir()"
                        ></v-text-field>
                    </div>
                </div>

                <h2 style="text-align: center;" >Resultado de la Estrategia</h2>
                <v-text-field
                        v-model="form.resultado"
                        label="Resultado en función del KPI"
                        class="shrink"
                        name="resultado"
                    ></v-text-field>

                <h2 style="text-align: center;" >Análisis del Resultado</h2>
                    <v-text-field
                        v-model="form.analisis"
                        label="Análisis del KPI"
                        class="shrink"
                        name="analisis"
                    ></v-text-field>
                <v-btn type="submit" block class="mx-2 mb-4" color="success" style="color: #fff;">Guardar Estrategia</v-btn>
            </v-form>
        </div>

        <v-dialog
            v-model="alerta_superada"
            width="auto"
            >
            <v-card>
                <v-card-text>
                    No puede superar el limite
                </v-card-text>
                <v-card-actions>
                <v-btn color="primary" block @click="alerta_superada = false">Cerrar</v-btn>
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
    </v-app>
</template>

<script>
    export default {
        data () {
            return {
                descripcionReglas: [
                    v => !!v || 'La descripción es Requerida',
                    v => (v && v.length >= 8) || 'La descripción debe tener al menos 8 caracteres',
                    v => (v && v.length <= 600) || 'La descripción debe tener menos de 600 caracteres',
                ],
                buyerPersonaReglas: [
                    v => !!v || 'El campo Buyer Persona es Requerido',
                    v => (v && v.length >= 8) || 'La campo Buyer Persona debe tener al menos 8 caracteres',
                    v => (v && v.length <= 200) || 'La campo Buyer Persona debe tener menos de 200 caracteres',
                ],
                RecursoReglas: [
                    v => !!v || 'Se necesita al menos un recurso',
                ],
                ResponsableReglas: [
                    v => !!v || 'Se necesita al menos un responsable',
                ],
                fasesReglas: [
                    v => !!v || 'Al menos una fase es requerida',
                ],
                ObjetivoReglas: [
                    v => !!v || 'El objetivo es requerido',
                    v => (v && v.length >= 8) || 'La descripción debe tener al menos 8 caracteres',
                    v => (v && v.length <= 200) || 'La descripción debe tener menos de 200 caracteres',
                ],
                cantidadReglas: [
                    v => !!v || 'La cantidad es Requerida',
                    v => (!isNaN(parseFloat(v)) && v >= 0) || 'La cantidad debe ser mayor que 0'
                ],
                presupuestoReglas: [
                    v => !!v || 'El Presupuesto es Requerido',
                    v => (!isNaN(parseFloat(v)) && v >= 0) || 'La cantidad debe ser mayor o igual a 0',
                ],
                KPIReglas: [
                    v => !!v || 'El KPI es Requerido',
                ],
                tiposRecursosReglas: [
                    v => ( v == 'Humanos' || v == 'Técnicos' ) || 'Seleccione el tipo de recurso',
                ],
                url: '',
                estrategia: '',
                loading: false,
                value: 0,
                id_kpi: 0,
                cantidad_responsables: 1,
                cantidad_recursos: 1,
                cantidad_fases: 1,
                cantidad_demograficos: 1,
                cantidad_psicologicos: 1,
                cantidad_miedos: 1,
                cantidad_metas: 1,
                response_recurso: '',
                alerta_superada: false,
                alerta: false,
                tipos_recursos: ['Humanos', 'Técnicos'],
                frecuencia_kpi: ['Una Vez', 'Diario', 'Semanal', 'Mensual', 'Trimestral', 'Cuatrimestral', 'Semestral', 'Anual'],
                form: {
                    titulo: '',
                    fecha_inicio: null,
                    fecha_final: null,
                    descripcion_estrategia: '',
                    buyer_persona: {
                        descripcion: '',
                        demograficos: {
                            primer_demografico_id: '',
                            primer_demografico: '',
                            segundo_demografico: '',
                            tercer_demografico: '',
                            cuarto_demografico: '',
                            quinto_demografico: '',
                            sexto_demografico: '',
                            septimo_demografico: '',
                            octavo_demografico: '',
                            noveno_demografico: '',
                            decimo_demografico: '',
                            segundo_demografico_id: '',
                            tercer_demografico_id: '',
                            cuarto_demografico_id: '',
                            quinto_demografico_id: '',
                            sexto_demografico_id: '',
                            septimo_demografico_id: '',
                            octavo_demografico_id: '',
                            noveno_demografico_id: '',
                            decimo_demografico_id: '',
                        },
                        psicologicos: {
                            primer_psicologico: '',
                            segundo_psicologico: '',
                            tercer_psicologico: '',
                            cuarto_psicologico: '',
                            quinto_psicologico: '',
                            sexto_psicologico: '',
                            septimo_psicologico: '',
                            octavo_psicologico: '',
                            noveno_psicologico: '',
                            decimo_psicologico: '',
                            primer_psicologico_id: '',
                            segundo_psicologico_id: '',
                            tercer_psicologico_id: '',
                            cuarto_psicologico_id: '',
                            quinto_psicologico_id: '',
                            sexto_psicologico_id: '',
                            septimo_psicologico_id: '',
                            octavo_psicologico_id: '',
                            noveno_psicologico_id: '',
                            decimo_psicologico_id: '',
                        },
                        metas: {
                            primera_meta: '',
                            segunda_meta: '',
                            tercera_meta: '',
                            cuarta_meta: '',
                            quinta_meta: '',
                            sexta_meta: '',
                            septima_meta: '',
                            octava_meta: '',
                            novena_meta: '',
                            decima_meta: '',
                            primera_meta_id: '',
                            segunda_meta_id: '',
                            tercera_meta_id: '',
                            cuarta_meta_id: '',
                            quinta_meta_id: '',
                            sexta_meta_id: '',
                            septima_meta_id: '',
                            octava_meta_id: '',
                            novena_meta_id: '',
                            decima_meta_id: '',
                        },
                        miedos: {
                            primer_miedo: '',
                            segundo_miedo: '',
                            tercer_miedo: '',
                            cuarto_miedo: '',
                            quinto_miedo: '',
                            sexto_miedo: '',
                            septimo_miedo: '',
                            octavo_miedo: '',
                            noveno_miedo: '',
                            decimo_miedo: '',
                            primer_miedo_id: '',
                            segundo_miedo_id: '',
                            tercer_miedo_id: '',
                            cuarto_miedo_id: '',
                            quinto_miedo_id: '',
                            sexto_miedo_id: '',
                            septimo_miedo_id: '',
                            octavo_miedo_id: '',
                            noveno_miedo_id: '',
                            decimo_miedo_id: '',
                        },
                    },
                    objetivo: '',
                    fases: {
                        primera_fase: '',
                        primera_fecha_inicio: null,
                        primera_fecha_final: null,
                        segunda_fecha_inicio: null,
                        segunda_fase: '',
                        segunda_fecha_final: null,
                        tercera_fecha_inicio: null,
                        tercera_fase: '',
                        tercera_fecha_final: null,
                        cuarta_fecha_inicio: null,
                        cuarta_fase: '',
                        cuarta_fecha_final: null,
                        quinta_fecha_inicio: null,
                        quinta_fase: '',
                        quinta_fecha_final: null,
                        sexta_fecha_inicio: null,
                        sexta_fase: '',
                        sexta_fecha_final: null,
                        septima_fecha_inicio: null,
                        septima_fase: '',
                        septima_fecha_final: null,
                        octava_fecha_inicio: null,
                        octava_fase: '',
                        octava_fecha_final: null,
                        novena_fecha_inicio: null,
                        novena_fase: '',
                        novena_fecha_final: null,
                        decima_fecha_inicio: null,
                        decima_fase: '',
                        decima_fecha_final: null,
                        once_fecha_inicio: null,
                        onceava_fase: '',
                        once_fecha_final: null,
                        doce_fecha_inicio: null,
                        doceava_fase: '',
                        doce_fecha_final: null,
                        trece_fecha_inicio: null,
                        treceava_fase: '',
                        trece_fecha_final: null,
                        catorce_fecha_inicio: null,
                        catorceava_fase: '',
                        catorce_fecha_final: null,
                        quince_fecha_inicio: null,
                        quinceava_fase: '',
                        quince_fecha_final: null,
                        dieciseis_fecha_inicio: null,
                        dieciseisava_fase: '',
                        dieciseis_fecha_final: null,
                        diecisiete_fecha_inicio: null,
                        diecisieteava_fase: '',
                        diecisiete_fecha_final: null,
                        dieciochoava_fase: '',
                        dieciocho_fecha_inicio: null,
                        dieciocho_fecha_final: null,
                        diecinueveava_fase: '',
                        diecinueve_fecha_inicio: null,
                        diecinueve_fecha_final: null,
                        veinteava_fase: '',
                        veinte_fecha_inicio: null,
                        veinte_fecha_final: null,
                        primera_fase_id: '',
                        segunda_fase_id: '',
                        tercera_fase_id: '',
                        cuarta_fase_id: '',
                        quinta_fase_id: '',
                        sexta_fase_id: '',
                        septima_fase_id: '',
                        octava_fase_id: '',
                        novena_fase_id: '',
                        decima_fase_id: '',
                        onceava_fase_id: '',
                        doceava_fase_id: '',
                        treceava_fase_id: '',
                        catorceava_fase_id: '',
                        quinceava_fase_id: '',
                        dieciseisava_fase_id: '',
                        diecisieteava_fase_id: '',
                        dieciochoava_fase_id: '',
                        diecinueveava_fase_id: '',
                        veinteava_fase_id: '',
                    },
                    responsables: {
                        primer_resp_id: '',
                        primer_resp: '',
                        segundo_resp: '',
                        tercer_resp: '',
                        cuarto_resp: '',
                        quinto_resp: '',
                        sexto_resp: '',
                        septimo_resp: '',
                        octavo_resp: '',
                        noveno_resp: '',
                        decimo_resp: '',
                        segundo_resp_id: '',
                        tercer_resp_id: '',
                        cuarto_resp_id: '',
                        quinto_resp_id: '',
                        sexto_resp_id: '',
                        septimo_resp_id: '',
                        octavo_resp_id: '',
                        noveno_resp_id: '',
                        decimo_resp_id: '',
                    },
                    recursos: {
                        primer_recurso: '',
                        primer_tipo_recurso: '',
                        segundo_recurso: '',
                        segundo_tipo_recurso: '',
                        tercer_recurso: '',
                        tercer_tipo_recurso: '',
                        cuarto_recurso: '',
                        cuarto_tipo_recurso: '',
                        quinto_recurso: '',
                        quinto_tipo_recurso: '',
                        sexto_recurso: '',
                        sexto_tipo_recurso: '',
                        septimo_recurso: '',
                        septimo_tipo_recurso: '',
                        octavo_recurso: '',
                        octavo_tipo_recurso: '',
                        noveno_recurso: '',
                        noveno_tipo_recurso: '',
                        decimo_recurso: '',
                        decimo_tipo_recurso: '',
                        primer_recurso_id: '',
                        segundo_recurso_id: '',
                        tercer_recurso_id: '',
                        cuarto_recurso_id: '',
                        quinto_recurso_id: '',
                        sexto_recurso_id: '',
                        septimo_recurso_id: '',
                        octavo_recurso_id: '',
                        noveno_recurso_id: '',
                        decimo_recurso_id: '',
                    },
                    kpi: '',
                    cantidad_kpi: '',
                    frecuencia_kpi: 'Una Vez',
                    resultado: 0,
                    analisis: '',
                },
                mensaje: '',
            }
        },

        methods: {
            submit () {
                if( this.form.descripcion_estrategia == '' || this.form.descripcion_estrategia == null ){
                    this.mensaje = 'La descripción no puede estar vacio';
                    this.alerta = true;
                }
                else if( this.form.descripcion_estrategia.length < 8 ){
                    this.mensaje = 'La descripción no cumple con los caracteres mínimos';
                    this.alerta = true;
                }
                else if( this.form.descripcion_estrategia.length >= 1000 ){
                    this.mensaje = 'La descripción supera los 1000 caracteres permitidos';
                    this.alerta = true;
                }
                else if( this.form.objetivo == '' || this.form.objetivo == null ){
                    this.mensaje = 'El objetivo no puede estar vacio';
                    this.alerta = true;
                }
                else if( this.form.objetivo.length < 8 ){
                    this.mensaje = 'El objetivo no cumple con los caracteres mínimos';
                    this.alerta = true;
                }
                else if( this.form.objetivo.length >= 200 ){
                    this.mensaje = 'El objetivo supera los 200 caracteres permitidos';
                    this.alerta = true;
                }
                else if( this.form.fecha_final == null && this.form.fecha_inicio == null ){
                    this.mensaje = 'Las fecha no pueden estar vacias';
                    this.alerta = true;
                }
                else if( this.form.fecha_final < this.form.fecha_inicio){
                    this.mensaje = 'La fecha final de la estrategias no puede ser primero que la fecha inicial.';
                    this.alerta = true;
                }
                else if( this.form.fases.primera_fase == '' || this.form.fases.primera_fecha_inicio == null || this.form.fases.primera_fecha_final == null){
                    this.mensaje = 'Falta un dato de la fase 1';
                    this.alerta = true;
                }
                else if( this.form.fases.primera_fecha_final < this.form.fases.primera_fecha_inicio ){
                    this.mensaje = 'La fecha final de la fase 1 no puede ser primero que la fecha de inicio';
                    this.alerta = true;
                }  
                else if( this.form.fases.primera_fecha_final < this.form.fecha_inicio || this.form.fases.primera_fecha_final > this.form.fecha_final || this.form.fases.primera_fecha_inicio < this.form.fecha_inicio || this.form.fases.primera_fecha_inicio > this.form.fecha_final ){
                    this.mensaje = 'Las fechas de la fase 1 no estan dentro de las fechas de la estrategia';
                    this.alerta = true;
                }  
                else if( ( this.form.fases.segunda_fase == '' || this.form.fases.segunda_fecha_inicio == null || this.form.fases.segunda_fecha_final == null ) && ( this.cantidad_fases >= 2 ) ){
                    this.mensaje = 'Falta un dato de la fase 2';
                    this.alerta = true;
                }
                else if( this.form.fases.segunda_fecha_final < this.form.fases.segunda_fecha_inicio ){
                    this.mensaje = 'La fecha final de la fase 2 no puede ser primero que la fecha de inicio';
                    this.alerta = true;
                }  
                else if( ( this.form.fases.segunda_fecha_final < this.form.fecha_inicio || this.form.fases.segunda_fecha_final > this.form.fecha_final || this.form.fases.segunda_fecha_inicio < this.form.fecha_inicio || this.form.fases.segunda_fecha_inicio > this.form.fecha_final ) && ( this.cantidad_fases >= 2 ) ){
                    this.mensaje = 'Las fechas de la fase 2 no estan dentro de las fechas de la estrategia';
                    this.alerta = true;
                } 
                else if( ( this.form.fases.tercera_fase == '' || this.form.fases.tercera_fecha_inicio == null || this.form.fases.tercera_fecha_final == null ) && this.cantidad_fases >= 3){
                    this.mensaje = 'Falta un dato de la fase 3';
                    this.alerta = true;
                }
                else if( this.form.fases.tercera_fecha_final < this.form.fases.tercera_fecha_inicio ){
                    this.mensaje = 'La fecha final de la fase 3 no puede ser primero que la fecha de inicio';
                    this.alerta = true;
                }  
                else if( (this.form.fases.tercera_fecha_final < this.form.fecha_inicio || this.form.fases.tercera_fecha_final > this.form.fecha_final || this.form.fases.tercera_fecha_inicio < this.form.fecha_inicio || this.form.fases.tercera_fecha_inicio > this.form.fecha_final ) && this.cantidad_fases >= 3 ){
                    this.mensaje = 'Las fechas de la fase 3 no estan dentro de las fechas de la estrategia';
                    this.alerta = true;
                } 
                else if( ( this.form.fases.cuarta_fase == '' || this.form.fases.cuarta_fecha_inicio == null || this.form.fases.primera_fecha_final == null ) && this.cantidad_fases >= 4){
                    this.mensaje = 'Falta un dato de la fase 4';
                    this.alerta = true;
                }
                else if( this.form.fases.cuarta_fecha_final < this.form.fases.cuarta_fecha_inicio ){
                    this.mensaje = 'La fecha final de la fase 4 no puede ser primero que la fecha de inicio';
                    this.alerta = true;
                }  
                else if( (this.form.fases.cuarta_fecha_final < this.form.fecha_inicio || this.form.fases.cuarta_fecha_final > this.form.fecha_final || this.form.fases.cuarta_fecha_inicio < this.form.fecha_inicio || this.form.fases.cuarta_fecha_inicio > this.form.fecha_final) && this.cantidad_fases >= 4 ){
                    this.mensaje = 'Las fechas de la fase 4 no estan dentro de las fechas de la estrategia';
                    this.alerta = true;
                } 
                else if( ( this.form.fases.quinta_fase == '' || this.form.fases.quinta_fecha_inicio == null || this.form.fases.primera_fecha_final == null ) && this.cantidad_fases > 5){
                    this.mensaje = 'Falta un dato de la fase 5';
                    this.alerta = true;
                }
                else if( this.form.fases.quinta_fecha_final < this.form.fases.quinta_fecha_inicio ){
                    this.mensaje = 'La fecha final de la fase 5 no puede ser primero que la fecha de inicio';
                    this.alerta = true;
                }  
                else if( (this.form.fases.quinta_fecha_final < this.form.fecha_inicio || this.form.fases.quinta_fecha_final > this.form.fecha_final || this.form.fases.quinta_fecha_inicio < this.form.fecha_inicio || this.form.fases.quinta_fecha_inicio > this.form.fecha_final) && this.cantidad_fases >= 5 ){
                    this.mensaje = 'Las fechas de la fase 5 no estan dentro de las fechas de la estrategia';
                    this.alerta = true;
                } 
                else if( ( this.form.fases.sexta_fase == '' || this.form.fases.sexta_fecha_inicio == null || this.form.fases.sexta_fecha_final == null ) && this.cantidad_fases >= 6){
                    this.mensaje = 'Falta un dato de la fase 6';
                    this.alerta = true;
                }
                else if( this.form.fases.sexta_fecha_final < this.form.fases.sexta_fecha_inicio ){
                    this.mensaje = 'La fecha final de la fase 6 no puede ser primero que la fecha de inicio';
                    this.alerta = true;
                }  
                else if( (this.form.fases.sexta_fecha_final < this.form.fecha_inicio || this.form.fases.sexta_fecha_final > this.form.fecha_final || this.form.fases.sexta_fecha_inicio < this.form.fecha_inicio || this.form.fases.sexta_fecha_inicio > this.form.fecha_final) && this.cantidad_fases >= 6 ){
                    this.mensaje = 'Las fechas de la fase 6 no estan dentro de las fechas de la estrategia';
                    this.alerta = true;
                } 
                else if( ( this.form.fases.septima_fase == '' || this.form.fases.septima_fecha_inicio == null || this.form.fases.septima_fecha_final == null ) && this.cantidad_fases >= 7){
                    this.mensaje = 'Falta un dato de la fase 7';
                    this.alerta = true;
                }
                else if( this.form.fases.septima_fecha_final < this.form.fases.septima_fecha_inicio ){
                    this.mensaje = 'La fecha final de la fase 7 no puede ser primero que la fecha de inicio';
                    this.alerta = true;
                }  
                else if( (this.form.fases.septima_fecha_final < this.form.fecha_inicio || this.form.fases.septima_fecha_final > this.form.fecha_final || this.form.fases.septima_fecha_inicio < this.form.fecha_inicio || this.form.fases.septima_fecha_inicio > this.form.fecha_final) && this.cantidad_fases >= 7 ){
                    this.mensaje = 'Las fechas de la fase 7 no estan dentro de las fechas de la estrategia';
                    this.alerta = true;
                } 
                else if( ( this.form.fases.octava_fase == '' || this.form.fases.octava_fecha_inicio == null || this.form.fases.octava_fecha_final == null ) && this.cantidad_fases >= 8 ){
                    this.mensaje = 'Falta un dato de la fase 8';
                    this.alerta = true;
                }
                else if( this.form.fases.octava_fecha_final < this.form.fases.octava_fecha_inicio ){
                    this.mensaje = 'La fecha final de la fase 8 no puede ser primero que la fecha de inicio';
                    this.alerta = true;
                }  
                else if( (this.form.fases.octava_fecha_final < this.form.fecha_inicio || this.form.fases.octava_fecha_final > this.form.fecha_final || this.form.fases.octava_fecha_inicio < this.form.fecha_inicio || this.form.fases.octava_fecha_inicio > this.form.fecha_final) && this.cantidad_fases >= 8 ){
                    this.mensaje = 'Las fechas de la fase 8 no estan dentro de las fechas de la estrategia';
                    this.alerta = true;
                } 
                else if( this.form.presupuesto < 0 || this.form.presupuesto == '' || this.form.presupuesto == null){
                    this.mensaje = 'El presupuesto tiene que mayor que 0';
                    this.alerta = true;
                }
                else if( this.form.cantidad_kpi < 0 || this.form.cantidad_kpi == '' || this.form.cantidad_kpi == null){
                    this.mensaje = 'El valor referencial tiene que mayor que 0';
                    this.alerta = true;
                }
                else if( ( this.form.responsables.primer_resp == '' || this.form.responsables.primer_resp == null ) && ( this.form.responsables.segundo_resp == '' || this.form.responsables.segundo_resp == null ) && ( this.form.responsables.tercer_resp == '' || this.form.responsables.tercer_resp == null ) && ( this.form.responsables.cuarto_resp == '' || this.form.responsables.cuarto_resp == null ) && ( this.form.responsables.quinto_resp == '' || this.form.responsables.quinto_resp == null )  && ( this.form.responsables.sexto_resp == '' || this.form.responsables.sexto_resp == null ) && ( this.form.responsables.septimo_resp == '' || this.form.responsables.septimo_resp == null ) && ( this.form.responsables.octavo_resp == '' || this.form.responsables.octavo_resp == null ) && ( this.form.responsables.noveno_resp == '' || this.form.responsables.noveno_resp == null ) && ( this.form.responsables.decimo_resp == '' || this.form.responsables.decimo_resp == null ) ){
                    this.mensaje = 'Se necesita al menos un responsable';
                    this.alerta = true;
                }
                else if( ( this.form.recursos.primer_recurso == '' || this.form.recursos.primer_recurso == null ) && ( this.form.recursos.segundo_recurso == '' || this.form.recursos.segundo_recurso == null ) && ( this.form.recursos.tercer_recurso == '' || this.form.recursos.tercer_recurso == null ) && ( this.form.recursos.cuarto_recurso == '' || this.form.recursos.cuarto_recurso == null ) && ( this.form.recursos.quinto_recurso == '' || this.form.recursos.quinto_recurso == null )  && ( this.form.recursos.sexto_recurso == '' || this.form.recursos.sexto_recurso == null ) && ( this.form.recursos.septimo_recurso == '' || this.form.recursos.septimo_recurso == null ) && ( this.form.recursos.octavo_recurso == '' || this.form.recursos.octavo_recurso == null ) && ( this.form.recursos.noveno_recurso == '' || this.form.recursos.noveno_recurso == null ) && ( this.form.recursos.decimo_recurso == '' || this.form.recursos.decimo_recurso == null ) ){
                    this.mensaje = 'Se necesita al menos un responsable';
                    this.alerta = true;
                }
                else if( ( this.form.recursos.primer_recurso != '' && this.form.recursos.primer_recurso != null && this.form.recursos.primer_tipo_recurso == '' ) || ( this.form.recursos.segundo_recurso != '' && this.form.recursos.segundo_recurso != null && this.form.recursos.segundo_tipo_recurso == '' ) || ( this.form.recursos.tercer_recurso != '' && this.form.recursos.tercer_recurso != null && this.form.recursos.tercer_tipo_recurso == '' ) || ( this.form.recursos.cuarto_recurso != '' && this.form.recursos.cuarto_recurso != null && this.form.recursos.cuarto_tipo_recurso == '' ) || ( this.form.recursos.quinto_recurso != '' && this.form.recursos.quinto_recurso != null && this.form.recursos.quinto_tipo_recurso == '' )  || ( this.form.recursos.sexto_recurso != '' && this.form.recursos.sexto_recurso != null && this.form.recursos.sexto_tipo_recurso == '' ) || ( this.form.recursos.septimo_recurso != '' && this.form.recursos.septimo_recurso != null && this.form.recursos.septimo_tipo_recurso == '' ) || ( this.form.recursos.octavo_recurso != '' && this.form.recursos.octavo_recurso != null && this.form.recursos.octavo_tipo_recurso == '' ) || ( this.form.recursos.noveno_recurso != '' && this.form.recursos.noveno_recurso != null && this.form.recursos.noveno_tipo_recurso == '' ) || ( this.form.recursos.decimo_recurso != '' && this.form.recursos.decimo_recurso != null && this.form.recursos.decimo_tipo_recurso == '' ) ){
                    this.mensaje = 'Especifique el tipo de recurso';
                    this.alerta = true;
                }
                else {
                    let formulario = document.getElementById('formulario');
                    formulario.submit();
                }
            },
            aumentarResponsables(){
                if( this.cantidad_responsables < 10 ){
                    this.cantidad_responsables++;
                }
                else {
                    this.alerta_superada = true;
                }
            },
            aumentarRecursos(){
                if( this.cantidad_recursos < 10 ){
                    this.cantidad_recursos++;
                }
                else {
                    this.alerta_superada = true;
                }
            },
            aumentarFases(){
                if( this.cantidad_fases < 10 ){
                    this.cantidad_fases++;
                }
                else {
                    this.alerta_superada = true;
                }
            },
            aumentarDemografico(){
                if( this.cantidad_demograficos < 10 ){
                    this.cantidad_demograficos++;
                }
                else {
                    this.alerta_superada = true;
                }
            },
            aumentarPsicologico(){
                if( this.cantidad_psicologicos < 10 ){
                    this.cantidad_psicologicos++;
                }
                else {
                    this.alerta_superada = true;
                }
            },
            aumentarMetas(){
                if( this.cantidad_metas < 10 ){
                    this.cantidad_metas++;
                }
                else {
                    this.alerta_superada = true;
                }
            },
            aumentarMiedos(){
                if( this.cantidad_miedos < 10 ){
                    this.cantidad_miedos++;
                }
                else {
                    this.alerta_superada = true;
                }
            },

            cargarDatos(){
                let actual = location.href;
                this.url = actual;
                axios.post(actual)
                    .then((response) => {
                        this.estrategia = response.data
                        this.form.descripcion_estrategia = response.data.descripcion;
                        this.form.buyer_persona.descripcion = response.data.buyer_persona;
                        this.form.fecha_inicio = response.data.fecha_inicio;
                        this.form.fecha_final = response.data.fecha_final;
                        this.form.objetivo = response.data.objetivo;
                        this.form.kpi = response.data.kpi;
                        this.form.cantidad_kpi = response.data.valor_referencial;
                        this.form.frecuencia_kpi = response.data.tipo_valor_referencial;
                        this.form.presupuesto = response.data.presupuesto;
                        this.form.analisis = response.data.analisis;
                        this.form.resultado = response.data.resultado;

                        axios.post(`/jetfilter/marketing/estrategias/recursos_edit/${this.estrategia.id }`)
                            .then((response) => {
                                this.cantidad_recursos = response.data.length;

                                this.form.recursos.primer_recurso = response.data[0].recurso;
                                this.form.recursos.primer_tipo_recurso = response.data[0].tipo_recurso;
                                this.form.recursos.segundo_recurso = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].recurso : '';
                                this.form.recursos.segundo_tipo_recurso = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].tipo_recurso : '';
                                this.form.recursos.tercer_recurso = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].recurso : '';
                                this.form.recursos.tercer_tipo_recurso = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].tipo_recurso : '';
                                this.form.recursos.cuarto_recurso = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].recurso : '';
                                this.form.recursos.cuarto_tipo_recurso = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].tipo_recurso : '';
                                this.form.recursos.quinto_recurso = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].recurso : '';
                                this.form.recursos.quinto_tipo_recurso = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].tipo_recurso : '';
                                this.form.recursos.sexto_recurso = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].recurso : '';
                                this.form.recursos.sexto_tipo_recurso = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].tipo_recurso : '';
                                this.form.recursos.septimo_recurso = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].recurso : '';
                                this.form.recursos.septimo_tipo_recurso = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].tipo_recurso : '';
                                this.form.recursos.octavo_recurso = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].recurso : '';
                                this.form.recursos.octavo_tipo_recurso = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].tipo_recurso : '';
                                this.form.recursos.noveno_recurso = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].recurso : '';
                                this.form.recursos.noveno_tipo_recurso = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].tipo_recurso : '';
                                this.form.recursos.decimo_recurso = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].recurso : '';
                                this.form.recursos.decimo_tipo_recurso = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].tipo_recurso : '';

                                this.form.recursos.primer_recurso_id = response.data[0].id;
                                this.form.recursos.segundo_recurso_id = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].id : '';
                                this.form.recursos.tercer_recurso_id = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].id : '';
                                this.form.recursos.cuarto_recurso_id = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].id : '';
                                this.form.recursos.quinto_recurso_id = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].id : '';
                                this.form.recursos.sexto_recurso_id = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].id : '';
                                this.form.recursos.septimo_recurso_id = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].id : '';
                                this.form.recursos.octavo_recurso_id = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].id : '';
                                this.form.recursos.noveno_recurso_id = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].id : '';
                                this.form.recursos.decimo_recurso_id = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].id : '';
                            })
                            .catch((error) => {
                                console.log(error);
                            }); 

                        axios.post(`/jetfilter/marketing/estrategias/responsables/${this.estrategia.id }`)
                            .then((response) => {
                                this.cantidad_responsables = response.data.length;

                                    this.form.responsables.primer_resp = response.data[0].responsable;
                                    this.form.responsables.segundo_resp = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].responsable : '';
                                    this.form.responsables.tercer_resp = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].responsable : '';
                                    this.form.responsables.cuarto_resp = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].responsable : '';
                                    this.form.responsables.quinto_resp = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].responsable : '';
                                    this.form.responsables.sexto_resp = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].responsable : '';
                                    this.form.responsables.septimo_resp = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].responsable : '';
                                    this.form.responsables.octavo_resp = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].responsable : '';
                                    this.form.responsables.noveno_resp = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].responsable : '';
                                    this.form.responsables.decimo_resp = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].responsable : '';

                                    this.form.responsables.primer_resp_id = response.data[0].id;
                                    this.form.responsables.segundo_resp_id = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].id : 0;
                                    this.form.responsables.tercer_resp_id = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].id : 0;
                                    this.form.responsables.cuarto_resp_id = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].id : 0;
                                    this.form.responsables.quinto_resp_id = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].id : 0;
                                    this.form.responsables.sexto_resp_id = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].id : 0;
                                    this.form.responsables.septimo_resp_id = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].id : 0;
                                    this.form.responsables.octavo_resp_id = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].id : 0;
                                    this.form.responsables.noveno_resp_id = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].id : 0;
                                    this.form.responsables.decimo_resp_id = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].id : 0;
                            })
                            .catch((error) => {
                                console.log('error');
                            }); 

                            axios.post(`/jetfilter/marketing/estrategias/fases/${this.estrategia.id }`)
                            .then((response) => {
                                this.cantidad_fases = response.data.length;

                                    this.form.fases.primera_fase = response.data[0].fase;
                                    this.form.fases.segunda_fase = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].fase : '';
                                    this.form.fases.tercera_fase = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].fase : '';
                                    this.form.fases.cuarta_fase = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].fase : '';
                                    this.form.fases.quinta_fase = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].fase : '';
                                    this.form.fases.sexta_fase = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].fase : '';
                                    this.form.fases.septima_fase = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].fase : '';
                                    this.form.fases.octava_fase = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].fase : '';
                                    this.form.fases.novena_fase = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].fase : '';
                                    this.form.fases.decima_fase = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].fase : '';

                                    this.form.fases.primera_fecha_inicio = response.data[0].fecha_inicio;
                                    this.form.fases.segunda_fecha_inicio = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].fecha_inicio : '';
                                    this.form.fases.tercera_fecha_inicio = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].fecha_inicio : '';
                                    this.form.fases.cuarta_fecha_inicio = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].fecha_inicio : '';
                                    this.form.fases.quinta_fecha_inicio = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].fecha_inicio : '';
                                    this.form.fases.sexta_fecha_inicio = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].fecha_inicio : '';
                                    this.form.fases.septima_fecha_inicio = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].fecha_inicio : '';
                                    this.form.fases.octava_fecha_inicio = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].fecha_inicio : '';
                                    this.form.fases.novena_fecha_inicio = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].fecha_inicio : '';
                                    this.form.fases.decima_fecha_inicio = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].fecha_inicio : '';

                                    this.form.fases.primera_fecha_final = response.data[0].fecha_final;
                                    this.form.fases.segunda_fecha_final = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].fecha_final : '';
                                    this.form.fases.tercera_fecha_final = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].fecha_final : '';
                                    this.form.fases.cuarta_fecha_final = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].fecha_final : '';
                                    this.form.fases.quinta_fecha_final = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].fecha_final : '';
                                    this.form.fases.sexta_fecha_final = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].fecha_final : '';
                                    this.form.fases.septima_fecha_final = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].fecha_final : '';
                                    this.form.fases.octava_fecha_final = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].fecha_final : '';
                                    this.form.fases.novena_fecha_final = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].fecha_final : '';
                                    this.form.fases.decima_fecha_final = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].fecha_final : '';
                            
                                    this.form.fases.primera_fase_id = response.data[0].id;
                                    this.form.fases.segunda_fase_id = ( typeof response.data[1] !== 'undefined' ) ? response.data[1].id : '';
                                    this.form.fases.tercera_fase_id = ( typeof response.data[2] !== 'undefined' ) ? response.data[2].id : '';
                                    this.form.fases.cuarta_fase_id = ( typeof response.data[3] !== 'undefined' ) ? response.data[3].id : '';
                                    this.form.fases.quinta_fase_id = ( typeof response.data[4] !== 'undefined' ) ? response.data[4].id : '';
                                    this.form.fases.sexta_fase_id = ( typeof response.data[5] !== 'undefined' ) ? response.data[5].id : '';
                                    this.form.fases.septima_fase_id = ( typeof response.data[6] !== 'undefined' ) ? response.data[6].id : '';
                                    this.form.fases.octava_fase_id = ( typeof response.data[7] !== 'undefined' ) ? response.data[7].id : '';
                                    this.form.fases.novena_fase_id = ( typeof response.data[8] !== 'undefined' ) ? response.data[8].id : '';
                                    this.form.fases.decima_fase_id = ( typeof response.data[9] !== 'undefined' ) ? response.data[9].id : '';
                            })
                            .catch((error) => {
                                console.log('error');
                            }); 

                            axios.post(`/jetfilter/marketing/estrategias/buyer_persona/${this.estrategia.id }`)
                            .then((response) => {
                                    this.cantidad_demograficos = ( response.data[4] > 1 ) ? response.data[4] : 1;

                                    this.form.buyer_persona.demograficos.primer_demografico = ( typeof response.data[0][0] !== 'undefined' ) ? response.data[0][0].descripcion : '';
                                    this.form.buyer_persona.demograficos.segundo_demografico = ( typeof response.data[0][1] !== 'undefined' ) ? response.data[0][1].descripcion : '';
                                    this.form.buyer_persona.demograficos.tercer_demografico = ( typeof response.data[0][2] !== 'undefined' ) ? response.data[0][2].descripcion : '';
                                    this.form.buyer_persona.demograficos.cuarto_demografico = ( typeof response.data[0][3] !== 'undefined' ) ? response.data[0][3].descripcion : '';
                                    this.form.buyer_persona.demograficos.quinto_demografico = ( typeof response.data[0][4] !== 'undefined' ) ? response.data[0][4].descripcion : '';
                                    this.form.buyer_persona.demograficos.sexto_demografico = ( typeof response.data[0][5] !== 'undefined' ) ? response.data[0][5].descripcion : '';
                                    this.form.buyer_persona.demograficos.septimo_demografico = ( typeof response.data[0][6] !== 'undefined' ) ? response.data[0][6].descripcion : '';
                                    this.form.buyer_persona.demograficos.octavo_demografico = ( typeof response.data[0][7] !== 'undefined' ) ? response.data[0][7].descripcion : '';
                                    this.form.buyer_persona.demograficos.noveno_demografico = ( typeof response.data[0][8] !== 'undefined' ) ? response.data[0][8].descripcion : '';
                                    this.form.buyer_persona.demograficos.decimo_demografico = ( typeof response.data[0][9] !== 'undefined' ) ? response.data[0][9].descripcion : '';

                                    this.form.buyer_persona.demograficos.primer_demografico_id = ( typeof response.data[0][0] !== 'undefined' ) ? response.data[0][0].id : '';
                                    this.form.buyer_persona.demograficos.segundo_demografico_id = ( typeof response.data[0][1] !== 'undefined' ) ? response.data[0][1].id : '';
                                    this.form.buyer_persona.demograficos.tercer_demografico_id = ( typeof response.data[0][2] !== 'undefined' ) ? response.data[0][2].id : '';
                                    this.form.buyer_persona.demograficos.cuarto_demografico_id = ( typeof response.data[0][3] !== 'undefined' ) ? response.data[0][3].id : '';
                                    this.form.buyer_persona.demograficos.quinto_demografico_id = ( typeof response.data[0][4] !== 'undefined' ) ? response.data[0][4].id : '';
                                    this.form.buyer_persona.demograficos.sexto_demografico_id = ( typeof response.data[0][5] !== 'undefined' ) ? response.data[0][5].id : '';
                                    this.form.buyer_persona.demograficos.septimo_demografico_id = ( typeof response.data[0][6] !== 'undefined' ) ? response.data[0][6].id : '';
                                    this.form.buyer_persona.demograficos.octavo_demografico_id = ( typeof response.data[0][7] !== 'undefined' ) ? response.data[0][7].id : '';
                                    this.form.buyer_persona.demograficos.noveno_demografico_id = ( typeof response.data[0][8] !== 'undefined' ) ? response.data[0][8].id : '';
                                    this.form.buyer_persona.demograficos.decimo_demografico_id = ( typeof response.data[0][9] !== 'undefined' ) ? response.data[0][9].id : '';

                                    this.cantidad_psicologicos = ( response.data[5] == 0 ) ? 1 : response.data[5];

                                    this.form.buyer_persona.psicologicos.primer_psicologico = ( typeof response.data[1][0] !== 'undefined' ) ? response.data[1][0].descripcion : '';
                                    this.form.buyer_persona.psicologicos.segundo_psicologico = ( typeof response.data[1][1] !== 'undefined' ) ? response.data[1][1].descripcion : '';
                                    this.form.buyer_persona.psicologicos.tercer_psicologico = ( typeof response.data[1][2] !== 'undefined' ) ? response.data[1][2].descripcion : '';
                                    this.form.buyer_persona.psicologicos.cuarto_psicologico = ( typeof response.data[1][3] !== 'undefined' ) ? response.data[1][3].descripcion : '';
                                    this.form.buyer_persona.psicologicos.quinto_psicologico = ( typeof response.data[1][4] !== 'undefined' ) ? response.data[1][4].descripcion : '';
                                    this.form.buyer_persona.psicologicos.sexto_psicologico = ( typeof response.data[1][5] !== 'undefined' ) ? response.data[1][5].descripcion : '';
                                    this.form.buyer_persona.psicologicos.septimo_psicologico = ( typeof response.data[1][6] !== 'undefined' ) ? response.data[1][6].descripcion : '';
                                    this.form.buyer_persona.psicologicos.octavo_psicologico = ( typeof response.data[1][7] !== 'undefined' ) ? response.data[1][7].descripcion : '';
                                    this.form.buyer_persona.psicologicos.noveno_psicologico = ( typeof response.data[1][8] !== 'undefined' ) ? response.data[1][8].descripcion : '';
                                    this.form.buyer_persona.psicologicos.decimo_psicologico = ( typeof response.data[1][9] !== 'undefined' ) ? response.data[1][9].descripcion : '';

                                    this.form.buyer_persona.psicologicos.primer_psicologico_id = ( typeof response.data[1][0] !== 'undefined' ) ? response.data[1][0].id : '';
                                    this.form.buyer_persona.psicologicos.segundo_psicologico_id = ( typeof response.data[1][1] !== 'undefined' ) ? response.data[1][1].id : '';
                                    this.form.buyer_persona.psicologicos.tercer_psicologico_id = ( typeof response.data[1][2] !== 'undefined' ) ? response.data[1][2].id : '';
                                    this.form.buyer_persona.psicologicos.cuarto_psicologico_id = ( typeof response.data[1][3] !== 'undefined' ) ? response.data[1][3].id : '';
                                    this.form.buyer_persona.psicologicos.quinto_psicologico_id = ( typeof response.data[1][4] !== 'undefined' ) ? response.data[1][4].id : '';
                                    this.form.buyer_persona.psicologicos.sexto_psicologico_id = ( typeof response.data[1][5] !== 'undefined' ) ? response.data[1][5].id : '';
                                    this.form.buyer_persona.psicologicos.septimo_psicologico_id = ( typeof response.data[1][6] !== 'undefined' ) ? response.data[1][6].id : '';
                                    this.form.buyer_persona.psicologicos.octavo_psicologico_id = ( typeof response.data[1][7] !== 'undefined' ) ? response.data[1][7].id : '';
                                    this.form.buyer_persona.psicologicos.noveno_psicologico_id = ( typeof response.data[1][8] !== 'undefined' ) ? response.data[1][8].id : '';
                                    this.form.buyer_persona.psicologicos.decimo_psicologico_id = ( typeof response.data[1][9] !== 'undefined' ) ? response.data[1][9].id : '';

                                    this.cantidad_metas = ( response.data[6] == 0 ) ? 1 : response.data[6];

                                    this.form.buyer_persona.metas.primera_meta = ( typeof response.data[2][0] !== 'undefined' ) ? response.data[2][0].descripcion : '';
                                    this.form.buyer_persona.metas.segunda_meta = ( typeof response.data[2][1] !== 'undefined' ) ? response.data[2][1].descripcion : '';
                                    this.form.buyer_persona.metas.tercera_meta = ( typeof response.data[2][2] !== 'undefined' ) ? response.data[2][2].descripcion : '';
                                    this.form.buyer_persona.metas.cuarta_meta = ( typeof response.data[2][3] !== 'undefined' ) ? response.data[2][3].descripcion : '';
                                    this.form.buyer_persona.metas.quinta_meta = ( typeof response.data[2][4] !== 'undefined' ) ? response.data[2][4].descripcion : '';
                                    this.form.buyer_persona.metas.sexta_meta = ( typeof response.data[2][5] !== 'undefined' ) ? response.data[2][5].descripcion : '';
                                    this.form.buyer_persona.metas.septima_meta = ( typeof response.data[2][6] !== 'undefined' ) ? response.data[2][6].descripcion : '';
                                    this.form.buyer_persona.metas.octava_meta = ( typeof response.data[2][7] !== 'undefined' ) ? response.data[2][7].descripcion : '';
                                    this.form.buyer_persona.metas.novena_meta = ( typeof response.data[2][8] !== 'undefined' ) ? response.data[2][8].descripcion : '';
                                    this.form.buyer_persona.metas.decima_meta = ( typeof response.data[2][9] !== 'undefined' ) ? response.data[2][9].descripcion : '';

                                    this.form.buyer_persona.metas.primera_meta_id = ( typeof response.data[2][0] !== 'undefined' ) ? response.data[2][0].id : '';
                                    this.form.buyer_persona.metas.segunda_meta_id = ( typeof response.data[2][1] !== 'undefined' ) ? response.data[2][1].id : '';
                                    this.form.buyer_persona.metas.tercera_meta_id = ( typeof response.data[2][2] !== 'undefined' ) ? response.data[2][2].id : '';
                                    this.form.buyer_persona.metas.cuarta_meta_id = ( typeof response.data[2][3] !== 'undefined' ) ? response.data[2][3].id : '';
                                    this.form.buyer_persona.metas.quinta_meta_id = ( typeof response.data[2][4] !== 'undefined' ) ? response.data[2][4].id : '';
                                    this.form.buyer_persona.metas.sexta_meta_id = ( typeof response.data[2][5] !== 'undefined' ) ? response.data[2][5].id : '';
                                    this.form.buyer_persona.metas.septima_meta_id = ( typeof response.data[2][6] !== 'undefined' ) ? response.data[2][6].id : '';
                                    this.form.buyer_persona.metas.octava_meta_id = ( typeof response.data[2][7] !== 'undefined' ) ? response.data[2][7].id : '';
                                    this.form.buyer_persona.metas.novena_meta_id = ( typeof response.data[2][8] !== 'undefined' ) ? response.data[2][8].id : '';
                                    this.form.buyer_persona.metas.decima_meta_id = ( typeof response.data[2][9] !== 'undefined' ) ? response.data[2][9].id : '';

                                    this.cantidad_miedos = ( response.data[7] == 0 ) ? 1 : response.data[7];

                                    this.form.buyer_persona.miedos.primer_miedo = ( typeof response.data[3][0] !== 'undefined' ) ? response.data[3][0].descripcion : '';
                                    this.form.buyer_persona.miedos.segundo_miedo = ( typeof response.data[3][1] !== 'undefined' ) ? response.data[3][1].descripcion : '';
                                    this.form.buyer_persona.miedos.tercer_miedo = ( typeof response.data[3][2] !== 'undefined' ) ? response.data[3][2].descripcion : '';
                                    this.form.buyer_persona.miedos.cuarto_miedo = ( typeof response.data[3][3] !== 'undefined' ) ? response.data[3][3].descripcion : '';
                                    this.form.buyer_persona.miedos.quinto_miedo = ( typeof response.data[3][4] !== 'undefined' ) ? response.data[3][4].descripcion : '';
                                    this.form.buyer_persona.miedos.sexto_miedo = ( typeof response.data[3][5] !== 'undefined' ) ? response.data[3][5].descripcion : '';
                                    this.form.buyer_persona.miedos.septimo_miedo = ( typeof response.data[3][6] !== 'undefined' ) ? response.data[3][6].descripcion : '';
                                    this.form.buyer_persona.miedos.octavo_miedo = ( typeof response.data[3][7] !== 'undefined' ) ? response.data[3][7].descripcion : '';
                                    this.form.buyer_persona.miedos.noveno_miedo = ( typeof response.data[3][8] !== 'undefined' ) ? response.data[3][8].descripcion : '';
                                    this.form.buyer_persona.miedos.decimo_miedo = ( typeof response.data[3][9] !== 'undefined' ) ? response.data[3][9].descripcion : '';
                            
                                    this.form.buyer_persona.miedos.primer_miedo_id = ( typeof response.data[3][0] !== 'undefined' ) ? response.data[3][0].id : '';
                                    this.form.buyer_persona.miedos.segundo_miedo_id = ( typeof response.data[3][1] !== 'undefined' ) ? response.data[3][1].id : '';
                                    this.form.buyer_persona.miedos.tercer_miedo_id = ( typeof response.data[3][2] !== 'undefined' ) ? response.data[3][2].id : '';
                                    this.form.buyer_persona.miedos.cuarto_miedo_id = ( typeof response.data[3][3] !== 'undefined' ) ? response.data[3][3].id : '';
                                    this.form.buyer_persona.miedos.quinto_miedo_id = ( typeof response.data[3][4] !== 'undefined' ) ? response.data[3][4].id : '';
                                    this.form.buyer_persona.miedos.sexto_miedo_id = ( typeof response.data[3][5] !== 'undefined' ) ? response.data[3][5].id : '';
                                    this.form.buyer_persona.miedos.septimo_miedo_id = ( typeof response.data[3][6] !== 'undefined' ) ? response.data[3][6].id : '';
                                    this.form.buyer_persona.miedos.octavo_miedo_id = ( typeof response.data[3][7] !== 'undefined' ) ? response.data[3][7].id : '';
                                    this.form.buyer_persona.miedos.noveno_miedo_id = ( typeof response.data[3][8] !== 'undefined' ) ? response.data[3][8].id : '';
                                    this.form.buyer_persona.miedos.decimo_miedo_id = ( typeof response.data[3][9] !== 'undefined' ) ? response.data[3][9].id : '';
                            })
                            .catch((error) => {
                                console.log('error');
                            }); 
                    })
                    .catch((error) => {
                        console.log('error');
                    });
            },
        },

        mounted(){
            this.cargarDatos();
        },
    }
</script>