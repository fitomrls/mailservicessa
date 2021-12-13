<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn class="success black--text" dark large v-bind="attrs" v-on="on">
          Nuevo Producto
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Nuevo Producto</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-form ref="form" v-model="valid" :lazy-validation="lazy">
              <v-row dense>
                <v-col cols="12">
                  <v-text-field dense
                    label="Nombre*"
                    autocomplete="off"
                    v-model="nombre"
                    :rules="requiredRule"
                    :error-messages="errorNombre"
                    rounded
                    required
                    filled
                    style="text-transform: capitalize;"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea dense
                    label="Descripción"
                    :rules="requiredRule"
                    :error-messages="errorDesc"
                    v-model="descripcion"
                    rounded
                    filled
                    rows="2"
                  ></v-textarea>
                </v-col>
                <v-col cols="12">
                  <v-text-field dense
                    label="Precio Regular"
                    v-model="precio_regular"
                    autocomplete="off"
                    rounded
                    filled
                    suffix="Bs."
                    type="number"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field dense
                    label="Precio Oferta"
                    v-model="precio_oferta"
                    autocomplete="off"
                    rounded
                    filled
                    suffix="Bs."
                    type="number"
                  ></v-text-field>
                </v-col>  
                <v-col cols="12">
                  <v-text-field dense
                    label="Tipo Producto"
                    autocomplete="off"
                    v-model="tipoproducto"
                    rounded
                    required
                    filled
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-form>
          </v-container>
          <small>*campo obligatorio</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">
            Cerrar
          </v-btn>
          <v-btn
            color="primary"
            rounded
            @click="crear"
            :disabled="!valid"
            :loading="loading"
          >
            Crear
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {

  name: "NuevoProducto",
  props: {
    //negocio_id: Integer,
    negocio: Object,
  },
  data() { 
    return {
      dialog: false,
      lazy: false,
      valid: false,
      disabled: false,
      loading: false,

      nombre: "",
      errorNombre: "",
      requiredRule: [(v) => !!v || "Este Campo es requerido"],
      descripcion: "",
      errorDesc: "",
      requiredRule: [(v) => !!v || "Este Campo es requerido"],
      precio_regular: 0,
      precio_oferta: 0,
      //negocio_id: 0,
      id: 0,
      //errorCosto: "",
       //numberRule: v  => {
         //if (!v.trim()) return true;
         //if (!isNaN(parseFloat(v)) && v >= 0 && v <= 999) return true;
         //return 'Number has to be between 0 and 999';
          //},
      tipoproducto: "", 
      negocios: [],   
    };
  },

  methods: {
    crear() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        let fData = {
          nombre: this.nombre,
          descripcion: this.descripcion,
          precio_oferta: this.precio_oferta,
          precio_regular: this.precio_regular,
          tipoproducto: this.tipoproducto,
          //id: this.negocio_id,
          n_id: this.negocio.id,
        };

        axios({
          url: window.location.origin+"/user/productos/crear",
          //url: window.location.origin+"/client/productos",
          //url: window.location.origin+"/user/lista/productos",
          data: fData,
          method: "POST",
        })
          .then((resp) => {
            if (resp.data.success) {
              fData.estado_prod = "activo";
              fData.id = resp.data.data.id;
              fData.nombre = resp.data.data.nombre;              
              this.descripcion = "";
              this.precio_oferta = "";
              this.precio_regular = "";
              this.tipoproducto = "";
              this.negocio_id = 0,
              this.loading = false;
              this.dialog = false
              this.$emit('updateList',fData)
            }
          })
          .catch((err) => {
            if (err.response.status == 422) {
              //console.log(err.response);
              this.errorNombre = "Ya existe " + this.nombre + ", elija otro";
              this.loading = false;
            }
          });
      }

    },
  },

  watch: {
    dialog(val) {},
  },
};
</script>