<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { register } from '@utils/auth'
import { toast } from 'vue3-toastify';

const name = ref('')
const email = ref('')
const password = ref('')
const loading = ref(false)
const router = useRouter()

const handleRegister = async () => {
  loading.value = true

  const result = await register(name.value, email.value, password.value)

  if (result.success) {
    toast.success('Registration Success', {
      onClose: () => router.push('/login')
    })
  } else {
    toast.error(result.message)
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
