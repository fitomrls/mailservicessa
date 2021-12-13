<template>
  <v-footer padless absolute fixed color="transparent" height="72">
    <v-card
      flat
      tile
      width="100%"
      class="pink accent-2 lighten-1 white--text text-center"
    >
      <v-card-text class="topnav">
        <v-tooltip bottom v-for="link in links" :key="link.title">
          <template v-slot:activator="{ on, attrs }">
            <a class="mx-4 sin" :href="link.route" icon v-bind="attrs" v-on="on">
              <v-icon color="white" size="24px">{{link.icon}}</v-icon>
            </a>
          </template>
          <span>{{link.title}}</span>
        </v-tooltip>

      </v-card-text>

      <v-divider></v-divider>

      <v-card-text class="white--text">
        {{ new Date().getFullYear() }} — <strong>devdesing</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>

<script>
export default {
  name: "FooterClient",
  data() {
    return {
      links: [
        {
          title: "Dashboard",
          icon: "mdi-home",
          route: "/user",
        },
        {
          title: "Mi Negocio",
          icon: "mdi-star",
          route: "/user/negocio",
        },
        {
          title: "Productos",
          icon: "mdi-package-variant",
          route: "/user/productos",
        },
        {
          title: "Anuncios",
          icon: "mdi-buffer",
          route: "/user/anuncios",
        },
      ]
    }
  },
};
</script>

<style scoped>

  .sin {
    text-decoration: none;
  }

  .topnav a.active {
    border-bottom: 3px solid rgb(252, 252, 252);
  }
</style>