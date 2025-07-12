<script setup>
import TopSellingPizzas from '@components/Reports/TopSellingPizzas.vue'
import SalesBySize from '@components/Reports/SalesBySize.vue'
import SalesByDay from '@components/Reports/SalesByDay.vue'
import SalesByMonth from '@components/Reports/SalesByMonth.vue'
import SalesByYear from '@components/Reports/SalesByYear.vue'

</script>
<template>
  <v-container fluid>
    <h1 class="text-h5 font-weight-bold mb-4">Sales Report</h1>

    <v-row dense>
      <v-col cols="12" md="6">
        <v-card class="mb-4">
          <v-card-title>Top Selling Pizzas</v-card-title>
          <v-card-text>
            <TopSellingPizzas />
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" md="6">
        <v-card class="mb-4">
          <v-card-title>Sales by Size</v-card-title>
          <v-card-text>
            <SalesBySize />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row dense>
      <v-col cols="12">
        <v-card class="mb-4">
          <v-card-title>Total Sales by Day</v-card-title>
          <v-card-text>
            <SalesByDay />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row dense>
      <v-col cols="12" md="6">
        <v-card class="mb-4">
          <v-card-title>Total Sales by Month</v-card-title>
          <v-card-text>
            <SalesByMonth />
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" md="6">
        <v-card class="mb-4">
          <v-card-title>Total Sales by Year</v-card-title>
          <v-card-text>
            <SalesByYear />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<style scoped>

</style>
