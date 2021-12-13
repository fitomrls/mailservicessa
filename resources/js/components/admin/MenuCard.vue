<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="500px"
      :fullscreen="fullscreen"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn icon v-bind="attrs" v-on="on">
          <v-icon>mdi-eye</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-system-bar window dark>
          <v-chip x-small>{{ anuncio.titulo }}</v-chip>
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
        <v-card-text>
          <div class="boxi">
            <div v-if="paqueteEsquinero != null" class="ribbon ribbon-top-left">
              <span
                v-bind:style="{ 'background-color': paqueteEsquinero.color }"
              >
                {{ paqueteEsquinero.label }}
              </span>
            </div>
            <template v-if="anuncio.fotos != []">
              <v-img
                v-for="foto in anuncio.fotos"
                :key="foto.id"
                :src="foto.url"
              >
              </v-img>
            </template>
            <div class="subtitle1 font-weight-black px-1">
              {{ anuncio.titulo.substring(0, 50) }}
            </div>
            <div
              class="px-1 font-weight-thin"
              v-if="anuncio.descripcion.length > 75"
            >
              {{ anuncio.descripcion.substring(0, 75) }}&nbsp;[...]
            </div>
            <div v-else>
              {{ anuncio.descripcion }}
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
            <div class="px-1 py-1">
              <v-btn small icon disabled>
                <v-icon>mdi-share-variant</v-icon>
              </v-btn>
              <v-btn 
                disabled
                small rounded class="success">
                {{ negocio.celular }}<v-icon>mdi-whatsapp</v-icon>
              </v-btn>
            </div>
          </div>
        </v-card-text>
        <v-card-actions>
          <v-switch
            v-model="estado"
            :label="estadoAnuncio"
            @change="cambio"
          ></v-switch>
          <v-spacer></v-spacer>
          <v-btn color="grey darken-1" text rounded @click="dialog = false">
            Cerrar
          </v-btn>
          <v-btn 
            class="success"
            :loading="loading"
            @click="save"
          >
          Cambiar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  name: "VistaAnuncio",
  props: {
    anuncio: Object,
    negocio: Object,
  },
  data() {
    return {
      dialog: false,
      image: null,
      imageDefault: window.location.origin + "/storage/images/default.jpeg",
      adquiridos: [],
      fullscreen: false,
      paqueteEsquinero: null,
      ribbonColor: "#fff",
      imagenError: "",
      estado: false,
      estadoAnuncio: "Inactivo",
      loading: false
    }
  },
  methods: {
    cambio() {
      if(this.estado){
        this.estadoAnuncio = 'Activo'
      } else{
        this.estadoAnuncio = 'Inactivo'
      }
    },
    save(){
        this.loading = true
        let fData = {
          'state': this.estado,
          'negocio': this.negocio.id
        }

        axios({
          url: window.location.origin + "/admin/anuncios/state/" + this.anuncio.id,
          data: fData,
          method: "PUT",
        }).then((resp) => {
            this.loading = false
            this.dialog = false
            fData.id = this.anuncio.id
            this.$emit("updateAnuncio", fData)
        }).catch((err) => {
            this.loading = false
            console.log(err.response)
        })
    }
  },
  created() {
    if (this.anuncio.paquetes != [] || this.anuncio.paquetes != null) {
      let esquinero = this.anuncio.paquetes.find(
        (element) => element.tipo == "esquinero"
      );
      this.paqueteEsquinero = esquinero;
    }
    if(this.anuncio.estadoanuncio=='inactivo'){
      this.estadoAnuncio = 'Inactivo'
      this.estado = false
    }else{
      this.estadoAnuncio = 'Activo'
      this.estado = true
    }
  },
};
</script>

<style>
/* box ribbon */
.boxi {
  position: relative;
  /*     max-width: 600px;
    width: 90%;
    height: 400px; */
  background: #fff;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  background-color: transparent;
}

/* common */
.ribbon {
  width: 150px;
  height: 150px;
  overflow: hidden;
  position: absolute;
  z-index: 1;
}
.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: "";
  display: block;
  /* border: 5px solid #c91f82; */
  border: 5px solid var(--ribbon-color);
}
.ribbon span {
  position: absolute;
  display: block;
  width: 225px;
  padding: 15px 0;
  /* background-color: #3498db; */
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color: #fff;
  font: 700 18px/1 "Lato", sans-serif;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
  text-transform: uppercase;
  text-align: center;
}

/* top left*/
.ribbon-top-left {
  top: -10px;
  left: -10px;
}
.ribbon-top-left::before,
.ribbon-top-left::after {
  border-top-color: transparent;
  border-left-color: transparent;
}
.ribbon-top-left::before {
  top: 0;
  right: 0;
}
.ribbon-top-left::after {
  bottom: 0;
  left: 0;
}
.ribbon-top-left span {
  right: -25px;
  top: 30px;
  transform: rotate(-45deg);
}

/* top right*/
.ribbon-top-right {
  top: -10px;
  right: -10px;
}
.ribbon-top-right::before,
.ribbon-top-right::after {
  border-top-color: transparent;
  border-right-color: transparent;
}
.ribbon-top-right::before {
  top: 0;
  left: 0;
}
.ribbon-top-right::after {
  bottom: 0;
  right: 0;
}
.ribbon-top-right span {
  left: -25px;
  top: 30px;
  transform: rotate(45deg);
}

/* bottom left*/
.ribbon-bottom-left {
  bottom: -10px;
  left: -10px;
}
.ribbon-bottom-left::before,
.ribbon-bottom-left::after {
  border-bottom-color: transparent;
  border-left-color: transparent;
}
.ribbon-bottom-left::before {
  bottom: 0;
  right: 0;
}
.ribbon-bottom-left::after {
  top: 0;
  left: 0;
}
.ribbon-bottom-left span {
  right: -25px;
  bottom: 30px;
  transform: rotate(225deg);
}

/* bottom right*/
.ribbon-bottom-right {
  bottom: -10px;
  right: -10px;
}
.ribbon-bottom-right::before,
.ribbon-bottom-right::after {
  border-bottom-color: transparent;
  border-right-color: transparent;
}
.ribbon-bottom-right::before {
  bottom: 0;
  left: 0;
}
.ribbon-bottom-right::after {
  top: 0;
  right: 0;
}
.ribbon-bottom-right span {
  left: -25px;
  bottom: 30px;
  transform: rotate(-225deg);
}
</style>