<template>
  <v-app id="inspire">

    <navbarclient :pageTitle="'Mis Productos'"></navbarclient>

    <v-main>
      <v-container>
        <div class="py-4">
          <!--<nuevoproducto :negocio_id="negocio.id"
                         @updateList="nuevoProd"></nuevoproducto>-->
          <nuevoproducto :negocio="negocio"
                         @updateList="nuevoProd">
          </nuevoproducto>               
        </div>
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">##</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Precio (Bs.)</th>
                <th class="text-left">Tipo Producto</th>
                <th class="text-left">Estado</th>
                <th class="text-left">Opciones</th>
              </tr>
            </thead>
            <!--<tbody  v-for="negocio in negocios"
                    :key="negocio.id"
                    cols="6">-->
            <tbody class="100vh" v-if="negocio != null">        
              <tr v-for="(producto, index) in productos" :key="producto.id">
                <td>{{ index + 1 }}</td>
                <td>{{ producto.nombre }}</td>
                <td><v-chip>{{ producto.precio_oferta }}</v-chip></td>
                <td>{{ producto.tipoproducto }}</td>
                <!--<td>{{ producto.negocio_id }}</td>-->
                <td>
                  <v-chip
                    v-if="producto.estado_prod == 'activo'"
                    class="success black--text ma-2"
                    small 
                    >activo</v-chip
                  >
                  <v-chip v-else class="danger white--text ma-2" small
                    >inactivo</v-chip
                  >
                </td>
                <td>
                <!--<v-col
                 cols="12"
                 class="py-2"
                >
                <v-btn value="left">
                 <editarproducto
                    :negocio="negocio"
                    :producto="producto"
                    @editProd="editarProd"
                  ></editarproducto>
                </v-btn>
               </v-col>-->
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
                 <editarproducto
                    :negocio="negocio"
                    :producto="producto"
                    @editProd="editarProd"
                  ></editarproducto>
                </v-btn>

                <v-btn value="center">
                 <detalleproducto  
                    :producto="producto"

                 ></detalleproducto>
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
      <!--<pre>{{productos}}</pre>-->
    </v-main>
    <footerclient></footerclient>
  </v-app>
</template>

<script>

export default {
  name: "clientProductos",
  data() {
    return {      
      //producto: {
      nombre: "",
      descripcion: "",
      precio_oferta: 0,
      precio_regular: 0,
      tipoproducto: "",
      estado_prod: false,
      id: 0,
      //},
      errorProducto: "",
      snackbar: false,
      mensaje: "",
      drawer: null,
      text: "",
      productos: [],
      //negocios: [],
      negocio: null,
    };
  },

  methods: {
    nuevoProd(data) {
      this.productos.push(data);
      this.mensaje = "Producto registrado con exito";
      this.snackbar = true;
    },
    editarProd(produ) {
      this.productos.map((prod) => {
        if (prod.id == produ.id) {
          prod.titulo = produ.nombre;
          prod.descripcion = produ.descripcion;
          prod.precio_oferta = produ.precio_oferta;
          prod.precio_regular = produ.precio_regular;
          prod.tipoproducto = produ.tipoproducto;
          if (produ.estado_prod) {
            prod.estado_prod = "activo";
          } else {
            prod.estado_prod = "inactivo";
          }
        }
      });

      this.mensaje = "Producto Actualizado!";
      this.snackbar = true;
    },
  },

  created() {
    //axios.get(window.location.origin + "/client/prodlist").then((res) => {
    axios.post(window.location.origin + "/user/lista/productos").then((res) => {
      this.negocio = res.data.result.negocio
      this.productos = res.data.result.productos
    });
  },
};
</script>