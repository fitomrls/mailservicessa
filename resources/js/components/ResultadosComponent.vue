<template>
<section class="featured-lis section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
         <h1 class="section-title">Resultados</h1>

         <nav class="nav-table">
            <ul>
              <li class="active"><a href="#">{{texto}}</a></li>
            </ul>
         </nav>
        <div class="row">
            <div
                v-for="anuncio in anuncios" :key="anuncio.anuncio_id"
                class="col-xs-6 col-sm-6 col-md-6 col-lg-4" 
                data-aos="fade-right"
            >
                <div class="featured-box">
                    <figure>
                        <div class="icon">
                            <i class="lni-heart"></i>
                        </div>
                        <a href="#">
                            <img 
                            v-for="foto in anuncio.fotos"
                            :key="foto.id"
                            class="img-fluid cover" 
                            :src="foto.url" 
                            alt=""></a>
                    </figure>
                    <div class="feature-content">
                        <div class="product">
                            <a href="#"><i class="lni-folder"></i> Vehicles</a>
                        </div>
                        <h4 class="product-title">
                          <a 
                            :href="getLink(anuncio.id)">
                              {{anuncio.titulo}}
                          </a>
                        </h4>
                        <!--<h4><a href="ads-details.html">{{anuncio.titulo}}</a></h4>-->
                        <span>{{anuncio.producto.nombre}}</span>
                        <span class="adcategories">
                          <span 
                               v-for="cate in anuncio.categorias"
                               :key="cate.id"
                               class="badge badge-pill badge-info float-right" style="color: #FFF;">{{cate.cname}}&nbsp;&nbsp;
                          </span>
                        </span>
                        <span>Last Updated: 5 hours ago</span>
                        <ul class="address">
                            <li>
                                <a href="#"><i class="lni-map-marker"></i> Dallas, Washington</a>
                            </li>
                            <li>
                                <a href="#"><i class="lni-alarm-clock"></i> Dec 18, 2018</a>
                            </li>
                            <li>
                                <a href="#"><i class="lni-user"></i> Elon Musk</a>
                            </li>
                            <li>
                                <a href="#"><i class="lni-package"></i> N/A</a>
                            </li>
                        </ul>
                        <div class="listing-bottom">
                            <h3 class="price float-left">{{anuncio.producto.precio_regular}} Bs.</h3>                            
                            <a href="#" class="btn btn-whatsapp float-right" style="color: #FFF;">
                                <svg version="1.1"  width="17px" height="17px" fill="white"  id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 64 64" style="enable-background: #fff;" xml:space="preserve">
                                <g id="WA_Logo">
                                    <g>
                                    <path d="M54.6,9.3C48.6,3.3,40.6,0,32.1,0C14.7,0,0.4,14.2,0.4,31.7c0,5.6,1.5,11,4.2,15.9L0.1,64L17,59.6
                                        c4.6,2.5,9.8,3.9,15.2,3.9l0,0l0,0c17.5-0.1,31.7-14.3,31.7-31.8C63.9,23.3,60.5,15.3,54.6,9.3z M32.1,58.1L32.1,58.1
                                        c-4.7,0-9.4-1.3-13.5-3.7l-1-0.6l-10,2.6l2.7-9.7l-0.6-1c-2.6-4.2-4-9.1-4-14c0-14.5,11.8-26.3,26.4-26.3c7,0,13.7,2.8,18.6,7.7
                                        s7.7,11.6,7.7,18.7C58.5,46.3,46.7,58.1,32.1,58.1z M46.6,38.4c-0.8-0.4-4.7-2.3-5.5-2.5c-0.7-0.3-1.3-0.4-1.8,0.4
                                        c-0.5,0.8-2.1,2.5-2.5,3.1c-0.5,0.5-0.9,0.6-1.7,0.2c-0.8-0.4-3.3-1.2-6.4-4c-2.3-2.1-4-4.7-4.4-5.5c-0.5-0.8-0.1-1.2,0.4-1.6
                                        c0.4-0.4,0.8-0.9,1.2-1.4c0.4-0.5,0.5-0.8,0.8-1.3c0.3-0.5,0.1-1-0.1-1.4s-1.8-4.3-2.5-5.9c-0.6-1.6-1.3-1.3-1.8-1.3
                                        c-0.5,0-1,0-1.5,0c-0.5,0-1.4,0.2-2.1,1c-0.7,0.8-2.8,2.7-2.8,6.6s2.8,7.6,3.3,8.2c0.4,0.5,5.6,8.6,13.5,12
                                        c1.9,0.8,3.4,1.3,4.5,1.7c1.9,0.6,3.6,0.5,5,0.3c1.6-0.2,4.7-1.9,5.4-3.8c0.6-1.8,0.6-3.5,0.5-3.8C47.9,38.9,47.4,38.7,46.6,38.4z
                                        "/>
                                    </g>
                                </g>
                                </svg>
                                {{anuncio.negocio.celular}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
       </div>
      </div>
     </div>
    </div>

    <div class="pagination-bar">
            <nav>
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <button
                    v-if="pagination.pre_page != null"
                    class="btn page-link active"
                    type="submit"
                    @click="previo"
                  >
                    <span
                      v-if="loadingPrevio"
                      class="spinner-grow spinner-grow-sm"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    Previo
                  </button>
                </li>

                <template v-for="pagina in (0, pagination.last_page)">
                  <button
                    v-if="pagina - 1 === pagination.actual_page"
                    :key="pagina"
                    class="btn mbtn page-link active"
                    type="submit"
                    disabled
                  >
                    {{ pagina }}
                  </button>
                  <button
                    v-else
                    :key="pagina"
                    class="btn mbtn page-link"
                    type="submit"
                    @click="go(pagina - 1)"
                  >
                    {{ pagina }}
                  </button>
                </template>

                <li class="page-item">
                  <button
                    v-if="pagination.last_page != pagination.actual_page"
                    class="btn page-link active"
                    type="submit"
                    @click="ultimo"
                  >
                    <span
                      v-if="loadingNext"
                      class="spinner-grow spinner-grow-sm"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    &Uacute;ltimo
                  </button>
                </li>
                <li class="page-item">
                  <button
                    v-if="pagination.next_page != null"
                    class="btn page-link active"
                    type="submit"
                    @click="siguiente"
                  >
                    <span
                      v-if="loadingNext"
                      class="spinner-grow spinner-grow-sm"
                      role="status"
                      aria-hidden="true"
                    ></span>
                    Sig
                  </button>
                </li>
              </ul>
            </nav>
          </div>
</section>
</template>

<script>
export default {
  name: "Resultados", 
  data() {
    return {
      texto: "",
      ciudad: "",
      categoria: "",
      anuncios: [],
      page: 0,
      pages: 5,
      pagination: {
        cuenta: 1,
      },
      prevDisabled: true,
      nextDisabled: true,
      loadingNext: false,
      loadingPrevio: false,
      fotos: [],
    };
  },
  methods: {
    fetchAnuncios() {  
    this.anuncios = null;  
    this.fotos = null;
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    this.texto = urlParams.get("txt");
    this.ciudad = urlParams.get("ciudad");
    this.categoria = urlParams.get("cat");

    let fData = {
      texto: this.texto,
      ciudad: this.ciudad,
      categoria: this.categoria,
      page: this.page,
      pages: this.pages,
      cuenta: this.pagination.cuenta,
    };

    axios({
      url: window.location.origin + "/buscar",
      data: fData,
      method: "POST",
    })
      .then((resp) => {
        this.anuncios = resp.data.result.anuncios;
        this.pagination = {
            first_page: resp.data.result.pagination.first_page,
            actual_page: resp.data.result.pagination.actual_page,
            next_page: resp.data.result.pagination.next_page,
            total: resp.data.result.pagination.total,
            pre_page: resp.data.result.pagination.pre_page,
            pages: resp.data.result.pagination.pages,
            last_page: resp.data.result.pagination.last_page,
            cuenta: resp.data.result.pagination.cuenta,
          };
          this.loadingNext = false;
          this.loadingPrevio = false;
          this.prevDisabled = false;
          if (this.pagination.pre_page != null) {
            this.prevDisabled = true;
          }
          this.nextDisabled = false;
          if (this.pagination.next_page != null) {
            this.nextDisabled = true;
          }
      })
       .catch((error) => {
        console.log(error)
      });
  },
   siguiente() {
      this.loadingNext = true;
      this.page = Number(this.pagination.actual_page + 1);
      this.cuenta = Number(this.pagination.cuenta);
      this.fetchAnuncios();
    },
    previo() {
      this.loadingPrevio = true;
      this.page = Number(this.pagination.actual_page - 1);
      if (this.page >= 0) {
        this.fetchAnuncios();
      }
    },
    ultimo() {
      this.loadingNext = true;
      this.page = Number(this.pagination.last_page);
      this.fetchAnuncios();
    },
    go(page) {
      this.loadingNext = true;
      this.page = page;
      this.cuenta = Number(this.pagination.cuenta);
      this.fetchAnuncios();
    },
      getLink(id) {
      return window.location.origin + "/anuncio/detalle/"+id
    }
  },  
    created() {
    this.fetchAnuncios();
  }
};
</script>

<style lang="scss" scoped>

</style>