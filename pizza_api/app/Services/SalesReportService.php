<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SalesReportService
{
  public function topSellingPizzas(int $limit = 5): \Illuminate\Support\Collection | null
    {
        return DB::table('order_details')
            ->select('pizza_types.name', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.pizza_id')
            ->join('pizza_types', 'pizza_types.pizza_type_id', '=', 'pizzas.pizza_type_id')
            ->groupBy('order_details.pizza_id', 'pizza_types.name')
            ->orderByDesc('total_quantity')
            ->limit($limit)
            ->get();
    }

    public function salesBySize()
    {
        return DB::table('pizzas')
			->select('pizzas.size', DB::raw('SUM(order_details.quantity * pizzas.price) as total_sales'))
			->join('order_details', 'pizzas.pizza_id', '=', 'order_details.pizza_id')
			->groupBy('pizzas.size')
			->get();
    }

    public function salesByDay(int $perPage = 10)
    {
        return DB::table('orders')
            ->select(
                DB::raw('DATE(orders.date) as sale_date'),
                DB::raw('SUM(order_details.quantity * pizzas.price) as total_sales')
            )
            ->join('order_details', 'orders.order_id', '=', 'order_details.order_id')
            ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.pizza_id')
            ->groupBy('sale_date')
            ->orderBy('sale_date')
            ->paginate($perPage, ['*'], 'page');
    }

    public function salesByMonth(int $perPage = 12)
    {
        return DB::table('orders')
            ->select(
                DB::raw("DATE_FORMAT(orders.date, '%Y-%m') as sale_month"),
                DB::raw('SUM(order_details.quantity * pizzas.price) as total_sales')
            )
            ->join('order_details', 'orders.order_id', '=', 'order_details.order_id')
            ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.pizza_id')
            ->groupBy('sale_month')
            ->orderBy('sale_month')
            ->paginate($perPage, ['*'], 'page');
    }

    public function salesByYear(int $perPage = 10)
    {
        return DB::table('orders')
            ->select(
                DB::raw('YEAR(orders.date) as sale_year'),
                DB::raw('SUM(order_details.quantity * pizzas.price) as total_sales')
            )
            ->join('order_details', 'orders.order_id', '=', 'order_details.order_id')
            ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.pizza_id')
            ->groupBy('sale_year')
            ->orderBy('sale_year')
            ->paginate($perPage, ['*'], 'page');
    }
}