<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="800px"
      :fullscreen="fullscreen"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          large
          rounded
          class="success black--text"
          v-bind="attrs"
          v-on="on"
          >Nuevo</v-btn
        >
      </template>
      <v-card>
        <v-system-bar window dark>
          <v-icon>mdi-message</v-icon>
          <v-spacer></v-spacer>
          <v-btn x-small icon @click="fullscreen = false">
            <v-icon>mdi-view-compact</v-icon>
          </v-btn>
          <v-btn x-small icon @click="fullscreen = true">
            <v-icon>mdi-aspect-ratio</v-icon>
          </v-btn>
          <v-btn x-small icon>
            <v-icon @click="dialog = false">mdi-close</v-icon>
          </v-btn>
        </v-system-bar>
        <v-card-title>
          <span class="headline">Nuevo Anuncio</span>
        </v-card-title>
        <v-card-subtitle>{{ negocio.nnegocio }}</v-card-subtitle>
        <v-card-text>
          <v-form ref="form" v-model="valid" :lazy-validation="lazy">
            <v-row>
              <v-col cols="12" sm="6" md="6">
                <v-card height="100%" class="elevation-0">
                  <v-text-field
                    solo
                    class="px-1 py-1"
                    label="Título*"
                    :rules="requiredRule"
                    :error-messages="errorTitulo"
                    v-model="titulo"
                    autocomplete="off"
                  >
                  </v-text-field>

                  <v-select
                    solo
                    v-model="producto"
                    :items="negocio.productos"
                    item-text="nombre"
                    item-value="id"
                    label="Producto"
                    persistent-hint
                    return-object
                    single-line
                  ></v-select>

                  <v-textarea
                    solo
                    label="Descripción"
                    :rules="requiredRule"
                    :error-messages="errorDesc"
                    v-model="descripcion"
                    class="px-1 py-1"
                    rows="2"
                  ></v-textarea>
                  <v-divider></v-divider>
                  <div>Paquetes</div>
                  <v-expansion-panels>
                    <v-expansion-panel
                      v-for="paquete in paketes"
                      :key="paquete.id"
                    >
                      <v-expansion-panel-header color="secondary">
                        <v-row>
                          <v-col cols="8" md="7" sm="7">
                            <div class="caption white--text">
                              {{ paquete.titulo }}
                            </div>
                          </v-col>
                          <v-col cols="4" md="5" sm="5">
                            <div class="caption"></div>
                            <v-chip class="success secondary--text">{{
                              paquete.costo
                            }}</v-chip
                            >&nbsp;<v-chip x-small>Bs</v-chip
                            >
                          </v-col>
                        </v-row>
                      </v-expansion-panel-header>
                      <v-expansion-panel-content>
                          <div class="py-2">
                            <v-chip :color="paquete.color" class="white--text px-6">{{paquete.label}}</v-chip>
                          </div>
                          <div class="py-2">{{ paquete.descripcion }}</div>
                          <v-divider class="py-3"></v-divider>
                              <v-btn
                                v-if="paquete.estado == 'activo'"
                                small
                                class="primary"
                                @click="confirmar = true"
                                >Comprar
                              </v-btn>
                              <template v-if="paquete.estado == 'comprado'">
                                      <v-chip class="success mr-4">
                                          <v-icon left> mdi-check </v-icon>
                                          Comprado
                                      </v-chip>
                                      <v-btn
                                        fab
                                        x-small
                                        @click="quitarCompra(paquete.id)"
                                      >
                                        <v-icon color="danger">mdi-delete</v-icon>
                                      </v-btn>
                              </template>              
                            <template v-if="confirmar">
                              <div class="text-center caption">
                                ¿Confirmar que desa comprar el paquete?
                              </div>
                                  <v-btn
                                    x-small
                                    rounded
                                    text
                                    @click="confirmar = false"
                                    >Cancelar</v-btn
                                  >
                                  <v-btn
                                    x-small
                                    rounded
                                    class="success secondary--text"
                                    @click="comprar(paquete)"
                                    >Confirmar</v-btn
                                  >
                            </template>                        
                      </v-expansion-panel-content>
                    </v-expansion-panel>
                  </v-expansion-panels>
                </v-card>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-row>
                  <v-col cols="12">
                      <v-row v-if="imagenError!==''">
                        <v-col>
                           <div class="subtitle1 danger--text">{{imagenError}}</div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="6">
                          Vista Previa
                        </v-col>
                        <v-col cols="6">
                          <clipperimagedialog
                            ref="anuncio1"
                            key="anuncio1"
                            @setImage="setImagen"
                          >
                          </clipperimagedialog>
                        </v-col>
                      </v-row>
                      <div class="boxi" >
                        <div
                            v-if="paqueteEsquinero!=null"
                            class="ribbon ribbon-top-left">

                            <!-- <span style=": #c91f82;"> -->
                            <span v-bind:style="{ 'background-color': paqueteEsquinero.color, }">
                              {{paqueteEsquinero.label}}
                            </span>
                        </div>
                        <v-img                          
                          v-if="image != null" :src="image">
                        </v-img>
                        <div class="subtitle1 font-weight-black px-1">{{ titulo.substring(0, 50) }}</div>
                        
                          <div class="px-1 font-weight-thin" v-if="descripcion.length > 75">
                            {{ descripcion.substring(0, 75) }}&nbsp;[...]
                          </div>
                          <div v-else>
                            {{ descripcion }}
                          </div>                        
                        <div class="caption">{{ negocio.nnegocio }}</div>
                        <div class="px-2 py-2">
                          <v-chip
                            v-for="cate in negocio.categorias"
                            :key="cate.id"
                            x-small
                            class="grey white--text"
                            >{{ cate.cname }}</v-chip
                          >
                        </div>
                        <v-divider class="mx-4"></v-divider>
                        <div>
                          <v-btn small icon>
                            <v-icon>mdi-share-variant</v-icon>
                          </v-btn>
                          <v-btn small rounded class="success">
                            {{ negocio.celular }}<v-icon>mdi-whatsapp</v-icon>
                          </v-btn>
                        </div>
                      </div>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
<!--             <v-row>
              <v-col>
                <pre>{{ paketes }}</pre>
              </v-col>
            </v-row> -->            
          </v-form>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="grey darken-1" text rounded @click="dialog = false">
            Cancelar
          </v-btn>
          <v-btn
            class="success black--text"
            rounded
            text
            @click="crear"
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
  name: "NuevoAnuncio",
  props: {
    negocio: Object,
    paquetes: Array,
  },
  data: () => ({
    confirmar: false,
    dialog: false,
    valid: false,
    titulo: "",
    errorTitulo: "",
    descripcion: "",
    errorDesc: "",
    requiredRule: [(v) => !!v || "Este Campo es requerido"],
    loading: false,
    lazy: true,
    fotos: [],
    image: null,
    imageDefault: window.location.origin + "/storage/images/default.jpeg",
    adquiridos: [],
    fullscreen: false,
    paketes: [],
    paqueteEsquinero: null,
    ribbonColor: '#fff',
    imagenError: '',
    producto: null
  }),
  methods: {
    crear() {
      if (this.$refs.form.validate()) {
      let foto1 = this.$refs.anuncio1.result;
      if(!foto1){
        this.valid = false
        this.imagenError = 'Seleccione una imagen'
      } else {
          this.valid = true
          this.imagenError = ''
          this.loading = true;
          let paquetes = []
          this.adquiridos.forEach(element => {
            paquetes.push(element.id)
          });
          let fData = {
            titulo: this.titulo,
            descripcion: this.descripcion,
            n_id: this.negocio.id,
            p_id: this.producto.id,
            paquetes: paquetes
          };
          axios({
              url: window.location.origin + "/user/anuncios/crear",
              data: fData,
              method: "POST",
            })
            .then((resp) => {
              let respuesta = resp;
              if (respuesta.data.success && respuesta.data.data != null) {
                //console.log(respuesta)
                if (foto1 !== "") {
                  //this.saveFoto(this.$refs.anuncio1.result, respuesta.data.data)
                  const formData = new FormData();
                  formData.append("imagen", foto1);
                  formData.append("type", "jpg");
                  formData.append("a_id", respuesta.data.data);
                  axios
                    .post(
                      window.location.origin + "/user/files/anuncio",
                      formData,
                      {
                        headers: { "Content-Type": "multipart/form-data" },
                      }
                    )
                    .then((response) => {
                      let res = response
                      //response NECESITA ID, URL, ANUNCIO_ID
                      
                      let fotos = []
                          fotos.push({
                            id: res.data.foto.id,
                            url: res.data.foto.url,
                            anuncio_id: respuesta.data.data
                          })
                      fData.fotos = fotos
                      fData.id = respuesta.data.data
                      fData.estadoanuncio = "inactivo"
                      this.$emit("addNew", fData)
                      this.titulo = ''
                      this.descripcion = ''
                      this.adquiridos = []
                      this.image = this.imageDefault;
                      this.paketes = this.paquetes;
                      this.fotos = []
                      this.paqueteEsquinero = null

                      this.loading = false
                      this.dialog = false
                    })
                    .catch((err) => {
                      console.error(err)
                    });
                }
              }
            })
            .catch((err) => {
              if (err.response.status == 422) {
                console.log(err.response)
              }
            })
        }
      }
    },
    saveFoto(result, anuncio_id) {
      if (this.fotos.length < 2) {
        const formData = new FormData();
        formData.append("imagen", result);
        formData.append("type", "jpg");
        formData.append("a_id", anuncio_id);
        axios
          .post(window.location.origin + "/user/files/anuncio", formData, {
            headers: { "Content-Type": "multipart/form-data" },
          })
          .then((response) => {
            this.fotos.push(response.data.foto);
            let foto2 = this.$refs.anuncio2.result;
            if (foto2 !== "") {
              this.saveFoto(foto2, anuncio_id);
            }
            //this.$emit("addNew", fData);
            this.loading = false;
            //this.dialog = false;
          })
          .catch((err) => {
            console.error(err);
          });
      }
    },
    setImagen(photo) {
      this.image = photo;
    },
    remove(id) {
      let result = this.adquiridos.filter((paque) => {
        return paque.id != id;
      });
      this.adquiridos = result;
    },
    comprar(paquete) {
      //console.log(paquete.id)
      this.adquiridos.push(paquete);
      this.paketes.map((paquet) => {
        if (paquet.id == paquete.id) {
          paquet.estado = "comprado";
          //console.log(paquet.id)
        }
      });
      if(paquete.tipopaquete=='esquinero'){
        this.paqueteEsquinero = paquete
        this.ribbonColor = paquete.color
      }
      this.confirmar = false;
    },
    quitarCompra(id) {
      this.paketes.map((pake) => {
        if (pake.id == id) {
          pake.estado = "activo";
          let result = this.adquiridos.filter((paquete) => {
            return paquete.id !== id;
          });
          this.adquiridos = result;
          this.paqueteEsquinero = null
          this.ribbonColor = '#fff'
        }
      });
    },
  },
  computed: {
    total() {
      let total = 0;
      this.adquiridos.forEach((element) => {
        total = total + Number(element.costo);
      });
      return total;
    },
  },
  created() {
    this.image = this.imageDefault;
    this.paketes = this.paquetes;
    //this.adquiridos = this.paquetes
  },
};
</script>

<style scoped>

</style>