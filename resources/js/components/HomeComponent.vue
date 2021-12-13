<template>
  <div>
    <div id="hero-area">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-xs-12 text-center">
            <div class="contents">
              <h1 class="head-title">
                Bienvenido a <span class="year">Plaza Comidas</span>
              </h1>
              <p>
                Come todo lo que puedas encontrar, <br />
                ó Busca donde degustar la mejor comida de nuestro pais
              </p>
              <buscar :categorias="categorias"></buscar>
            </div>
          </div>
        </div>
      </div>
    </div>

    <homecategorias :categorias="categorias"></homecategorias>
    <homerecomendados></homerecomendados>
    <homedestacados></homedestacados>

    <section class="services section-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="0.2s">
              <div class="icon">
                <i class="lni-book"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Fully Documented</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo
                  aut magni perferendis repellat rerum assumenda facere.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="0.4s">
              <div class="icon">
                <i class="lni-leaf"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Clean & Modern Design</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo
                  aut magni perferendis repellat rerum assumenda facere.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="0.6s">
              <div class="icon">
                <i class="lni-map"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Great Features</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo
                  aut magni perferendis repellat rerum assumenda facere.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="0.8s">
              <div class="icon">
                <i class="lni-cog"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Completely Customizable</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo
                  aut magni perferendis repellat rerum assumenda facere.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="1s">
              <div class="icon">
                <i class="lni-pointer-up"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">User Friendly</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo
                  aut magni perferendis repellat rerum assumenda facere.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 col-xs-12">
            <div class="services-item wow fadeInRight" data-wow-delay="1.2s">
              <div class="icon">
                <i class="lni-layout"></i>
              </div>
              <div class="services-content">
                <h3><a href="#">Awesome Layout</a></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo
                  aut magni perferendis repellat rerum assumenda facere.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="counter-section section-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6 work-counter-widget text-center">
            <div class="counter">
              <div class="icon"><i class="lni-layers"></i></div>
              <h2 class="counterUp">12090</h2>
              <p>Regular Ads</p>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 work-counter-widget text-center">
            <div class="counter">
              <div class="icon"><i class="lni-map"></i></div>
              <h2 class="counterUp">350</h2>
              <p>Locations</p>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 work-counter-widget text-center">
            <div class="counter">
              <div class="icon"><i class="lni-user"></i></div>
              <h2 class="counterUp">23453</h2>
              <p>Reguler Members</p>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 work-counter-widget text-center">
            <div class="counter">
              <div class="icon"><i class="lni-briefcase"></i></div>
              <h2 class="counterUp">250</h2>
              <p>Premium Ads</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="pricing-table" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mainHeading">
              <h2 class="section-title">Select A Package</h2>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="table">
              <div class="icon">
                <i class="lni-gift"></i>
              </div>
              <div class="title">
                <h3>SILVER</h3>
              </div>
              <div class="pricing-header">
                <p class="price-value"><sup>$</sup>29<span>/ Mo</span></p>
              </div>
              <ul class="description">
                <li><strong>Free</strong> ad posting</li>
                <li><strong>No</strong> Featured ads availability</li>
                <li><strong>For 30</strong> days</li>
                <li><strong>100%</strong> Secure!</li>
              </ul>
              <button class="btn btn-common">Buy Now</button>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="table" id="active-tb">
              <div class="icon">
                <i class="lni-leaf"></i>
              </div>
              <div class="title">
                <h3>STANDARD</h3>
              </div>
              <div class="pricing-header">
                <p class="price-value"><sup>$</sup>89<span>/ Mo</span></p>
              </div>
              <ul class="description">
                <li><strong>Free</strong> ad posting</li>
                <li><strong>6</strong> Featured ads availability</li>
                <li><strong>For 30</strong> days</li>
                <li><strong>100%</strong> Secure!</li>
              </ul>
              <button class="btn btn-common">Buy Now</button>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-xs-12">
            <div class="table">
              <div class="icon">
                <i class="lni-layers"></i>
              </div>
              <div class="title">
                <h3>PLANINIUM</h3>
              </div>
              <div class="pricing-header">
                <p class="price-value"><sup>$</sup>99<span>/ Mo</span></p>
              </div>
              <ul class="description">
                <li><strong>Free</strong> ad posting</li>
                <li><strong>20</strong> Featured ads availability</li>
                <li><strong>For 25</strong> days</li>
                <li><strong>100%</strong> Secure!</li>
              </ul>
              <button class="btn btn-common">Buy Now</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="testimonial section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="testimonials" class="owl-carousel">
              <div class="item">
                <div class="testimonial-item">
                  <div class="img-thumb">
                    <img src="assets/img/testimonial/img1.png" alt="" />
                  </div>
                  <div class="content">
                    <h2><a href="#">John Doe</a></h2>
                    <p class="description">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                      Explicabo quidem, excepturi facere magnam illum, at
                      accusantium doloremque odio.
                    </p>
                    <h3>Developer at of <a href="#">xyz company</a></h3>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-item">
                  <div class="img-thumb">
                    <img src="assets/img/testimonial/img2.png" alt="" />
                  </div>
                  <div class="content">
                    <h2><a href="#">Jessica</a></h2>
                    <p class="description">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                      Explicabo quidem, excepturi facere magnam illum, at
                      accusantium doloremque odio.
                    </p>
                    <h3>Developer at of <a href="#">xyz company</a></h3>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-item">
                  <div class="img-thumb">
                    <img src="assets/img/testimonial/img3.png" alt="" />
                  </div>
                  <div class="content">
                    <h2><a href="#">Johnny Zeigler</a></h2>
                    <p class="description">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                      Explicabo quidem, excepturi facere magnam illum, at
                      accusantium doloremque odio.
                    </p>
                    <h3>Developer at of <a href="#">xyz company</a></h3>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-item">
                  <div class="img-thumb">
                    <img src="assets/img/testimonial/img1.png" alt="" />
                  </div>
                  <div class="content">
                    <h2><a href="#">John Doe</a></h2>
                    <p class="description">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                      Explicabo quidem, excepturi facere magnam illum, at
                      accusantium doloremque odio.
                    </p>
                    <h3>Developer at of <a href="#">xyz company</a></h3>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimonial-item">
                  <div class="img-thumb">
                    <img src="assets/img/testimonial/img2.png" alt="" />
                  </div>
                  <div class="content">
                    <h2><a href="#">Jessica</a></h2>
                    <p class="description">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                      Explicabo quidem, excepturi facere magnam illum, at
                      accusantium doloremque odio.
                    </p>
                    <h3>Developer at of <a href="#">xyz company</a></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="subscribes section-padding">
      <div class="container">
        <div class="row wrapper-sub">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <p>
              Join our 10,000+ subscribers and get access to the latest
              templates, freebies, announcements and resources!
            </p>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <form>
              <div class="subscribe">
                <input
                  class="form-control"
                  name="EMAIL"
                  placeholder="Your email here"
                  required=""
                  type="email"
                />
                <button class="btn btn-common" type="submit">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section class="cta section-padding">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="single-cta">
              <div class="cta-icon">
                <i class="lni-grid"></i>
              </div>
              <h4>Refreshing Design</h4>
              <p>
                Duis autem vel eum iriure dolor in hendrerit in vulputate velit
                esse molestie
              </p>
            </div>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="single-cta">
              <div class="cta-icon">
                <i class="lni-brush"></i>
              </div>
              <h4>Easy to Customize</h4>
              <p>
                Duis autem vel eum iriure dolor in hendrerit in vulputate velit
                esse molestie
              </p>
            </div>
          </div>
          <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="single-cta">
              <div class="cta-icon">
                <i class="lni-headphone-alt"></i>
              </div>
              <h4>24/7 Support</h4>
              <p>
                Duis autem vel eum iriure dolor in hendrerit in vulputate velit
                esse molestie
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
      return {
          categorias: []
      }
  },
  created () {
    axios.get( window.location.origin+"/home/categorias").then((res) => {
      this.categorias = res.data;
    });
  },
};
</script>

<style lang="scss" scoped>
</style>