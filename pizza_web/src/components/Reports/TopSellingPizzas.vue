<script setup>
  import { ref } from 'vue'

  const topSelling = ref([])

  const topSellingPizzas = async () => {
    const url = import.meta.env.VITE_APP_URL

    const response = await fetch(`${url}/api/report/top-selling`, {
      credentials: 'include',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
    })

    topSelling.value = await response.json()
  }
topSellingPizzas()
</script>
<template>
  <v-table 
    density="comfortable"
    striped="odd"
    hover
  >
    <thead>
      <tr>
        <th class="text-left">
          Name
        </th>
        <th class="text-left">
          Sales
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(item, i) in topSelling"
        :key="i"
      >
        <td>{{ item.name }}</td>
        <td>{{ item.total_quantity }}</td>
      </tr>
    </tbody>
  </v-table>
</template>
<style scoped>

</style>