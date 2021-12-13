<template>
  <v-app id="inspire">
    <navbar></navbar>
    <v-main>
      <v-container>
        <v-card>
          <v-toolbar height="80px">
            <v-toolbar-title>Anuncios</v-toolbar-title>
            <v-spacer></v-spacer>
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

          <template v-else style="height: 90vh">
            <div v-for=" anuncio in anuncios" :key="anuncio.id">
                <v-row
                    no-gutters class="py-1"
                >
                  <v-col cols="6" sm="1" md="1">
                      <div class="px-2 font-weight-thin caption">##</div>
                      <div class="py-2 px-2 font-weight-light">{{ pagination.cuenta }}</div>
                  </v-col>
                  <v-col cols="6" sm="4" md="4">
                      <div class="caption font-weight-thin caption">Negocio</div>
                      <div>{{ anuncio.negocio.nnegocio }}</div>
                  </v-col>
                  <v-col cols="8" sm="3" md="3">
                      <div class="caption font-weight-thin caption">Título</div>
                      <div class="font-weight-regular">{{ anuncio.titulo }}</div>
                      <div class="caption font-weight-thin caption">{{ anuncio.created_at | fecha }}</div>
                  </v-col>
                  <v-col cols="2" sm="2" md="2">
                      <div class="caption font-weight-thin caption">Estado</div>
                      <div>
                      <v-chip v-if="anuncio.estadoanuncio=='activo'" class="success secondary--text" small>{{ anuncio.estadoanuncio }}</v-chip>
                      <v-chip dark v-else class="danger" small>{{ anuncio.estadoanuncio }}</v-chip>
                      </div>
                  </v-col>
                  <v-col cols="2" sm="2" md="2">
                      <div class="caption">Opciones</div>
                      <div>
                        <menucard
                          :anuncio="anuncio"
                          :negocio="anuncio.negocio"
                          @updateAnuncio="actualizarAnuncio"
                        >
                        </menucard>
                      </div>
                  </v-col>
                </v-row>
                <v-divider></v-divider>
            </div>  
          </template>

          <div class="text-center py-2 graysuave" v-if="pagination != null">
            <v-btn
              small
              class="mx-2 py-2"
              :disabled="prevDisabled"
              @click="previo"
            >
              <v-icon small large>mdi-arrow-left-circle</v-icon>
            </v-btn>
            <v-btn small class="mx-2 py-2"
              >{{ pagination.actual_page + 1 }}/{{
                pagination.last_page
              }}</v-btn
            >
            <v-btn
              small
              class="mx-2 py-2"
              :disabled="nextDisabled"
              @click="siguiente"
            >
              <v-icon small large>mdi-arrow-right-circle</v-icon>
            </v-btn>
          </div>
        </v-card>
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
      </v-container>
    </v-main>
  </v-app>
</template>

<script>

export default {  
  inject: {
      theme: {
        default: { isDark: false },
      },
  },
  name: "adminanuncios",
  data() {
    return {
      anuncios: null,
      snackbar: false,
      mensaje: "",
      page: 0,
      pages: 50,
      pagination: {
        cuenta: 1,
      },
      prevDisabled: true,
      nextDisabled: true,
    };
  },
  methods: {
    fetchAnuncios() {
      this.anuncios = null
      this.total = 0
      let formData = {
        page: this.page,
        pages: this.pages,
        cuenta: this.pagination.cuenta,
      };
      axios({
        url: window.location.origin + "/admin/lista/anuncios",
        data: formData,
        method: "POST",
      })
        .then((resp) => {
          this.anuncios = resp.data.result.data;
          this.pagination = {
            first_page: resp.data.result.pagination.first_page,
            actual_page: resp.data.result.pagination.actual_page,
            next_page: resp.data.result.pagination.next_page,
            total: resp.data.result.pagination.total,
            pre_page: resp.data.result.pagination.pre_page,
            pages: resp.data.result.pagination.pages,
            last_page: resp.data.result.pagination.last_page,
            cuenta: resp.data.result.pagination.cuenta,
          };
          this.prevDisabled = false
          this.nextDisabled = false
        })
        .catch((error) => {
          console.log(error)
        })
    },
    getImage(image) {
      if (image == "" || image == null) {
        return window.location.origin + "/storage/images/default.jpeg";
      } else {
        return image.substring(0, image.lastIndexOf("/")) +"/thumbnail/" + image.substring(image.lastIndexOf("/") + 1)
      }
    },
    siguiente() {
      this.page = Number(this.pagination.actual_page + 1);
      this.cuenta = Number(this.pagination.cuenta)
      this.fetchAnuncios();
    },
    previo() {
      this.page = Number(this.pagination.actual_page - 1);
      if (this.page >= 0) {
        this.fetchAnuncios();
      }
    },
    actualizarAnuncio(data){
      
      this.anuncios.map( element =>{
        if(element.id==data.id){
          if(data.state){
            element.estadoanuncio = 'activo'
          }else{
            element.estadoanuncio = 'inactivo'
          }
          return element
        }
      })

    }
  },
  created() {
    this.fetchAnuncios()
  },
  filters: {
      fecha: function(value) {
          return value.substring(0,10)
      }
  }
};
</script>

<style lang="scss" scoped>
</style>