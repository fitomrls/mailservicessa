<template>
  <v-card height="100%">
    <v-img
      v-for="foto in anuncio.fotos"
      :key="foto.id"
      :src="foto.url"
      class="white--text align-end"
      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
    >
      <v-card-title v-text="anuncio.titulo"></v-card-title>
      <v-card-subtitle
        class="caption white--text"
        v-text="anuncio.codigo"
      ></v-card-subtitle>
    </v-img>
    <v-divider></v-divider>
    <div v-if="anuncio.descripcion.length > 75" class="px-1 font-weight-thin">
      {{ anuncio.descripcion.substring(0, 75) }}&nbsp;[...]
    </div>
    <div v-else class="px-1 font-weight-thin">
      {{ anuncio.descripcion }}
    </div>

    <v-card-actions>
        <v-menu
            v-model="menu"
            :close-on-content-click="false"
            :nudge-width="200"
            offset-x
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-bind="attrs"
                    v-on="on"
                    :class="generarEstado(anuncio.estadoanuncio)"
                    small
                    rounded
                    >{{ anuncio.estadoanuncio }}
                </v-btn>
            </template>
            <v-card>
                <v-list>
                    <v-list-item>
                        <v-list-item-avatar>
                        <img
                            :src="negocio.logo"
                        >
                        </v-list-item-avatar>

                        <v-list-item-content>
                        <v-list-item-title>{{anuncio.titulo}}</v-list-item-title>
                        <v-list-item-subtitle>{{anuncio.codigo}}</v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-action>
                            <v-icon
                                v-if="anuncio.estadoanuncio=='inactivo'"
                                color="danger">
                                mdi-lock-alert
                            </v-icon>
                            <v-icon
                                v-if="anuncio.estadoanuncio=='activo'"
                                color="success">
                                mdi-lock-open
                            </v-icon>
                        </v-list-item-action>
                    </v-list-item>
                </v-list>

                <v-divider></v-divider>

                <v-card-text v-if="anuncio.estadoanuncio=='inactivo'">
                    <h4>Anuncio en espera de aprobación</h4>
                    <v-btn class="primary py-1" block>Re-enviar Solicitud</v-btn>
                </v-card-text>
                <v-divider></v-divider>
                <!-- <v-card-text v-if="anuncio.paquetes!=null">
                    <div class="subtitle">Paquetes Comprados</div>
                    <v-row v-for=" paquete in anuncio.paquetes" :key="paquete.id">
                        <v-col cols="8">
                            <div class="caption py-1">{{paquete.titulo}}</div>
                        </v-col>
                        <v-col cols="2">
                            <v-btn
                                v-if="paquete.estadocompra=='inactivo'"
                                rounded
                                small
                                class="secondary caption py-1">
                                {{paquete.costo}} Bs
                            </v-btn>
                            <v-icon v-else color="success">mdi-check-decagram</v-icon>
                        </v-col>
                    </v-row>
                </v-card-text> -->

                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    class="sin"
                    text
                    @click="menu = false"
                >
                    Cerrar
                </v-btn>
                </v-card-actions>
            </v-card>
        </v-menu>
      <v-spacer></v-spacer>
      <vistaanuncio 
        :anuncio="anuncio"
        :negocio="negocio">
      </vistaanuncio>
      <v-btn icon>
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
    name: 'CardClient',
    data() {
        return {
            fav: true,
            menu: false,
        }
    },
    props: {
        anuncio: Object,
        negocio: Object
    },
    methods: {
        generarEstado(estado) {
            if(estado=='activo'){
                return 'sin success grey--text'
            } else {
                return 'sin danger white--text'
            }
        }
    },
}
</script>

<style lang="scss" scoped>
</style>