<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SalesReportService;

class ReportController extends Controller
{
    public function __construct(private SalesReportService $service)
    {
        
    }

    /**
     * Get Top Selling Pizzas
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function topSellingPizzas()
    {
        $report = $this->service->topSellingPizzas();

        return response()->json($report);
    }

    /**
     * Get Sales Report by Pizza Size
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function salesBySize()
    {
        $report = $this->service->salesBySize();

        return response()->json($report);
    }

    /**
     * Get Sales Report by Day
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salesByDay(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        return response()->json($this->service->salesByDay($perPage));
    }

    /**
     * Get Sales Report by Month
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salesByMonth(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        return response()->json($this->service->salesByMonth($perPage));
    }

    /**
     * Get Sales Report by Year
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salesByYear(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        return response()->json($this->service->salesByYear($perPage));
    }
}
