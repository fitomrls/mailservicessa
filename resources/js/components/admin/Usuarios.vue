<template>
  <v-app id="inspire">
    <navbar></navbar>
    <v-main>
      <v-container>
        <v-card>
          <v-toolbar height="80px">
            <v-toolbar-title>Usuarios</v-toolbar-title>
            <v-spacer></v-spacer>
            <!-- <nuevonegocio @updateList="nuevoNeg"> </nuevonegocio> -->
          </v-toolbar>
          <v-divider></v-divider>
           <v-sheet
            v-if="!usuarios"
            :color="`grey ${theme.isDark ? 'darken-2' : 'lighten-4'}`"
            class="px-3 pt-3 pb-3"
          >
            <v-skeleton-loader
              class="mx-auto"
              max-width="95vh"
              type="table-heading, table-thead, table-tbody, table-tfoot"
            ></v-skeleton-loader>
          </v-sheet>

          <template v-else style="height: 90vh">
          <div v-for=" (usuario) in usuariosCounter" :key="usuario.id"  > 
            <v-row no-gutters class="py-1">
              <v-col cols="6" sm="1" md="1">
                <div class="px-2 font-weight-thin">##</div>
                <div class="py-4 px-2 font-weight-light">{{ usuario.counter }}.-</div>
              </v-col>
              <v-col cols="6" sm="2" md="2" class="px-2 text-left">
                <div class="font-weight-thin caption">Nombre</div>
                <div class="py-1 font-weight-light caption">
                  {{ usuario.name }}
                </div>
              </v-col>
              <v-col cols="6" sm="2" md="2" class="px-2text-left">
                <div class="font-weight-thin caption">E-mail</div>
                <div class="py-1 font-weight-light caption">
                  {{ usuario.email }}
                </div>                
              </v-col>
              <v-col cols="6" sm="2" md="2" class="px-2 text-left">
                <div class="font-weight-thin caption">Negocio</div>
                <v-chip small color="primary">{{ usuario.nnegocio }}</v-chip>                                
              </v-col>
              <v-col cols="6" sm="2" md="2" class="px-2 text-left">
                <div class="font-weight-thin caption">Estado</div>
                <v-chip v-if="usuario.estadou=='activo'" x-small class="success black--text">{{ usuario.estadou }}</v-chip>
                <v-chip v-else x-small class="danger white--text">{{ usuario.estadou }}</v-chip>
              </v-col>
              <v-col cols="12" sm="2" md="2" class="pt-2 text-center">
                <v-btn fab x-small>e</v-btn>
                <!-- <editarnegocio
                  :usuario="usuario"
                  class="py-4"
                  @updateNegocio="actualizarNegocio"
                ></editarnegocio> -->
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
            }}</v-btn>
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
  name: "adminegocios",
  data() {
    return {
      drawer: null,
      usuarios: [],
      id: 0,
      snackbar: false,
      mensaje: "",
      page: 0,
      pages: 50,
      pagination: null,
      prevDisabled: true,
      nextDisabled: true,
    };
  },
  methods: {
    nuevoNeg(data) {
      this.usuarios.push(data);
      this.mensaje = "Negocio registrado con exito";
      this.snackbar = true;
    },
    actualizarNegocio(data) {
      this.usuarios.map((neg) => {
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
      this.fetchUsuarios();
    },
    previo() {
      this.page = Number(this.pagination.actual_page - 1);
      if (this.page >= 0) {
        this.fetchUsuarios();
      }
    },
    fetchUsuarios() {
      this.usuarios = null;
      this.total = 0;
      let formData = {
        page: this.page,
        pages: this.pages,
      };
      axios({
        url: window.location.origin + "/admin/usuarios/list",
        data: formData,
        method: "POST",
      })
        .then((resp) => {
          this.usuarios = resp.data.result.data;
          this.pagination = {
            first_page: resp.data.result.pagination.first_page,
            actual_page: resp.data.result.pagination.actual_page,
            next_page: resp.data.result.pagination.next_page,
            total: resp.data.result.pagination.total,
            pre_page: resp.data.result.pagination.pre_page,
            pages: resp.data.result.pagination.pages,
            last_page: resp.data.result.pagination.last_page,
          };
          this.prevDisabled = false;
          this.nextDisabled = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  computed: {
    usuariosCounter: function() {
      var counter = Number(this.pagination.actual_page*this.pages +1);
      var res = this.usuarios.map(function(usuario) {
        usuario.counter = counter;
        counter++;
        return usuario;
      });
      return res;
    }
  },
  
  created() {
    this.fetchUsuarios();
  },
};
</script>