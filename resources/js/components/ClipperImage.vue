<template>
    <v-card class="px-2">
       <div class="text-center">
        <clipper-upload class="boton" v-model="photo" >
            <v-icon>mdi-image</v-icon>
        </clipper-upload>
       </div>
        <v-btn class="primary" small v-show="false" @click="getResult">
            <v-icon small>mdi-crop</v-icon>
        </v-btn>

        <v-row class="row px-1 py-1">
            <v-col cols="12">
            <clipper-basic :src="photo" ref="clipper">
                <div slot="placeholder">
                   Seleccione una imagen
                </div>
            </clipper-basic>
            </v-col>
            <v-col cols="12" v-show="false">
                <img v-if="result!=''" :src="result" alt="" />
            </v-col>
        </v-row>
       
       <v-card-actions>
           <v-btn 
            text
            rounded 
            small
            style="text-transform: none !important;"
            @click="cancelar">
            Cancelar
          </v-btn>
           <v-btn 
            class="success"
            rounded
            small
            :disabled="hayfoto"
            :loading="loadingImage"
            style="text-transform: none !important;"
            @click="save"
            >
            Cambiar</v-btn>
       </v-card-actions> 
    </v-card>
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
  name: "ClipperImage",
  props: {
      negocio_id: Number
  },
  data() {
    return {
      dialog: false,  
      pixel: "",
      hayfoto: true,
      loadingImage: false,
      result: "",
      photo: "",
      rotation: 0,
    };
  },

  methods: {
    upload(){
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
      this.loadingImage = true;
      const canvas = this.$refs.clipper.clip({ maxWPixel: 500 });
      this.pixel = `${canvas.width} x ${canvas.height}`;
      this.result = this.dataURItoBlob(canvas.toDataURL("image/jpeg"));
      //console.log(this.result);

      const formData = new FormData();
      formData.append("imagen", this.result);
      formData.append("type", "jpg");
      axios
        .post(window.location.origin + "/user/negocio/file/"+this.negocio_id, formData, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then((response) => {
          this.loadingImage = false;
          this.foto = response.data.imageName;
          this.$emit("setPhoto", this.foto)
        })
        .catch((err) => {
          console.error(err);
        });
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
    cancelar(){
      this.result = ""
      this.photo = ""
      this.$emit("cancel")
    }
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
        background: #8080ff;
        border:none;
        color:#FFF;
        cursor:pointer;
    }
</style>