<script setup>
import { ref } from 'vue'
import { toast } from 'vue3-toastify'
import { uploadCsv } from '@utils/upload'

const file = ref(null)
const uploadType = ref('pizzatypes')
const loading = ref(false)

const items = [
  { name: 'Pizza Types', value: 'pizzatypes' },
  { name: 'Pizzas', value: 'pizzas' },
  { name: 'Order Details', value: 'orderdetails' },
  { name: 'Orders', value: 'orders' },
]

const handleUpload = async () => {
  if (!file.value || !uploadType.value) {
    toast.error('Please select upload type and file.')
    return
  }

  loading.value = true

  const result = await uploadCsv(file.value, uploadType.value)
    
  if (result.success) {
    toast.success('Upload successful!')
    file.value = null
    uploadType.value = 'pizzatypes'
  } else {
    toast.error(result.message)
  }

  loading.value = false
}

</script>

<template>
  <v-card class="pa-6" min-width="400">
    <v-card-title class="text-h6 font-weight-bold">Upload CSV</v-card-title>

    <v-card-text>
      <v-form @submit.prevent="handleUpload">
        <v-select
          prepend-icon="mdi-format-list-bulleted"
          density="comfortable"
          v-model="uploadType"
          :items="items"
          label="Upload Type"
          item-title="name"
          item-value="value"
        />

        <v-file-input
          density="comfortable"
          v-model="file"
          label="Upload File"
          accept=".csv"
          prepend-icon="mdi-upload"
          show-size
        />

        <v-btn
          type="submit"
          color="primary"
          class="mt-4"
          :loading="loading"
          block
        >
          Upload
        </v-btn>
      </v-form>
    </v-card-text>
  </v-card>
</template>
