<template>
  <div class="inner-box">
    <div class="dashboard-box">
      <h2 v-if="categoria!=null" class="dashbord-title">{{categoria.cname}}</h2>
    </div>
    <div class="dashboard-wrapper">
      <nav class="nav-table">
        <ul>
          <li class="active"><a href="#">All Ads (42)</a></li>
          <li><a href="#">Published (88)</a></li>
          <li><a href="#">Featured (12)</a></li>
          <li><a href="#">Sold (02)</a></li>
          <li><a href="#">Active (42)</a></li>
          <li><a href="#">Expired (01)</a></li>
        </ul>
      </nav>
      <table class="table table-responsive dashboardtable tablemyads">
        <thead>
          <tr>
            <th>Img</th>
            <th>Negocio</th>
            <th>Celular</th>
            <th>Telefonos</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(negocio, index) in negocios" :key="negocio.id" data-category="active">
            <td>
              <div class="custom-control custom-checkbox">
                  {{index+1}}
              </div>
            </td>
            <td class="photo">
              <img
                class="img-fluid"
                src="http://127.0.0.1:8000/assets/img/product/img1.jpg"
                alt=""
              />
            </td>
            <td data-title="Title">
              <h3>{{negocio.nnegocio}}</h3>
              <span>{{negocio.dir}}</span>
            </td>
            <td data-title="Celular">
              <span class="adstatus adstatusactive">{{negocio.celular}}</span>
            </td>
            <td data-title="telefonos">
              <span class="adcategories">{{negocio.telefonos}}</span>
            </td>            
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "negocios",
  data() {
    return {
      negocios: [],
      categoria: null
    };
  },

  created() {
    /* let param = this.$route.query.page */
    let param = window.location.href.split('/').pop();
    axios.get(window.location.origin+'/categorias/home/negocios/'+param).then((res) => {
      this.categoria = res.data.categoria
      this.negocios = res.data.negocios;
    });
  },
};
</script>

<style lang="scss" scoped>
</style>