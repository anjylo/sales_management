<script setup>
import { onMounted, ref } from 'vue'
import { fetchUser, logout } from '@utils/auth'
import { useRouter } from 'vue-router'

const name = ref('')
const email = ref('')
const router = useRouter()

const handleFetchUser = async () => {
  const user = await fetchUser()

  if (user) {
    name.value = user.name
    email.value = user.email
  }
}

const handleLogout = async () => {
  if (await logout()) {
    router.push({ name: 'Login' })
  }
}

onMounted(() => {
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
        class="my-3"
      />

      <v-divider />

      <v-list density="comfortable" nav>
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

      <template v-slot:append>
        <v-divider class="mb-2" />
        <v-list density="comfortable" nav>
          <v-list-item 
            title="Logout" 
            prepend-icon="mdi-logout" 
            @click="handleLogout" 
          />
        </v-list>
      </template>
    </v-navigation-drawer>

    <v-main class="pa-0">
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