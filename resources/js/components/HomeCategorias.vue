<template>
  <section class="categories-icon section-padding bg-drack">
    <div class="container">
      <div class="row">
        <div v-for="cate in categorias" :key="cate.id" class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
          <a :href="'home/negocios/'+cate.url">
            <div class="icon-box">
<!--               <div class="icon">
                <i :class="cate.icon"></i>
              </div> -->
              <h4>{{cate.cname}}</h4>
              <span class="ncat">{{cate.cuantos}}</span>
            </div>
          </a>
        </div>

      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "homecategorias",
  props: {
    categorias: Array
  },

};
</script>

<style lang="scss" scoped>
</style>