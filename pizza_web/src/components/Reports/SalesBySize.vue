<script setup>
  import { ref, computed } from 'vue'
  import { formatCurrency } from '@/utils/helper'

  const salesBySizeData = ref([])

  const salesBySize = async () => {
    const url = import.meta.env.VITE_APP_URL

    const response = await fetch(`${url}/api/report/sales-by-size`, {
      credentials: 'include',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
    })

    salesBySizeData.value = await response.json()
  }

  const computedSalesBySizeData = computed(() => {
    return salesBySizeData.value.map((data) => {
      return {
        size: data.size,
        total_sales: formatCurrency(data.total_sales)
      }
    })
  })
  salesBySize()
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
          Size
        </th>
        <th class="text-left">
          Sales
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(item, i) in computedSalesBySizeData"
        :key="i"
      >
        <td>{{ item.size }}</td>
        <td>{{ item.total_sales }}</td>
      </tr>
    </tbody>
  </v-table>
</template>
<style scoped>

</style>