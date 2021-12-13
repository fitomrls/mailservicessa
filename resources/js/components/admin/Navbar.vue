<template>
  <div>
    <v-app-bar app clipped-right>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>
        Admin Webofertas
      </v-toolbar-title>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" app>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">
            Application 2021            
          </v-list-item-title>
          <v-list-item-subtitle> subtext </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list>
        <v-list-item
          v-for="item in links"
          :key="item.title"
          link
          :href="item.route"
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <v-divider></v-divider>
      <div class="py-2 text-center">
        <a
          class="primary v-btn v-btn--is-elevated v-btn--has-bg v-btn--rounded theme--light v-size--large"
          :href="logout"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
        >
          Logout
        </a>
        <form
          id="logout-form"
          :action="logout"
          method="POST"
          style="display: none"
        >
          <input type="text" name="_token" :value="csrf" />
        </form>
      </div>
    </v-navigation-drawer>
  </div>
</template>

<script>
export default {
  name: "Navbar",
  data() {
    return {
      drawer: null,
      links: [
        {
          title: "Dashboard",
          icon: "mdi-view-dashboard",
          route: window.location.origin + "/admin",
        },
        {
          title: "Negocios",
          icon: "mdi-silverware-fork-knife",
          route: window.location.origin + "/admin/negocios",
        },
        {
          title: "Categorias",
          icon: "mdi-layers",
          route: window.location.origin + "/admin/categorias",
        },
        {
          title: "Usuarios",
          icon: "mdi-account-group",
          route: window.location.origin + "/admin/usuarios",
        },
        {
          title: "Paquetes",
          icon: "mdi-package-variant",
          route: window.location.origin + "/admin/paquetes",
        },
        {
          title: "Anuncios",
          icon: "mdi-buffer",
          route: window.location.origin + "/admin/anuncios",
        },
      ],
      right: null,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      logout: window.location.origin + "/logout",
    };
  },
  methods: {
    logoutx() {
      axios
        .post(window.location.origin + "/logout")
        .then((response) => {
          //this.$router.push("/login");
          console.log("logut.response", response);
          window.location.href = "/";
        })
        .catch((error) => {
          //location.reload();
          console.log("logut.error", error);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>