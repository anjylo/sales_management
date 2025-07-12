<script setup>
import { ref, watch, computed, onBeforeMount } from 'vue'
import { fetchPaginated } from '@/utils/report'
import { formatCurrency } from '@/utils/helper'
import dayjs from 'dayjs'

const loading = ref(false)
const salesByMonth = ref([])
const salesByMonthPage = ref(1)
const salesByMonthMeta = ref({})

const computedSalesByMonth = computed(() => {
  return salesByMonth.value.map((data) => {
    return {
      sale_month: dayjs(data.sale_month, 'YYYY-MM').format('MMMM YYYY'),
      total_sales: formatCurrency(data.total_sales)
    }
  })
})

const handleFetchPaginated = async () => {
  loading.value = true

  const fetchedPaginatedData = await fetchPaginated('sales-by-month', salesByMonthPage)

  salesByMonth.value = fetchedPaginatedData.data
  
  salesByMonthMeta.value = fetchedPaginatedData.meta
  
  loading.value = false
}

watch(salesByMonthPage, () => handleFetchPaginated())

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
        v-for="(item, i) in computedSalesByMonth"
        :key="i"
      >
        <td>{{ item.sale_month }}</td>
        <td>{{ item.total_sales }}</td>
      </tr>
    </tbody>
  </v-table>  
  <v-pagination
    v-model="salesByMonthPage"
    :length="salesByMonthMeta.last_page || 1"
    class="mt-2"
    :total-visible="0"
    next-icon="mdi-chevron-right"
    prev-icon="mdi-chevron-left"
    :disabled="loading"
  />
</template>
<style scoped>

</style>