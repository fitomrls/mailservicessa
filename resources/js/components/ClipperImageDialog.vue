<template>
  <v-dialog persistent v-model="dialog" max-width="850px" :fullscreen="fullscreen">
    <template v-slot:activator="{ on, attrs }">
      <v-btn small v-bind="attrs" v-on="on">
        <v-icon>mdi-image</v-icon>
      </v-btn>
    </template>
    <v-card height="70vh">
      <v-system-bar window dark>
        <v-icon>mdi-image</v-icon>
        <v-spacer></v-spacer>
        <v-btn x-small icon @click="fullscreen = false">
          <v-icon>mdi-view-compact</v-icon>
        </v-btn>
        <v-btn x-small icon @click="fullscreen = true">
          <v-icon>mdi-aspect-ratio</v-icon>
        </v-btn>
        <v-btn x-small icon>
          <v-icon @click="cancelar">mdi-close</v-icon>
        </v-btn>
      </v-system-bar>
      <v-card-title class="secondary white--text">Imagen </v-card-title>
      <v-divider></v-divider>
      <v-card-text>
        <div class="text-center">
          <clipper-upload class="boton" v-model="photo">
            <v-icon>mdi-image</v-icon>
          </clipper-upload>
        </div>
        <v-btn class="primary" small v-show="false" @click="getResult">
          <v-icon small>mdi-crop</v-icon>
        </v-btn>

        <v-row>
          <v-col cols="12">
            <clipper-basic :src="photo" ref="clipper">
              <div slot="placeholder">Seleccione una imagen</div>
            </clipper-basic>
          </v-col>
          <v-col cols="12" v-show="false">
            <img v-if="result != ''" :src="result" alt="" />
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-btn text rounded @click="cancelar">Cancelar</v-btn>
        <v-btn class="success" rounded :disabled="hayfoto" 
          @click="save">
          Aplicar</v-btn
        >
        <!--             <v-btn class="success" small @click="save">
                <v-icon small>mdi-check</v-icon>
            </v-btn> -->
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import Vue from "vue";
import VueRx from "vue-rx";
// Use build files
import VuejsClipper from "vuejs-clipper/dist/vuejs-clipper.umd";
import "vuejs-clipper/dist/vuejs-clipper.css";
Vue.use(VueRx);
Vue.use(VuejsClipper);

export default {
  name: "ClipperImageDialog",
  data() {
    return {
      dialog: false,
      result: "",
      pixel: "",
      hayfoto: true,
      loadingImage: false,
      photo: "",
      rotation: 0,
      fullscreen: false
    };
  },

  methods: {
    upload() {
      this.$refs.upload.click;
    },
    getResult() {
      const canvas = this.$refs.clipper.clip({ maxWPixel: 500 });
      this.pixel = `${canvas.width} x ${canvas.height}`;
      this.result = canvas.toDataURL("image/jpeg");
    },
    clip() {
      this.getResult();
      const a = document.createElement("A");
      a.download = "result.jpg";
      a.href = this.result;
      a.target = "_blank";
      a.click();
    },

    save() {
      const canvas = this.$refs.clipper.clip({ maxWPixel: 500 });
      this.pixel = `${canvas.width} x ${canvas.height}`;
      this.result = this.dataURItoBlob(canvas.toDataURL("image/jpeg"));
      //console.log(this.result);
      this.$emit("setImage", URL.createObjectURL(this.result));
      this.dialog = false;
    },

    dataURItoBlob(dataURI) {
      // convert base64 to raw binary data held in a string
      // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this
      var byteString = atob(dataURI.split(",")[1]);

      // separate out the mime component
      var mimeString = dataURI.split(",")[0].split(":")[1].split(";")[0];

      // write the bytes of the string to an ArrayBuffer
      var ab = new ArrayBuffer(byteString.length);

      // create a view into the buffer
      var ia = new Uint8Array(ab);

      // set the bytes of the buffer to the correct values
      for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
      }

      // write the ArrayBuffer to a blob, and you're done
      var blob = new Blob([ab], { type: mimeString });
      return blob;
    },
    cancelar() {
      this.photo = "";
      this.result = "";
      this.dialog = false;
    },
  },

  watch: {
    photo(newValue, oldValue) {
      if (newValue !== "") {
        this.hayfoto = false;
      } else {
        this.hayfoto = true;
      }
    },
  },
};
</script>

<style scoped>
.boton {
  background: #1affa3;
  border: none;
  color: #fff;
  cursor: pointer;
}
</style>