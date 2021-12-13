<template>
<section class="featured-lis section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                <h3 class="section-title">Recomendados</h3>
                <div id="new-products" class="owl-carousel">
                  <div class="item boxi" v-for="anuncio in anuncios" :key="anuncio.id">
                    <div 
                      v-if="anuncio.paquete!=null" 
                      class="ribbon ribbon-top-left"
                       v-bind:style="{ '--c': anuncio.paquete.color, 'z-index': 999}"
                    >
                      <span>{{anuncio.paquete.label}}</span>
                    </div>
                    <div class="product-item">
                      <div class="carousel-thumb">
                        <img v-for="foto in anuncio.fotos"
                          :key="foto.id"
                          class="img-fluid cover"
                          :src="foto.url"
                          alt=""
                        />
                        <div class="overlay"></div>
                      </div>
                      <div class="product-content">
                        <h3 class="product-title">
                          <a 
                            :href="getLink(anuncio.id)">
                              {{anuncio.titulo}}
                          </a>
                        </h3>
                        <p>{{anuncio.negocio.nnegocio}}</p>
                        <span class="price">{{anuncio.producto.precio_regular}} Bs.-</span>
                        <div class="meta">
                          <span class="icon-wrap">
                            <i class="lni-star-filled"></i>
                            <i class="lni-star-filled"></i>
                            <i class="lni-star-filled"></i>
                            <i class="lni-star"></i>
                            <i class="lni-star"></i>
                          </span>
                          <span class="count-review"> <span>1</span> Valoracion </span>
                        </div>
                        <div class="card-text">
                          <div class="float-left">
                            <a href="#"
                              ><i class="lni-map-marker"></i>
                              {{anuncio.negocio.dir}}</a>
                          </div>
                          <div class="float-right">
                            <div class="icon">
                              <i class="lni-heart"></i>
                            </div>
                          </div>
                        </div>
                        <div class="card-text">
                          <div class="float-right">
                            <a href="#" class="btn btn-whatsapp" style="color: #FFF;">
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
                              {{anuncio.negocio.celular}}</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
export default {
  name: "Recomendados",
  data() {
    return {
      anuncios: [],
    };
  },
  methods: {
    getLink(id) {
      return window.location.origin + "/anuncio/detalle/"+id
    }
  },
  mounted() {
    axios({
      url: window.location.origin + "/recomendados",
      method: "GET",
    })
      .then((resp) => {
        this.anuncios = resp.data;
      })
      .catch((error) => {
        console.log(error)
      });
  },
}
</script>

<style>
  .btn-whatsapp{
    background-color: #25D366;
  }
</style>