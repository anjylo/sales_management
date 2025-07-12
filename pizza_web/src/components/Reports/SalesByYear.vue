<script setup>
import { ref, watch, computed, onBeforeMount } from 'vue'
import { fetchPaginated } from '@/utils/report'
import { formatCurrency } from '@/utils/helper'
import dayjs from 'dayjs'

const loading = ref(false)
const salesByYear = ref([])
const salesByYearPage = ref(1)
const salesByYearMeta = ref({})

const computedSalesByYear = computed(() => {
  return salesByYear.value.map((data) => {
    return {
      sale_year: dayjs(String(data.sale_year), 'YYYY').format('YYYY'),
      total_sales: formatCurrency(data.total_sales)
    }
  })
})

const handleFetchPaginated = async () => {
  loading.value = true

  const fetchedPaginatedData = await fetchPaginated('sales-by-year', salesByYearPage)

  salesByYear.value = fetchedPaginatedData.data
  
  salesByYearMeta.value = fetchedPaginatedData.meta
  
  loading.value = false
}

watch(salesByYearPage, () => handleFetchPaginated())

onBeforeMount(() => {
  handleFetchPaginated()
})

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
          Date
        </th>
        <th class="text-left">
          Sales
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(item, i) in computedSalesByYear"
        :key="i"
      >
        <td>{{ item.sale_year }}</td>
        <td>{{ item.total_sales }}</td>
      </tr>
    </tbody>
  </v-table>  
  <v-pagination
    v-model="salesByYearPage"
    :length="salesByYearMeta.last_page || 1"
    class="mt-2"
    :total-visible="0"
    next-icon="mdi-chevron-right"
    prev-icon="mdi-chevron-left"
    :disabled="loading"
  />
</template>
<style scoped>

</style>