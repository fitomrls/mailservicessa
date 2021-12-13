<template>
  <div class="section-padding">
    <div class="container">
      <div class="product-info row">
        <div class="col-lg-7 col-md-12 col-xs-12">
          <div class="details-box ads-details-wrapper">
            <div
              id="owl-demo"
              class="owl-carousel owl-theme"
              style="opacity: 1; display: block"
            >
              <div class="owl-wrapper-outer">
                <div
                  class="owl-wrapper"
                  style="
                    width: 3810px;
                    left: 0px;
                    display: block;
                    transition: all 0ms ease 0s;
                    transform: translate3d(0px, 0px, 0px);
                  "
                >
                  <div 
                    class="owl-item" style="width: 635px"
                    v-for="foto in anuncio.fotos"
                    :key="foto.id"
                  >
                    <div class="item">
                      <div class="product-img">
                        <img
                          class="img-fluid"
                          :src="foto.url"
                          alt=""
                        />
                      </div>
                      <span class="price">{{anuncio.producto.precio_regular}} &nbsp;bs</span>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-12 col-xs-12">
          <div class="details-box">
            <div class="ads-details-info">
              <h2>{{anuncio.titulo}}</h2>
              <span>{{anuncio.producto.nombre}}</span>
              <p class="mb-2">
                  {{anuncio.descripcion}}
              </p>
              <div class="details-meta">
                <span
                  ><a href="#"
                    ><i class="lni-alarm-clock"></i> 7 Jan, 10:10 pm</a
                  ></span
                >
                <span
                  ><a href="#"><i class="lni-map-marker"></i> New York</a></span
                >
                <span
                  ><a href="#"><i class="lni-eye"></i> 299 View</a></span
                >
              </div>
              <h4 class="title-small mb-3">Dirección:</h4>
              <ul class="list-specification">
                <li>
                  <i class="lni-check-mark-circle"></i> {{anuncio.negocio.dir}}
                </li>
                <!--<li>
                  <i class="lni-check-mark-circle"></i> 2.7 GHz dual-core Intel
                  Core i5
                </li>
                <li>
                  <i class="lni-check-mark-circle"></i> Turbo Boost up to 3.1GHz
                </li>
                <li>
                  <i class="lni-check-mark-circle"></i> Intel Iris Graphics 6100
                </li>
                <li><i class="lni-check-mark-circle"></i> 8GB memory</li>
                <li>
                  <i class="lni-check-mark-circle"></i> 10 hour battery life
                </li>
                <li>
                  <i class="lni-check-mark-circle"></i> 13.3" Retina Display
                </li>
                <li>
                  <i class="lni-check-mark-circle"></i> 1 Year international
                  warranty
                </li>-->
              </ul>
            </div>
            <ul class="advertisement mb-4">
              <li>
                <p>
                  <strong><i class="lni-folder"></i> Categories:</strong>
                  <!--<a href="#">Electronics</a>-->
                   <span 
                      v-for="cate in anuncio.categorias"
                      :key="cate.id"
                      class="float-right" style="color: #000;">{{cate.cname}}&nbsp;&nbsp;
                   </span>
                </p>
              </li>
              <!--<li>
                <p>
                  <strong><i class="lni-archive"></i> Condition:</strong> New
                </p>
              </li>
              <li>
                <p>
                  <strong><i class="lni-package"></i> Brand:</strong>
                  <a href="#">Apple</a>
                </p>
              </li>-->
            </ul>
            <div class="ads-btn mb-4">
              <a href="#" class="btn btn-common btn-reply"
                ><i class="lni-envelope"></i> Email</a
              >
              <a href="#" class="btn btn-common"
                ><i class="lni-phone-handset"></i>{{anuncio.negocio.celular}}</a
              >
            </div>
            <div class="share">
              <span>Share: </span>
              <div class="social-link">
                <a class="facebook" href="#"
                  ><i class="lni-facebook-filled"></i
                ></a>
                <a class="twitter" href="#"
                  ><i class="lni-twitter-filled"></i
                ></a>
                <!--<a class="linkedin" href="#"
                  ><i class="lni-linkedin-fill"></i
                ></a>
                <a class="google" href="#"><i class="lni-google-plus"></i></a>-->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="description-info">
        <div class="row">
          <div class="col-lg-8 col-md-6 col-xs-12">
            <div class="description">
              <h4>Descripción</h4>
              <p>
                {{ anuncio.producto.descripcion }}
              </p>
            </div>
          </div>
          <!--<div class="col-lg-4 col-md-6 col-xs-12">
            <div class="short-info">
              <h4>Short Info</h4>
              <ul>
                <li>
                  <a href="#"
                    ><i class="lni-users"></i> More ads by <span>User</span></a
                  >
                </li>
                <li>
                  <a href="#"><i class="lni-printer"></i> Print this ad</a>
                </li>
                <li>
                  <a href="#"><i class="lni-reply"></i> Send to a friend</a>
                </li>
                <li>
                  <a href="#"><i class="lni-warning"></i> Report this ad</a>
                </li>
              </ul>
            </div>
          </div>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DetalleAnuncio",
  data() {
      return {
          anuncio: null,
          anuncio_id: 0
      }
  },
  created() {
/*     const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    this.anuncio_id = urlParams.get("id"); */
    this.anuncio_id = window.location.pathname.split("/").pop()
    //console.log('anuncio_id:', this.anuncio_id)

    axios.get(window.location.origin + "/detalleanuncio/"+this.anuncio_id ).then((res) => {
      this.anuncio = res.data.result;
    });

  },
};
</script>

<style lang="scss" scoped>
</style>