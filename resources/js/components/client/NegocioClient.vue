<template>
  <v-app id="inspire">
    <navbarclient :pageTitle="'Mi Negocio'"></navbarclient>
    <v-main>
      <v-container>
        <v-btn
          color="primary"
          rounded
          style="text-transform: none !important"
          small
          @click="disabled = !disabled"
          :loading="loading"
        >
          Editar
        </v-btn>
        <v-card class="elevation-0">
          <v-card-text>
            <v-form ref="form" v-model="valid" :lazy-validation="lazy">
              <v-row dense no-gutters>
                <v-col cols="12" sm="6" md="6" class="px-2">
                  <v-row dense no-gutters>
                    <v-col cols="12">
                      <v-text-field
                        label="Nombre*"
                        autocomplete="off"
                        v-model="negocio.nnegocio"
                        :disabled="disabled"
                        :rules="requiredRule"
                        :error-messages="errorNombre"
                        rounded
                        required
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="Página Web"
                        type="url"
                        v-model="negocio.web"
                        :disabled="disabled"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="4" md="4">
                      <v-text-field
                        label="Nit"
                        v-model="negocio.nit"
                        :disabled="disabled"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="8" md="8">
                      <v-text-field
                        label="Dirección"
                        v-model="negocio.dir"
                        :disabled="disabled"
                        autocomplete="off"
                        :rules="requiredRule"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="Ubicación (Gmaps)"
                        type="url"
                        v-model="negocio.gmaps"
                        :disabled="disabled"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        label="Teléfono"
                        v-model="negocio.telefonos"
                        :disabled="disabled"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        label="Celular"
                        v-model="negocio.celular"
                        :disabled="disabled"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                          v-model="cats"
                          :items="categorias"
                          :disabled="disabled"
                          :rules="rules.select2"
                          required
                          :error-messages="errorCategoria"
                          chips
                          label="Categorias"
                          item-text="cname"
                          item-value="id"
                          multiple
                          rounded
                          outlined
                        ></v-select>
                    </v-col>
                    <v-col cols="12">
                      <v-switch
                        v-model="delivery"
                        :disabled="disabled"
                        label="¿Servicio Delivery?"
                      ></v-switch>
                    </v-col>
                  </v-row>
                </v-col>
                <v-col cols="12" sm="6" md="6">
                  <div v-if="disabled">
                    <v-img v-if="foto != ''" :src="foto"></v-img>
                  </div>
                  <clipperimage
                    v-else
                    :negocio_id="negocio.id"
                    @setPhoto="setFoto"
                    @cancel="cancelar"
                  >
                  </clipperimage>
                </v-col>
              </v-row>
              <v-row class="py-6">
                <v-col>
                  <v-btn color="blue darken-1" text @click="volver" style="text-transform: none !important">
                    Cerrar
                  </v-btn>
                  <v-btn
                    color="primary"
                    rounded
                    @click="confirmar = true"
                    :disabled="!valid"
                    style="text-transform: none !important"
                  >
                    Actualizar
                  </v-btn>
                </v-col>
              </v-row>
            </v-form>
            <small>*campo obligatorio</small>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
          </v-card-actions>
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

    <v-dialog v-model="confirmar" max-width="290">
      <v-card>
        <v-card-title class="headline"> ¿Guardar Cambios? </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn 
            color="green darken-1"
            text @click="volver">
          Cancelar </v-btn>
          <v-btn 
            color="green darken-1"
            text @click="update"
            :loading="loading"
          >
            Guardar </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <footerclient></footerclient>
  </v-app>
</template>

<script>
export default {
  name: "NegocioClient",

  data() {
    return {
      lazy: false,
      valid: false,
      disabled: true,
      loading: false,
      emailRules: [
        (v) => !!v || "E-mail es requerido",
        (v) => !!v || "E-mail es requerido",
        (v) => /.+@.+\..+/.test(v) || "E-mail invalido",
      ],

      requiredRule: [(v) => !!v || "Campo es requerido"],
      rules: {
        select: [(v) => !!v || "Categoria es requirida"],
        select2: [(v) =>  v.length>0 || "Al menos una Categoria es requirida"],      
      },

      errorNombre: "",
      negocio: {
        nnegocio: "",
        nit: "",
        dir: "",
        gmaps: "",
        telefonos: "",
        celular: "",
        web: "",
        //logo: "",
        email: "",
        id: 0,
      },
      delivery: false,
      snackbar: false,
      mensaje: "",
      //agregado
      compra: false,
      foto: "",
      confirmar: false,
      cats: [],
      categorias: [],
      errorCategoria: ""
    }
  },

  methods: {
    update() {
      if (this.$refs.form.validate()) {
        this.loading = true
        let fData = {
          id: this.negocio.id,
          nnegocio: this.negocio.nnegocio,
          nit: this.negocio.nit,
          dir: this.negocio.dir,
          gmaps: this.negocio.gmaps,
          telefonos: this.negocio.telefonos,
          celular: this.negocio.celular,
          delivery: this.negocio.delivery,
          web: this.negocio.web,
          compra: this.negocio.compra,
          cats: this.cats
        }

        axios({
          url:
            window.location.origin + "/user/updatenegocio/" + this.negocio.id,
          data: fData,
          method: "POST",
        })
          .then((resp) => {
            if (resp.data.success) {
              fData.id = this.negocio.id
              this.loading = false
              this.$emit("updateNegocio", fData)
              this.confirmar = false
            }
          })
          .catch((err) => {
            if (err.response.status == 422) {
              this.errorNombre =
                "Ya existe " + this.negocio.nnegocio + ", elija otro"
              this.loading = false
            }
          })
      }
    },

    volver() {
      window.history.go(-1)
    },

    setFoto(foto) {
      this.foto = foto
      this.disabled = !this.disabled
      this.mensaje = "Imagen Guardada con exito!"
      this.snackbar = true
    },

    cancelar() {
      this.disabled = !this.disabled
    },
  },

  created() {
    axios({
      url: window.location.origin + "/user/minegocio",
      method: "GET",
    })
      .then((resp) => {
        this.negocio = resp.data.negocio
        this.categorias = resp.data.categorias
        
        this.negocio.categorias.forEach(element => {
          this.cats.push(element.id)
        })

        this.foto = this.negocio.logo
        //agregado
        if (this.negocio.delivery == 0) {
          this.delivery = false
        } else {
          this.delivery = true
        }
        //agregado
        if (this.negocio.compra == 0) {
          this.compra = false
        } else {
          this.compra = true
        }
      })
      .catch((error) => {
        console.log(error)
      })
  },
}
</script>

<style scoped>
  input[type="file"] {
    display: none;
  }
  .placeholder {
    background-color: lightgray;
    padding: 1rem;
    color: white;
  }
</style>