<script setup>
  import { onMounted, ref } from 'vue';
  import { fetchUser } from '@utils/auth'

  const name = ref('')
  const email = ref('')

  const handleFetchUser = async () => {
    const user = await fetchUser()

     if (user) {
      name.value = user.name
      email.value = user.email
    }
  }

  onMounted(async () => {
    handleFetchUser()
  })
</script>
<template>
  <v-container class="fill-height d-flex align-center justify-center">
    <v-navigation-drawer permanent>
      <v-list-item
        prepend-icon="mdi-account-circle"
        :title="name"
        :subtitle="email"
      />
      <v-divider />
      <v-list density="compact" nav>
        <v-list-item 
          title="Upload Items" 
          :to="{ name: 'upload' }" 
          prepend-icon="mdi-upload" 
        />
        <v-list-item 
          title="View Report" 
          :to="{ name: 'report' }" 
          prepend-icon="mdi-chart-box" 
        />
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container fluid>
        <router-view />
      </v-container>
    </v-main>
  </v-container>
</template>
<style scoped>
.fill-height {
  min-height: 100vh;
}
</style>