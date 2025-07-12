<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { login } from '@utils/auth'

const email = ref('')
const password = ref('')
const loading = ref(false)
const error = ref('')
const router = useRouter()

const handleLogin = async () => {
  loading.value = true
  error.value = ''

  const result = await login(email.value, password.value)

  if (result.success) {
    router.push('/dashboard')
  } else {
    error.value = result.message
  }

  loading.value = false
}
</script>

<template>
  <v-container class="fill-height d-flex align-center justify-center">
    <v-card class="pa-6" max-width="500">
      <v-card-title class="text-h6 font-weight-bold">
        Login
      </v-card-title>

      <v-card-text>
        <v-form @submit.prevent="handleLogin">
          <v-text-field
            v-model="email"
            label="Email"
            type="email"
            required
            width="400"
            prepend-inner-icon="mdi-email"
          />

          <v-text-field
            v-model="password"
            label="Password"
            type="password"
            required
            width="400"
            prepend-inner-icon="mdi-lock"
          />

          <v-alert v-if="error" type="error" class="mt-2">
            {{ error }}
          </v-alert>

          <v-btn
            type="submit"
            color="primary"
            class="mt-4"
            :loading="loading"
            block
          >
            Login
          </v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<style scoped>
.fill-height {
  min-height: 100vh;
}
</style>
