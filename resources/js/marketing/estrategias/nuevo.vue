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

        <v-form @submit.prevent="submit" id="formulario" method="POST" action="/jetfilter/marketing/estrategias/store" class="w-75 mx-auto my-2">
            <v-text-field
                v-model="form.titulo"
                label="Titulo de la Estrategia"
                :rules='tituloReglas'
                name="titulo"
                variant="solo"
                clear-icon="mdi-close-circle"
                clearable
                @click:clear="clearMessage"
            ></v-text-field>
            <v-textarea
                variant="filled"
                label="Descripción de la Estrategia"
                name="descripcion_estrategia"
                :rules="descripcionReglas"
                auto-grow
                v-model="form.descripcion_estrategia"
                clear-icon="mdi-close-circle"
                clearable
                @click:clear="clearMessage"
                counter
            ></v-textarea>
            <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                <div style="width: 100%;"
                >
                    <v-text-field 
                        v-model="form.objetivo"
                        :rules="ObjetivoReglas"
                        label="Objetivo"
                        name="objetivo"
                        clear-icon="mdi-close-circle"
                        clearable
                        counter
                        @click:clear="clearMessage"
                    ></v-text-field>
                </div>
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
                        <v-combobox
                            v-if="n == 1"
                            v-model="form.buyer_persona.demograficos.primer_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="demografico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 2"
                            v-model="form.buyer_persona.demograficos.segundo_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="demografico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 3"
                            v-model="form.buyer_persona.demograficos.tercer_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="demografico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 4"
                            v-model="form.buyer_persona.demograficos.cuarto_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="demografico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 5"
                            v-model="form.buyer_persona.demograficos.quinto_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="demografico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 6"
                            v-model="form.buyer_persona.demograficos.sexto_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="demografico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 7"
                            v-model="form.buyer_persona.demograficos.septimo_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="demografico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 8"
                            v-model="form.buyer_persona.demograficos.octavo_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="demografico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 9"
                            v-model="form.buyer_persona.demograficos.noveno_demografico"
                            label="Demográfico"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
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
                        <v-combobox
                            v-if="n == 1"
                            v-model="form.buyer_persona.psicologicos.primer_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 2"
                            v-model="form.buyer_persona.psicologicos.segundo_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 3"
                            v-model="form.buyer_persona.psicologicos.tercer_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 4"
                            v-model="form.buyer_persona.psicologicos.cuarto_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 5"
                            v-model="form.buyer_persona.psicologicos.quinto_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 6"
                            v-model="form.buyer_persona.psicologicos.sexto_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 7"
                            v-model="form.buyer_persona.psicologicos.septimo_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 8"
                            v-model="form.buyer_persona.psicologicos.octavo_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 9"
                            v-model="form.buyer_persona.psicologicos.noveno_psicologico"
                            label="Psicológico"
                            :loading="loading"
                            name="psicologico[]"
                            class="shrink"
                        ></v-combobox>
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
                        <v-combobox
                            v-if="n == 1"
                            v-model="form.buyer_persona.metas.primera_meta"
                            label="Meta"
                            :loading="loading"
                            name="meta[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 2"
                            v-model="form.buyer_persona.metas.segunda_meta"
                            label="Meta"
                            :loading="loading"
                            name="meta[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 3"
                            v-model="form.buyer_persona.metas.tercera_meta"
                            label="Meta"
                            :loading="loading"
                            name="meta[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 4"
                            v-model="form.buyer_persona.metas.cuarta_meta"
                            label="Meta"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 5"
                            v-model="form.buyer_persona.metas.quinta_meta"
                            label="Meta"
                            :loading="loading"
                            name="meta[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 6"
                            v-model="form.buyer_persona.metas.sexta_meta"
                            label="Meta"
                            :loading="loading"
                            name="meta[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 7"
                            v-model="form.buyer_persona.metas.septima_meta"
                            label="Meta"
                            :loading="loading"
                            name="meta[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 8"
                            v-model="form.buyer_persona.metas.octava_meta"
                            label="Meta"
                            :loading="loading"
                            name="responsable[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 9"
                            v-model="form.buyer_persona.metas.novena_meta"
                            label="Meta"
                            :loading="loading"
                            name="meta[]"
                            class="shrink"
                        ></v-combobox>
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
                        <v-combobox
                            v-if="n == 1"
                            v-model="form.buyer_persona.miedos.primer_miedo"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 2"
                            v-model="form.buyer_persona.miedos.segundo_miedo"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 3"
                            v-model="form.buyer_persona.miedos.tercer_miedo"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 4"
                            v-model="form.buyer_persona.miedos.cuarto_miedo"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 5"
                            v-model="form.buyer_persona.miedos.quinto_miedo"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 6"
                            v-model="form.buyer_persona.miedos.sexto_resp"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 7"
                            v-model="form.buyer_persona.miedos.septimo_miedo"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 8"
                            v-model="form.buyer_persona.miedos.octavo_miedo"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
                        <v-combobox
                            v-if="n == 9"
                            v-model="form.buyer_persona.miedos.noveno_miedo"
                            label="Miedo"
                            :loading="loading"
                            name="miedo[]"
                            class="shrink"
                        ></v-combobox>
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

            <h2 style="text-align: center;" >Responsables</h2>
            <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                <div class="w-25 mx-2"
                    v-for="n in cantidad_responsables"
                    :key="n"
                >
                    <v-combobox
                        v-if="n == 1"
                        v-model="form.responsables.primer_resp"
                        label="Responsable"
                        :rules="ResponsableReglas"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
                    <v-combobox
                        v-if="n == 2"
                        v-model="form.responsables.segundo_resp"
                        label="Responsable"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
                    <v-combobox
                        v-if="n == 3"
                        v-model="form.responsables.tercer_resp"
                        label="Responsable"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
                    <v-combobox
                        v-if="n == 4"
                        v-model="form.responsables.cuarto_resp"
                        label="Responsable"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
                    <v-combobox
                        v-if="n == 5"
                        v-model="form.responsables.quinto_resp"
                        label="Responsable"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
                    <v-combobox
                        v-if="n == 6"
                        v-model="form.responsables.sexto_resp"
                        label="Responsable"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
                    <v-combobox
                        v-if="n == 7"
                        v-model="form.responsables.septimo_resp"
                        label="Responsable"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
                    <v-combobox
                        v-if="n == 8"
                        v-model="form.responsables.octavo_resp"
                        label="Responsable"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
                    <v-combobox
                        v-if="n == 9"
                        v-model="form.responsables.noveno_resp"
                        label="Responsable"
                        :loading="loading"
                        name="responsable[]"
                        class="shrink"
                    ></v-combobox>
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

            <h2 style="text-align: center;" >Recursos</h2>
            <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                <div class="mx-2" 
                    style="width: 90%;"
                    v-for="n in cantidad_recursos"
                    :key="n"
                >
                    <div v-if="n == 1" style="display: flex;">
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

            <h2 style="text-align: center;" >Presupuesto ($)</h2>
            <div class="mb-3" style="display: flex; flex-wrap: wrap;">
                    <v-text-field
                        v-model="form.presupuesto"
                        label="Presupuesto"
                        :rules="presupuestoReglas"
                        name="presupuesto"
                        class="shrink"
                    ></v-text-field>
                </div>

            <h2 style="text-align: center;" >Gestión de KPI</h2>   
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
                        style="margin-right: 1em;"
                    ></v-text-field>
                    <v-select
                        v-model="form.frecuencia_kpi"
                        :items="frecuencia_kpi"
                        name="tipo_valor_referencial"
                        label="Frecuencia del KPI"
                        persistent-hint
                        return-object
                        single-line
                        style="margin-right: 1em;"
                    ></v-select>
                    <v-text-field
                        v-model="form.kpi"
                        :rules='KPIReglas'
                        label="Descripción o Nombre del KPI"
                        class="shrink"
                        name="kpi"
                    ></v-text-field>
                </div>
            </div>
            <v-btn type="submit" block class="mx-2" color="success" style="color: #fff;">Guardar Estrategia</v-btn>
            <v-btn
                color="error"
                class="mt-4"
                block
                @click="reset"
            >
                Resetear Parametros
            </v-btn>
        </v-form>

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

<style>
.v-text-field .responsables{
    width: 15em;
}
</style>

<script>
    export default {
        data(){
            return{
                tituloReglas: [
                    v => !!v || 'El Titulo es Requerido',
                    v => (v && v.length >= 8) || 'El campo titulo debe tener al menos 8 caracteres',
                ],
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
                reset () {
                    this.$refs.form.reset()
                },
                clearMessage () {
                    this.message = ''
                },
                tipos_recursos: ['Humanos', 'Técnicos'],
                frecuencia_kpi: ['Una Vez', 'Diario', 'Semanal', 'Mensual', 'Triemstral', 'Cuatrimestre', 'Semestral', 'Anual'],
                loading: false,
                cantidad_responsables: 1,
                cantidad_recursos: 1,
                cantidad_fases: 1,
                cantidad_demograficos: 1,
                cantidad_psicologicos: 1,
                cantidad_miedos: 1,
                cantidad_metas: 1,
                alerta_superada: false,
                alerta: false,
                mensaje: '',
                form: {
                    titulo: '',
                    fecha_inicio: null,
                    fecha_final: null,
                    descripcion_estrategia: '',
                    buyer_persona: {
                        descripcion: '',
                        demograficos: {
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
                    },
                    responsables: {
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
                    },
                    kpi: '',
                    cantidad_kpi: '',
                    frecuencia_kpi: 'Una Vez',
                    
                },
            }
        },
        methods: {
             submit () {
                if( this.form.titulo == '' || this.form.titulo == null ){
                    this.mensaje = 'El titulo no puede estar vacio';
                    this.alerta = true;
                }
                else if( this.form.titulo.length < 8 ){
                    this.mensaje = 'El titulo no cumple con los caracteres mínimos';
                    this.alerta = true;
                }
                else if( this.form.titulo.length >= 40 ){
                    this.mensaje = 'El titulo supera los 40 caracteres permitidos';
                    this.alerta = true;
                }
                else if( this.form.descripcion_estrategia == '' || this.form.descripcion_estrategia == null ){
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
                else if( this.form.fases.segunda_fecha_final < this.form.fecha_inicio || this.form.fases.segunda_fecha_final > this.form.fecha_final || this.form.fases.segunda_fecha_inicio < this.form.fecha_inicio || this.form.fases.segunda_fecha_inicio > this.form.fecha_final ){
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
                else if( this.form.fases.tercera_fecha_final < this.form.fecha_inicio || this.form.fases.tercera_fecha_final > this.form.fecha_final || this.form.fases.tercera_fecha_inicio < this.form.fecha_inicio || this.form.fases.tercera_fecha_inicio > this.form.fecha_final ){
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
                else if( this.form.fases.cuarta_fecha_final < this.form.fecha_inicio || this.form.fases.cuarta_fecha_final > this.form.fecha_final || this.form.fases.cuarta_fecha_inicio < this.form.fecha_inicio || this.form.fases.cuarta_fecha_inicio > this.form.fecha_final ){
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
                else if( this.form.fases.quinta_fecha_final < this.form.fecha_inicio || this.form.fases.quinta_fecha_final > this.form.fecha_final || this.form.fases.quinta_fecha_inicio < this.form.fecha_inicio || this.form.fases.quinta_fecha_inicio > this.form.fecha_final ){
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
                else if( this.form.fases.sexta_fecha_final < this.form.fecha_inicio || this.form.fases.sexta_fecha_final > this.form.fecha_final || this.form.fases.sexta_fecha_inicio < this.form.fecha_inicio || this.form.fases.sexta_fecha_inicio > this.form.fecha_final ){
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
                else if( this.form.fases.septima_fecha_final < this.form.fecha_inicio || this.form.fases.septima_fecha_final > this.form.fecha_final || this.form.fases.septima_fecha_inicio < this.form.fecha_inicio || this.form.fases.septima_fecha_inicio > this.form.fecha_final ){
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
                else if( this.form.fases.octava_fecha_final < this.form.fecha_inicio || this.form.fases.octava_fecha_final > this.form.fecha_final || this.form.fases.octava_fecha_inicio < this.form.fecha_inicio || this.form.fases.octava_fecha_inicio > this.form.fecha_final ){
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
                else {
                    let formulario = document.getElementById('formulario');
                    formulario.submit();
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
            aumentarResponsables(){
                if( this.cantidad_responsables < 10 ){
                    this.cantidad_responsables++;
                }
                else {
                    this.alerta_superada = true;
                }
            },
            aumentarObjetivos(){
                if( this.cantidad_objetivos < 10 ){
                    this.cantidad_objetivos++;
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
            
            abrir(){
                alert('Hola');
            },
            abrir2(){
                alert('Hola2');
            },
            cargarDatos(){
                
            }
        },

        mounted(){
            this.cargarDatos();
        },
    }
</script>