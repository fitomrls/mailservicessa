<template>
  <v-app id="inspire">

    <navbar></navbar>

    <v-main>
      <v-container>
        <div class="py-4">
          <nuevacategoria @updateList="nuevaCat"> </nuevacategoria>
        </div>
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">##</th>
                <th class="text-left">Nombre Categoria</th>
                <th class="text-left">Icono</th>
                <th class="text-left">Url</th>
                <th class="text-left">#Negocios</th>
                <th class="text-left">Estado</th>
                <th class="text-left">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(categoria, index) in categorias" :key="categoria.id">
                <td>{{ index + 1 }}</td>
                <td>{{ categoria.cname }}</td>
                <td>{{ categoria.icon }}</td>
                <td>{{ categoria.url }}</td>
                <td>{{ categoria.cuantos }}</td>
                <td>
                  <v-chip
                    v-if="categoria.cstate == 'active'"
                    class="success black--text ma-2"
                    small
                    >activo</v-chip
                  >
                  <v-chip v-else class="danger white--text ma-2" small
                    >inactivo</v-chip
                  >
                </td>
                <td>
                  <editarcategoria
                    :categoria="categoria"
                    @editCat="editarCat"
                  ></editarcategoria>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>

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
//import Navigation from './components/Navigation.vue';
//import NuevaCategoria from '~components/admin/NuevaCategoria.vue';

export default {
  name: "dasadmincategoriasboard",
  data() {
    return {      
      categorias: [],
      cname: "",
      icon: "",
      ecname: "",
      eicon: "",
      id: 0,
      errorCategoria: "",
      estado: false,
      snackbar: false,
      mensaje: "",

    };
  },

  methods: {
    nuevaCat(data) {
      this.categorias.push(data);
      this.mensaje = "Categoria registrada con exito";
      this.snackbar = true;
    },
    editarCat(cate) {
      this.categorias.map((cat) => {
        if (cat.id == cate.id) {
          cat.cname = cate.cname;
          cat.icon = cate.icon;
          cat.url = cate.url;
          if (cate.state) {
            cat.cstate = "active";
          } else {
            cat.cstate = "inactive";
          }
        }
      });

      this.mensaje = "Categoria Actualizada!";
      this.snackbar = true;
    },
  },

  created() {
    axios.get(window.location.origin + "/admin/catlist").then((res) => {
      this.categorias = res.data;
    });
  },
};
</script>