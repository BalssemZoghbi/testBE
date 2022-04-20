<template>
  <v-footer dark padless app inset>
    <v-card
      class="flex"
      flat
      tile
      color="rgb(5 48 96)"
      :elevation="10"
    >
      <v-card-text class="py-2 white--text text-center">
        {{ new Date().getFullYear() }} — <strong>Platforme de conception de transformateur</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>