<template>
  <v-app id="inspire">
    <navbar></navbar>
    <v-main>
      <v-container>
        <v-card>
          <v-toolbar height="80px">
            <v-toolbar-title>Negocios</v-toolbar-title>
            <v-spacer></v-spacer>
            <nuevonegocio
              @updateList="nuevoNeg"
              :categorias="categorias"
            ></nuevonegocio>
          </v-toolbar>
          <v-divider></v-divider>
           <v-sheet
            v-if="!negocios"
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
          <div v-for=" (negocio) in negocios" :key="negocio.id"> 
            <v-row no-gutters class="py-1">
              <v-col cols="6" sm="1" md="1">
                <div class="px-2 font-weight-thin">##</div>
                <div class="py-4 px-2 font-weight-light">{{ negocio.cuenta }}.-</div>
              </v-col>
              <v-col cols="6" sm="1" md="1" class="py-3">
                <v-avatar>
                  <img :src="getImage(negocio.logo)" alt="" />
                </v-avatar>
              </v-col>
              <v-col cols="6" sm="2" md="2" class="px-2 text-left">
                <div class="font-weight-thin caption">Nombre Negocio</div>
                <div class="py-1 font-weight-light caption">
                  {{ negocio.nnegocio }}
                </div>
                <v-divider class="d-md-none"></v-divider>
              </v-col>
              <v-col cols="6" sm="2" md="2" class="px-2text-left">
                <div class="font-weight-thin caption">Dirección</div>
                <div class="py-1 font-weight-light caption">
                  {{ negocio.dir }}
                </div>
                <v-divider class="d-md-none"></v-divider>
              </v-col>
              <v-col cols="6" sm="2" md="2" class="px-2 text-left">
                <div class="font-weight-thin caption">Telefonos</div>
                <v-chip x-small color="primary">{{ negocio.telefonos }}</v-chip>
                <v-chip x-small color="secundary">{{ negocio.celular }}</v-chip>
                <v-divider class="d-md-none"></v-divider>
              </v-col>
              <v-col cols="6" sm="2" md="2" class="px-2 text-left">
                <div class="font-weight-thin caption">Categoria(s)</div>
                <div class="py-1 font-weight-light">
                  <v-chip
                    v-for="cat in negocio.categorias"
                    :key="cat.id"
                    x-small
                    class="success black--text"
                    >{{ cat.cname }}</v-chip
                  >
                </div>
                <v-divider class="d-md-none"></v-divider>
              </v-col>
              <v-col cols="12" sm="2" md="2" class="pt-2 text-center">
                <editarnegocio
                  :negocio="negocio"
                  :categorias="categorias"
                  class="py-4"
                  @updateNegocio="actualizarNegocio"
                ></editarnegocio>
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
            <v-btn small class="mx-2 py-2">{{
              pagination.actual_page + 1
            }}/{{pagination.last_page}}</v-btn>
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
  //inject: ["theme"],
  inject: {
      theme: {
        default: { isDark: false },
      },
    },
  name: "adminegocios",
  data() {
    return {
      drawer: null,
      negocios: null,
      id: 0,
      snackbar: false,
      mensaje: "",
      page: 0,
      pages: 50,
      pagination: {
        cuenta: 1
      },
      prevDisabled: true,
      nextDisabled: true,
      categorias: []
    };
  },
  methods: {
    nuevoNeg(data) {
      this.negocios.push(data);
      this.mensaje = "Negocio registrado con exito";
      this.snackbar = true;
    },
    actualizarNegocio(data) {
      this.negocios.map((neg) => {
        if (neg.id == data.id) {
          neg.nnegocio = data.nnegocio;
          neg.nit = data.nit;
          neg.dir = data.dir;
          neg.gmaps = data.gmaps;
          neg.telefonos = data.telefonos;
          neg.celular = data.celular;
          neg.delivery = data.delivery;
          neg.web = data.web;
          neg.logo = data.logo;
        }
      });
      this.mensaje = "Negocio Actualizado!";
      this.snackbar = true;
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
      this.fetchNegocios();
    },
    previo() {
      this.page = Number(this.pagination.actual_page - 1);
      if (this.page >= 0) {
        this.fetchNegocios();
      }
    },
    fetchNegocios() {
      //pruebas
      this.negocios = null;
      this.total = 0;
      let formData = {
        page: this.page,
        pages: this.pages,
        cuenta: this.pagination.cuenta
      };
      axios({
        url: window.location.origin + "/admin/lista/negocios",
        data: formData,
        method: "POST",
      })
        .then((resp) => {
          this.negocios = resp.data.result.data;
          this.categorias = resp.data.result.categorias;
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
          this.prevDisabled = false;
          this.nextDisabled = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  
  created() {
    this.fetchNegocios();
  },
};
</script>