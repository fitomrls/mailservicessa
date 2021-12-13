<template>
  <v-app id="inspire">

    <navbar></navbar>

    <v-main>
      <v-container>

        <div class="py-4">
          <nuevopaquete @updateList="nuevoPaq"></nuevopaquete>
        </div>
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">##</th>
                <th class="text-left">Título</th>
                <!--<th class="text-left">Descripción</th>-->
                <th class="text-left">Costo (Bs.)</th>
                <th class="text-left">Tiempo (Meses)</th>
                <th class="text-left">Orden</th>
                <!--<th class="text-left">Fecha-Límite</th>-->
                <th class="text-left">Tipo</th>
                <th class="text-left">Etiqueta</th>
                <th class="text-left">Estado</th>
                <th class="text-left">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(paquete, index) in paquetes" :key="paquete.id">
                <td>{{ index + 1 }}</td>
                <td>{{ paquete.titulo }}</td>
                <!--<td>{{ paquete.descripcion }}</td>-->
                <td>{{ paquete.costo }}</td>
                <td>{{ paquete.tiempo }}</td>
                <td>{{ paquete.orden }}</td>
                <!--<td>{{ paquete.fecha_limite }}</td>-->
                <td>{{ paquete.tipopaquete }}</td>
                <td><v-chip small :color="paquete.color">{{ paquete.label }}</v-chip></td>
                <td>
                  <v-chip
                    v-if="paquete.estado == 'activo'"
                    class="success black--text ma-2"
                    small 
                    >activo</v-chip
                  >
                  <v-chip v-else class="danger white--text ma-2" small
                    >inactivo</v-chip
                  >
                </td>
                <td>
                <v-col
                 cols="12"
                 class="py-2"
                >
                <v-btn-toggle
                 v-model="text"
                 tile
                 color="deep-purple accent-3"
                 group
                >
                <v-btn value="left">
                 <editarpaquete
                    :paquete="paquete"
                    @editPaq="editarPaq"
                  ></editarpaquete>
                </v-btn>

                <v-btn value="center">
                 <detallepaquete  
                    :paquete="paquete"

                 ></detallepaquete>
                 </v-btn>
                </v-btn-toggle>
               </v-col>
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

export default {
  name: "adminPaquetes",
  data() {
    return {      
      paquetes: [],
      titulo: "",
      descripcion: "",
      costo: "",
      tiempo: "",
      orden: "",
      //fecha_limite: "",
      tipopaquete: "",
      label: "",
      color: "",
      id: 0,
      errorPaquete: "",
      estado: false,
      snackbar: false,
      mensaje: "",
      drawer: null,
      text: "",
      //para el menu 
      //fav: true,
      //menu: false,
      //message: false,
      //hints: true,
    };
  },

  methods: {
    nuevoPaq(data) {
      this.paquetes.push(data);
      this.mensaje = "Paquete registrado con exito";
      this.snackbar = true;
    },
    editarPaq(paque) {
      this.paquetes.map((paq) => {
        if (paq.id == paque.id) {
          paq.titulo = paque.titulo;
          paq.descripcion = paque.descripcion;
          paq.costo = paque.costo;
          paq.tiempo = paque.tiempo;
          paq.orden = paque.orden;
          //paq.fecha_limite = paque.fecha_limite;
          paq.tipopaquete = paque.tipopaquete;
          paq.label = paque.label;
          paq.color = paque.color;
          if (paque.estado) {
            paq.estado = "activo";
          } else {
            paq.estado = "inactivo";
          }
        }
      });

      this.mensaje = "Paquete Actualizado!";
      this.snackbar = true;
    },
  },

  created() {
    axios.get(window.location.origin + "/admin/paqlist").then((res) => {
      this.paquetes = res.data;
    });
  },
};
</script>