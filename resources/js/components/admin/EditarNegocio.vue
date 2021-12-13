<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent fullscreen max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn dark x-small color="primary" fab v-bind="attrs" v-on="on">
          <v-icon>mdi-pencil-outline</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Editar Negocio</span>
        </v-card-title>
        <v-card-text>
        <v-btn
          color="primary"
          rounded
          style="text-transform: none !important"
          small
          @click="disabled = !disabled"
        >
          Editar
        </v-btn>
          <v-container>
            <v-form ref="form" v-model="valid" :lazy-validation="lazy">
              <v-row dense no-gutters>
                <v-col cols="12" sm="6" md="6" class="px-2">
                  <v-row dense no-gutters>
                    <v-col cols="12">
                      <v-text-field
                        label="Nombre*"
                        autocomplete="off"
                        v-model="nnegocio"
                        :rules="requiredRule"
                        :error-messages="errorNombre"
                        :disabled="disabled"
                        rounded
                        required
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        :disabled="disabled"
                        label="Página Web"
                        type="url"
                        v-model="web"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="4" md="4">
                      <v-text-field
                        :disabled="disabled"
                        label="Nit"
                        v-model="nit"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="8" md="8">
                      <v-text-field
                        label="Dirección"
                        v-model="dir"
                        autocomplete="off"
                        :rules="requiredRule"
                        :disabled="disabled"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        :disabled="disabled"
                        label="Ubicación (Gmaps)"
                        type="url"
                        v-model="gmaps"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        :disabled="disabled"
                        label="Teléfono"
                        v-model="telefonos"
                        autocomplete="off"
                        rounded
                        outlined
                        dense
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        :disabled="disabled"
                        label="Celular"
                        v-model="celular"
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
                        label="¿Serivicio Delivery?"
                      ></v-switch>
                    </v-col>
                  </v-row>
                </v-col>
                <v-col cols="12" sm="6" md="6">
                  <div
                  v-if="!verclipper"
                  >
                    <v-img v-if="foto != ''" :src="foto"></v-img>
                    <v-btn 
                      small
                      rounded
                      class="primary"
                      :disabled="disabled"
                      @click="verclipper=true"
                    >
                      cambiar</v-btn>
                  </div>
                  <clipperimage2
                    v-if="verclipper"
                    ref="clipper1"
                    key="clipper1"
                    :negocio_id="negocio.id"
                    @setPhoto="setFoto"
                    @cancel="cancelar"
                  >
                  </clipperimage2>
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
            @click="update"
            :disabled="!valid"
            :loading="loading"
          >
            Actualizar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  name: "EditarNegocio",
  props: {
    negocio: Object,
    categorias: Array
  },

  data() {
    return {
      dialog: false,
      lazy: false,
      valid: false,
      disabled: false,
      loading: false,

      nnegocio: "",
      nit: "",
      dir: "",
      gmaps: "",
      telefonos: "",
      celular: "",
      delivery: false,
      web: "",
      logo: "",
      email: "",
      emailRules: [
        (v) => !!v || "E-mail es requerido",
        (v) => !!v || "E-mail es requerido",
        (v) => /.+@.+\..+/.test(v) || "E-mail invalido",
      ],

      clave: "",
      claveErrors: "",
      reclave: "",
      reclaveErrors: "",

      requiredRule: [(v) => !!v || "Campo es requerido"],
      errorNombre: "",
      cats: [],
      errorCategoria: "",
      rules: {
        select: [(v) => !!v || "Categoria es requirida"],
        select2: [(v) =>  v.length>0 || "Al menos una Categoria es requirida"],      
      },
      foto: "",
      disabled: true,
      result: "",
      verclipper: false
    }
  },

  methods: {
    update() {
      if (this.$refs.form.validate()) {
        this.loading = true
        if (this.result != "") {
            const formData = new FormData()
            //let foto1 = this.$refs.clipper.result
            formData.append("imagen", this.result)
            formData.append("type", "jpg")
            axios.post(window.location.origin + "/admin/files", formData, {
                headers: { "Content-Type": "multipart/form-data" },
            }).then((response) => {
                this.updateNegocio(response.data.imageName)
            }).catch((err) => {
                console.error(err)
            })
          
        } else {
          this.updateNegocio(this.negocio.logo)
        }
      }
    },

    updateNegocio(respuesta){
        let fData = {
          nnegocio: this.nnegocio,
          nit: this.nit,
          dir: this.dir,
          gmaps: this.gmaps,
          telefonos: this.telefonos,
          celular: this.celular,
          delivery: this.delivery,
          web: this.web,
          logo: respuesta,
        }

        axios({
          url: window.location.origin + "/admin/negocios/" + this.negocio.id,
          data: fData,
          method: "PUT",
        })
          .then((resp) => {
            if (resp.data.success) {
              fData.id = this.negocio.id
              this.loading = false
              this.dialog = false
              this.$emit("updateNegocio", fData)
            }
          })
          .catch((err) => {
            if (err.response.status == 422) {
              this.errorNombre = "Ya existe " + this.cname + ", elija otro"
              this.loading = false
            }
          })
    },

    setFoto(picture, result){
      this.foto = picture
      this.result = result
      this.verclipper = false
    },
    cancelar(){
      this.disabled = false      
    },
    desactivarForm(){
      this.disabled = true
    }

  },

  watch: {
    dialog(val) {},
  },

  created() {
    this.nnegocio = this.negocio.nnegocio
    this.web = this.negocio.web
    this.nit = this.negocio.nit
    this.dir = this.negocio.dir
    this.gmaps = this.negocio.gmaps
    this.telefonos = this.negocio.telefonos
    this.celular = this.negocio.celular
    this.foto = this.negocio.logo
    if (this.negocio.delivery == 0) {
      this.delivery = false
    } else {
      this.delivery = true
    }

    this.negocio.categorias.forEach(element => {
        this.cats.push(element.id)
    })

  },
}
</script>
<style scoped>

</style>