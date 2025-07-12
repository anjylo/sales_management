<script setup>

</script>
<template>
  <v-app>
    <v-main>
      <v-container 
        class="fill-height" 
        fluid
      >
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>
<style scoped>
  .fill-height {
    min-height: 100vh;
  }
</style>
