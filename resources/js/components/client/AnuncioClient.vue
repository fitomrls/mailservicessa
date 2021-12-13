<template>
  <v-app id="inspire">
    <navbarclient :pageTitle="'Mis Anuncios'"></navbarclient>

    <v-main>
      <v-container>
        <v-card class="100vh elevation-0" v-if="negocio != null" >
          <v-toolbar height="80px">
              <v-toolbar-title>Anuncios - {{ negocio.nnegocio }}</v-toolbar-title>
              <v-spacer></v-spacer>
              <nuevoanuncio
                :negocio="negocio"
                :paquetes="paquetes"
                @addNew="agregar"
              ></nuevoanuncio>
          </v-toolbar>
          <v-divider></v-divider>
          <v-sheet
              v-if="!anuncios"
              :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
              class="px-3 pt-3 pb-3"
            >
              <v-skeleton-loader
                class="mx-auto"
                max-width="90vh"
                type="table-heading, table-thead, table-tbody, table-tfoot"
              ></v-skeleton-loader>
          </v-sheet>
          <v-card-text v-else fluid class="elevation-0">
            <v-row dense>
              <v-col
                v-for="anuncio in anuncios"
                :key="anuncio.codigo"
                cols="12" sm="3" md="3"
              >
                <div class="boxi">
                 <template v-if="anuncio.paquetes!=null">
                    <template                      
                        v-for=" paquete in anuncio.paquetes"
                    >
                      <div
                          v-if="paquete.tipo=='esquinero'"
                          class="ribbon ribbon-top-left"
                          :key="paquete.id"
                      >
                          <span v-bind:style="{ 'background-color': paquete.color, }">
                              {{paquete.label}}
                          </span>
                      </div>
                    </template>
                 </template>

                 <cardclient
                  :anuncio="anuncio"
                  :negocio="negocio"
                 >
                 </cardclient>

                </div>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-container>
    </v-main>
    <v-snackbar v-model="snackbar" :timeout="6000" top color="success">
      <p class="title blackblue--text float-left">{{ mensaje }}</p>
      <v-btn
        small
        icon
        class="success black--text float-right"
        text
        @click="snackbar = false"
        >x</v-btn
      >
    </v-snackbar>
    <footerclient></footerclient>
  </v-app>
</template>

<script>
export default {
  inject: {
    theme: {
      default: { isDark: false },
    },
  },
  name: "PaqueteClient",
  data() {
    return {
      drawer: null,
      paquete: {
        titulo: "",
        descripcion: "",
        costo: "",
      },
      snackbar: false,
      mensaje: "",
      paquetes: [],
      negocio: null,
      anuncios: [],
      /*paginacion*/
      /*page: 0,
      pages: 20,
      pagination: {
        cuenta: 1,
      },
      prevDisabled: true,
      nextDisabled: true,*/
    };
  },

  methods: {
    comprarPaq(paque) {
      this.paquetes.map((paq) => {
        if (paq.id == paque.id) {
          paq.codigo = paque.codigo;
        }
      });

      this.mensaje = "Paquete comprado con exito!";
      this.snackbar = true;
    },
    fetchAnuncios() {
      this.anuncios = null;
      this.total = 0;
      let formData = {
        page: this.page,
        pages: this.pages,
        cuenta: this.pagination.cuenta,
      };
      axios({
        url: window.location.origin + "/user/lista/anuncios",
        data: formData,
        method: "POST",
      })
        .then((resp) => {
          this.anuncios = resp.data.result.data;
          //this.anuncio = resp.data.result.data;
          /*this.pagination = {
            first_page: resp.data.result.pagination.first_page,
            actual_page: resp.data.result.pagination.actual_page,
            next_page: resp.data.result.pagination.next_page,
            total: resp.data.result.pagination.total,
            pre_page: resp.data.result.pagination.pre_page,
            pages: resp.data.result.pagination.pages,
            last_page: resp.data.result.pagination.last_page,
            cuenta: resp.data.result.pagination.cuenta,
          };
          this.prevDisabled = false;
          this.nextDisabled = false;*/
        })
        .catch((error) => {
          console.log(error);
        });
    },
    agregar(anuncio){
      this.anuncios.push(anuncio)
      this.mensaje = "Anuncio creado con Exito!"
      this.snackbar = true
    }
  },

  mounted() {
    axios({
      url: window.location.origin + "/user/mipaquete",
      method: "GET",
    })
      .then((resp) => {
        this.paquetes = resp.data.data.paquetes;
        this.negocio = resp.data.data.negocio;
        this.anuncios = resp.data.data.anuncios;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style>
  .sin{
    text-transform: none !important;
  }


</style>