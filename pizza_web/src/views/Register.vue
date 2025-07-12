<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { register } from '@utils/auth'

const name = ref('')
const email = ref('')
const password = ref('')
const loading = ref(false)
const error = ref('')
const router = useRouter()

const handleRegister = async () => {
  loading.value = true
  error.value = ''

  const result = await register(name.value, email.value, password.value)

  if (result.success) {
    router.push('/login')
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
        Register
      </v-card-title>

      <v-card-text>
        <v-form @submit.prevent="handleRegister">
          <v-text-field
            v-model="name"
            label="Name"
            type="text"
            required
            width="400"
            prepend-inner-icon="mdi-account"
          />

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
            Register
          </v-btn>

          <v-container 
            fluid
            class="px-0 d-flex flex-start"  
          >
            <v-btn 
              variant="text"
              color="primary"
              class="pa-0 text-none text-decoration-underline"
              :to="{
                path: '/login'
              }"
            >
              Already have an account?
            </v-btn>
          </v-container>
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
