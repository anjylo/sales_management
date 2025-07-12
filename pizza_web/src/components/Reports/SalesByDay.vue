<script setup>
  import { ref, watch, computed, onBeforeMount } from 'vue'
  import { fetchPaginated } from '@/utils/report'
  import { formatCurrency } from '@/utils/helper'
  import dayjs from 'dayjs'

  const loading = ref(false)
  const salesByDay = ref([])
  const salesByDayPage = ref(1)
  const salesByDayMeta = ref({})

  const computedSalesByDay = computed(() => {
    return salesByDay.value.map((data) => {
      return {
        sale_date: dayjs(data.sale_date).format('MMMM D, YYYY'),
        total_sales: formatCurrency(data.total_sales)
      }
    })
  })

  const handleFetchPaginated = async () => {
    loading.value = true

    const fetchedPaginatedData = await fetchPaginated('sales-by-day', salesByDayPage)

    salesByDay.value = fetchedPaginatedData.data
    
    salesByDayMeta.value = fetchedPaginatedData.meta
    
    loading.value = false
  }

  watch(salesByDayPage, () => handleFetchPaginated())

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
        v-for="(item, i) in computedSalesByDay"
        :key="i"
      >
        <td>{{ item.sale_date }}</td>
        <td>{{ item.total_sales }}</td>
      </tr>
    </tbody>
  </v-table>  
  <v-pagination
    v-model="salesByDayPage"
    :length="salesByDayMeta.last_page || 1"
    class="mt-2"
    :total-visible="0"
    next-icon="mdi-chevron-right"
    prev-icon="mdi-chevron-left"
    :disabled="loading"
  />
</template>
<style scoped>

</style>