<template>
    <v-card>
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

        <main>
            <v-parallax src="/img/Marketing/fondo.jpg">
                <v-container class="pa-4 text-center">
                    <v-row
                        class="fill-height"
                        align="center"
                        justify="center"
                    >
                        <template v-for="(item, i) in items" :key="i">
                            <v-col
                            cols="12"
                            md="6"
                            >
                                <v-hover v-slot="{ isHovering, props }">
                                  <a :href="item.href">
                                    <v-card
                                        :elevation="isHovering ? 12 : 2"
                                        :class="{ 'on-hover': isHovering }"
                                        class="v-card2"
                                        v-bind="props"
                                    >
                                        <v-img
                                            :src="item.img"
                                            height="224px"
                                            cover
                                        >
                                            <v-card-title class="espacio text-h6 text-white d-flex flex-column">
                                                <p class="margin" style="font-size: 2em; font-weight: bolder; text-shadow: 5px 10px 2px black;">
                                                    {{ item.title }}
                                                </p>
                                            </v-card-title>
                                        </v-img>
                                    </v-card>
                                  </a>
                                </v-hover>
                            </v-col>
                        </template>
                    </v-row>
                </v-container>
            </v-parallax>
        </main>
    </v-card>
</template>

<style scoped>
    a {
        text-decoration: none;
        color: #fff;
        cursor: pointer;
    }

    .v-card {
      max-height: 100vh;
    }
  .v-card2 {
    transition: opacity .4s ease-in-out;
    cursor: pointer;
  }

  .v-card2:not(.on-hover) {
    opacity: 0.7;
  }

  .show-btns {
    color: 1 !important;
  }

  .espacio {
    height: 100%;
  }

  .margin {
    height: 100%;
    margin-top: 2em;
    -webkit-text-stroke: 2px black;
    color: gainsboro;
  }
</style>

<script>
  export default {
    data: () => ({
      items: [
        {
          title: 'Estrategias',
          img: '/img/Marketing/estrategias4.avif',
          href: '/jetfilter/marketing/estrategias'
        },
        {
          title: 'Presupuesto',
          img: '/img/Marketing/Dinero2.jpg',
          href: '/jetfilter/marketing/presupuesto'
        },
        {
          title: 'Proyección',
          img: '/img/Marketing/estrategias2.jpg',
          href: '/jetfilter/marketing/proyeccion'
        }
      ],
      transparent: 'rgba(255, 255, 255, 0)',
    }),
  }
</script>