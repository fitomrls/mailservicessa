<template>
  <div class="search-bar">
    <div class="search-inner">
      <form class="search-form" v-on:submit.prevent="onSubmit">
        <div class="form-group inputwithicon">
          <i class="lni-tag"></i>
          <input
            type="text"
            name="customword"
            v-model="texto"
            class="form-control"
            placeholder="Palabra Clave"
            autocomplete="off"
          />
        </div>
        <div class="form-group inputwithicon">
          <i class="lni-map-marker"></i>
          <div class="select">
            <select v-model="ciudad">
              <option value="">Ciudad</option>
              <option value="cochabamba">Cochabamba</option>
              <option value="la+paz">La Paz</option>
              <option value="santa+cruz">Santa Cruz</option>
              <option value="sucre">Sucre</option>
              <option value="tarija">Tarija</option>
              <option value="oruro">Oruro</option>
              <option value="potosi">Potosi</option>
              <option value="beni">Beni</option>
              <option value="pando">Pando</option>
            </select>
          </div>
        </div>
        <div class="form-group inputwithicon">
          <i class="lni-menu"></i>
          <div class="select">
            <select v-model="categoria">
              <option value="">Categorias</option>
              <option 
                v-for="categoria in categorias"
                :key="categoria.id"
                :value="categoria.cname"
              >
                {{categoria.cname}}
              </option>
            </select>
          </div>
        </div>
        <button class="btn btn-common" type="button" @click="onSubmit">
          <i class="lni-search"></i>
          Buscar Ahora
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "Buscar",
  props: {
      categorias: Array
  },
  data() {
    return {
      texto: "",
      ciudad: "",
      categoria: "",
    };
  },
  methods: {
    onSubmit() {
      if (this.texto.length >= 2) {
          window.location.href = "/resultados?txt="+this.texto+"&ciudad="+this.ciudad+"&cat="+this.categoria;
      }
    },
  },
};
</script>

<style>
</style>